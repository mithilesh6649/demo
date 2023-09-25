<?php
namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\GiftCard;
use App\Models\GiftCardsType;
use App\Models\PurchasedGiftCard;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class GiftCardController extends Controller
{

    //list of gift cards
    public function GiftCardsList()
    {

        if (Auth::user()->can("gift_cards_management")) {
            $all_badges = GiftCard::select(DB::raw('badge', 'is_gift_card_used'))->where('is_gift_card_used', '0')->groupBy('is_gift_card_used')->groupBy('badge')->get();

            return view('gift-cards.list', compact('all_badges'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function GiftCardsListData()
    {
        return Datatables::of(GiftCard::query())->addIndexColumn()

            ->addColumn('IsCardUsed', function ($row) {
                $actionBtsss = $row->is_gift_card_used == 1 ? 'Yes' : 'No';
                return $actionBtsss;
            })
            ->rawColumns(['IsCardUsed'])

            ->addColumn('statusType', function ($row) {
                $actionBtsss = $row->gift_cards_type_id;
                $datas = GiftCardsType::where('id', $actionBtsss)->first();
                return $datas->name . " KD";
            })
            ->rawColumns(['statusType'])

            ->addColumn('statusActive', function ($row) {
                $actionBtss = $row->status == 1 ? 'Active' : 'Inactive';
                return $actionBtss;
            })
            ->rawColumns(['statusActive'])

            ->addColumn('action', function ($row) {

                if ($row->is_gift_card_used == 1) {

                    $actionBtn = " <i class='text-info'>Used Card</i>
                            <a href='javascript:void(0)'>
                            <i class='fa fa-question-circle quick_view' data-card-id='$row->card_number'></i>
                           </a>
                       <a class='action-button' title='View' href='view/$row->id'><i class='text-info fa fa-eye'></i></a>";

                } else {
                    if ($row->status == 1) {

                        $actionBtn = " <label class='switch'>
                        <input type='checkbox'  type='checkbox'  class='change_status_of_cards'  data-id='$row->id' checked>
                        <span class='slider round'></span>
                      </label>

                       <a class='action-button' title='View' href='view/$row->id'><i class='text-info fa fa-eye'></i></a> <a class='action-button delete-button' title='Delete' href='javascript:void(0)' data-id=$row->id><i class='text-danger fa fa-trash-alt'></i></a>";
                    } else {

                        $actionBtn = "<label class='switch'>
                        <input type='checkbox'   type='checkbox'  class='change_status_of_cards'  data-id='$row->id' >
                        <span class='slider round'></span>
                      </label>

                       <a class='action-button' title='View' href='view/$row->id'><i class='text-info fa fa-eye'></i></a> <a class='action-button delete-button' title='Delete' href='javascript:void(0)' data-id=$row->id><i class='text-danger fa fa-trash-alt'></i></a>";

                    }
                }

                return $actionBtn;
            })
            ->rawColumns(['action'])

            ->toJson();
    }

    //add gift cards
    public function addGiftCard()
    {

        if (Auth::user()->can("add_gift_card")) {

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')
                ->get();
            $gift_card_type = GiftCardsType::where('status', 1)->get();
            return view('gift-cards.add', compact('status', 'gift_card_type'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    //Save Gift Cards
    public function saveGiftCard(Request $request)
    {

        $latest = GiftCard::latest()->pluck('badge')->first();

        if (empty($latest)) {
            $badge = 1;
        } else {
            $badge = $latest + 1;
        }

        $start_number = $request->start_number;
        $end_number = $request->end_number;

        if (!empty($end_number)) {
            $test_data = array();
            for ($i = $start_number; $i <= $end_number; $i++) {

                $test_data[$i]['title'] = $request->title;
                $test_data[$i]['title_ar'] = $request->title_ar;
                $test_data[$i]['description'] = $request->description;
                $test_data[$i]['description_ar'] = $request->description_ar;
                $test_data[$i]['gift_cards_type_id'] = $request->gift_cards_type_id;
                $test_data[$i]['card_number'] = $i;
                $test_data[$i]['status'] = $request->status;
                $test_data[$i]['badge'] = $badge;
                $test_data[$i]["created_at"] = \Carbon\Carbon::now();
                $test_data[$i]["updated_at"] = \Carbon\Carbon::now();

            }
            $chunk_data = array_chunk($test_data, 1000);
            if (isset($chunk_data) && !empty($chunk_data)) {
                foreach ($chunk_data as $chunk_data_val) {
                    DB::table('gift_cards')->insert($chunk_data_val);
                }
            }
        } else {
            $GiftCard = new GiftCard();
            $GiftCard->title = $request->title;
            $GiftCard->title_ar = $request->title_ar;
            $GiftCard->description = $request->description;
            $GiftCard->description_ar = $request->description_ar;
            $GiftCard->gift_cards_type_id = $request->gift_cards_type_id;
            $GiftCard->card_number = $request->start_number;
            $GiftCard->status = $request->status;
            $GiftCard->badge = $badge;
            $GiftCard->save();

        }

        return redirect()
            ->route("gift.card.list")
            ->with("success", "Gift Card has been added successfully!");

    }

    //Edit Gift Cards
    public function editGiftCard($id)
    {
        $GiftCard = GiftCard::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')
            ->get();
        $gift_card_type = DB::table('md_dropdowns')->where('slug', 'gift_card_type')
            ->get();
        return view('gift-cards.edit', compact('GiftCard', 'status', 'gift_card_type'));
    }

    //Update Gift Card
    public function updateGiftCard(Request $request)
    {

        $date = str_replace("/", "-", $request->end_date);
        $end_date = date('Y-m-d H:00:00', strtotime($date));
        $dates = str_replace("/", "-", $request->start_date);
        $start_date = date('Y-m-d H:00:00', strtotime($dates));

        $giftCard = GiftCard::where('id', $request->git_card_id)
            ->first();

        $giftCard->title = $request->title;
        $giftCard->description = $request->description;
        $giftCard->card_type = $request->card_type;
        $giftCard->price = $request->price;
        $giftCard->start_date = $start_date;
        $giftCard->end_date = $end_date;
        $giftCard->status = $request->status;

        if ($request->file("thumbnail")) {
            $OffersImageTwo = $request->file("thumbnail");
            $thumbnail = time() . "." . $OffersImageTwo->getClientOriginalExtension();
            $OffersImageTwo->move("offers/gift_card", $thumbnail);
            $giftCard->thumbnail = $thumbnail;
        }

        $giftCard->update();

        return redirect()
            ->route("gift.card.list")
            ->with("success", "Gift Card has been updated successfully!");

    }

    //View Gift Cards
    public function viewGiftCard($id)
    {
        if (Auth::user()->can("view_gift_card")) {

            $GiftCard = GiftCard::where('id', $id)->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')
                ->get();
            $gift_card_type = GiftCardsType::where('status', 1)->get();
            return view('gift-cards.view', compact('GiftCard', 'status', 'gift_card_type'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function deleteGiftCard(Request $request)
    {
        if (Auth::user()->can("delete_gift_card")) {

            $GiftCard = GiftCard::where('id', $request->id)
                ->first();
            $deleteGiftCard = $GiftCard->delete();
            if ($deleteGiftCard) {
                $res['success'] = 1;
                return json_encode($res);
            } else {
                $res['success'] = 0;
                return json_encode($res);
            }

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function deleteGiftCardBulk(Request $request)
    {

        if (Auth::user()->can("delete_gift_card")) {
            $GiftCard = GiftCard::where('badge', $request->id)->where('is_gift_card_used', 0)
                ->get()->pluck('id')->toArray();

            $deleteGiftCard = GiftCard::whereIn('id', $GiftCard)->delete();

            if ($deleteGiftCard) {
                $res['success'] = 1;
                return json_encode($res);
            } else {
                $res['success'] = 0;
                return json_encode($res);
            }

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    //change choice group status

    public function GiftCardsStatus(Request $request)
    {

        if (Auth::user()->can("edit_gift_card")) {
            //  return $request->all();
            if ($request->status_value == 0) {
                $choiceGroupStatus = GiftCard::where('id', $request->id)
                    ->update(['status' => '0']);
                return response()
                    ->json(['status' => 'success', 'message' => "Inactive"]);
            } else {
                $choiceGroupStatus = GiftCard::where('id', $request->id)
                    ->update(['status' => '1']);
                return response()
                    ->json(['status' => 'success', 'message' => "Active"]);
            }

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function deletedGiftCardsList()
    {
        if (Auth::user()->can("manage_recyle_gift_cards_tab")) {
            $all_badges = GiftCard::select(DB::raw('badge', 'is_gift_card_used'))->where('is_gift_card_used', '0')->groupBy('is_gift_card_used')->groupBy('badge')->onlyTrashed()->get();
            return view('gift-cards.deleted_gift_cards_list', compact('all_badges'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function GiftCardsDeletedListData()
    {

        return Datatables::of(GiftCard::onlyTrashed())->addIndexColumn()

            ->addColumn('statusType', function ($row) {
                $actionBtsss = $row->gift_cards_type_id;
                $datas = GiftCardsType::where('id', $actionBtsss)->first();
                return $datas->name . " KD";
            })
            ->rawColumns(['statusType'])
            ->addColumn('action', function ($row) {
                $actionBtn = "
                       <a class='action-button restore-button' href='javascript:void(0)'  title='Restore' data-id='$row->id'><i class='text-success fa fa-undo'></i></a> <a class='action-button delete-button' title='Delete' href='javascript:void(0)' data-id=$row->id><i class='text-danger fa fa-trash-alt'></i></a>";

                return $actionBtn;
            })
            ->rawColumns(['action'])

            ->toJson();

    }

    //Restore Offer
    public function restoreGiftCards(Request $request)
    {
        if (Auth::user()->can("restore_gift_cards")) {
            $offersList = GiftCard::withTrashed()
                ->find($request->id)
                ->restore();
            return "success";
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Permanent Delete Offer
    public function permanentDeleteGiftCards(Request $request)
    {
        if (Auth::user()->can("permanent_deleted_gift_cards")) {
            $usersList = GiftCard::onlyTrashed()
                ->find($request->id)
                ->forceDelete();
            return "success";
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function deleteGiftCardBulkPermanent(Request $request)
    {

        $GiftCard = GiftCard::onlyTrashed()->where('badge', $request->id)->where('is_gift_card_used', 0)
            ->get()->pluck('id')->toArray();

        $deleteGiftCard = GiftCard::whereIn('id', $GiftCard)->forceDelete();

        if ($deleteGiftCard) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function restoreGiftCardBulk(Request $request)
    {

        $GiftCard = GiftCard::withTrashed()->where('badge', $request->id)->where('is_gift_card_used', 0)
            ->get()->pluck('id')->toArray();

        $deleteGiftCard = GiftCard::whereIn('id', $GiftCard)->restore();

        if ($deleteGiftCard) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function importGiftCards($id)
    {
        //  return false;
        if (($handle = fopen(public_path() . '/' . $id . '.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                $badge = null;
                $status = null;
                $is_gift_card_used = null;
                $gift_cards_type_id = null;

                if ($data[1] != '') {
                    $status = '0';
                    $is_gift_card_used = '1';
                } else {
                    $status = '1';
                    $is_gift_card_used = '0';
                }

                if ($data[2] == '3 KD') {
                    $gift_cards_type_id = "1";
                    $badge = '1';
                }

                if ($data[2] == '5 Kd') {
                    $gift_cards_type_id = "2";
                    $badge = '2';
                }

                if ($data[2] == '10 Kd') {
                    $gift_cards_type_id = "3";
                    $badge = '3';
                }

                if ($data[2] == '20 Kd') {
                    $gift_cards_type_id = "4";
                    $badge = '4';
                }

                $GiftCard = GiftCard::create([
                    'title' => 'Mughal Mahal  Gift Card',
                    'title_ar' => 'بطاقة هدية موغال محل',
                    'card_number' => $data[0],
                    'gift_cards_type_id' => $gift_cards_type_id,
                    'badge' => $badge,
                ]);

            }
            fclose($handle);

            return 'GiftCard   Imported Successfully';
        }

    }

    public function UpdateGiftCards($id)
    {
        //  return false;
        if (($handle = fopen(public_path() . '/' . $id . '.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                $card_number = GiftCard::pluck("card_number")->toArray();

                foreach ($card_number as $number) {
                    if ($number == $data[0]) {
                        $newGifCard = GiftCard::where("card_number", $card_number)->first();
                        $newGifCard->status = 0;
                        $newGifCard->is_gift_card_used = 1;
                        $newGifCard->save();
                    }
                }
                // dump($data[0]);
                // dd($data);

            }
            fclose($handle);

            return 'GiftCard   Updated  Successfully';
        }

    }

    public function GiftCardsUsedDetails(Request $request)
    {
        $all_purchased_cards = PurchasedGiftCard::all();
        $current_card_number = $request->id;
        foreach ($all_purchased_cards as $purchased_gift_card) {
            $particularCards = json_decode($purchased_gift_card->card_number);
            if (in_array($current_card_number, $particularCards)) {
                $purchased_gift_card;

                $branch_name = Branch::where('id', $purchased_gift_card->branch_id)->value('title_en');
                $used_date = date('d/m/Y h:m A', strtotime($purchased_gift_card->date));

                return json_encode(["branch_name" => $branch_name, "card_number" => $current_card_number, "used_date" => $used_date, "status" => true]);

                break;
            }
        }
        // $particularCards    =   $all_purchased_cards->card_number;
        // dd($particularCards);
        //$someArray = json_decode($particularCards);
        //dump($someArray);
    }

}
