<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FundCard;
use App\Models\MoneyTransfer;
use App\Models\CardCategory;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class CardController extends Controller
{
    public function card_list() {
		\Session::forget('tablink');
		if(Auth::user()->can('view_cards')) {
            $cards = FundCard::with('person')->get();
            $count_cards = count($cards);
			return view('cards/index', [ 'cards' => $cards, 'count_cards' => $count_cards ]);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

    public function filter(Request $request){

        $holder_name = $request->holder_name;
        $date_range = $request->date_range;

        $card = FundCard::query();;
        $card->with('person');

        if($holder_name != null || $holder_name != ''){
			
            $card->wherehas('person',function($query) use($holder_name)
            {
                $query->where('firstName','LIKE','%'.$holder_name.'%');
            });

        }
        
        if($date_range[0] != null || $date_range[0] != ''){

			$card->where('activatedAt','>=',date('Y-m-d',strtotime($date_range[0])))->where('activatedAt','<=',date('Y-m-d',strtotime($date_range[1].'+ 1 days')))->get();
		
		}

        $cards = $card->get();

        
        $result_view = view('cards.partial',['cards'=>$cards])->render();
        return json_encode(['html'=> $result_view,'status'=>"true"]);

    }

    public function get_token(Request $request){

        $response = Http::withHeaders([
            'sd-api-key' => 'sd_test_0d791d306347ad70b7c5956cee34fd0c',
			'sd-person-id' => 'per-b82d1b92-130d-4bcd-bed1-a1b9c608ce32'
        ])->post('https://test-api.solidfi.com/v1/card/crd-47998c60-c604-4518-a857-e1e8eaa18b7b/showtoken');

        // if($response){
        //     return json_encode('data',$response);
        // }
        $response = json_decode($response);
        dd($response);

    }

    public function cards_reset(){
        $cards = FundCard::with('person')->get();

        $result_view = view('cards.partial',['cards'=>$cards])->render();
        return json_encode(['html'=> $result_view,'status'=>"true"]);
    }

    public function view_card($id){
        
        $tablink = 'home';

        if(\Session::get('tablink')){
            $tablink = \Session::get('tablink');
        }

        $card_detail = FundCard::where('id',$id)->with('person')->first();
        $money_transfer = MoneyTransfer::where(['paymentFor'=>'solidCard','cardId'=>$card_detail->card_id])->get();

        $category = null;
        $selected_card_category = array();

        if($card_detail->allowedCategories != null){
            $category = json_decode($card_detail->allowedCategories);
        }elseif($card_detail->blockedCategories != null){
            $category = json_decode($card_detail->blockedCategories);
        }

        if($category != null){
            $selected_card_category = CardCategory::whereIn('mcc',$category)->pluck('combined_description');
        }

        return view('cards/view')->with(['card_detail'=>$card_detail,'money_transfer'=>$money_transfer,'selected_card_category'=>$selected_card_category,'tablink'=>$tablink]);
    }
}
