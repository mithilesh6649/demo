<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CurrencyConverter;
use App\Models\SocialMediaLink;

class ConfigurationController extends Controller
{
    public function configurationList()
    {
        $data = CurrencyConverter::first();

        $socialMediaLink = SocialMediaLink::get();

        $fb = SocialMediaLink::whereType("fb")->first();
        $insta = SocialMediaLink::whereType("insta")->first();
        $twitter = SocialMediaLink::whereType("twitter")->first();
        $youtube = SocialMediaLink::whereType("youtube")->first();

        return view('configuration.list')->with([
                                                "data" => $data, "fb" => $fb, 
                                                "insta" => $insta, "twitter" => $twitter,
                                                "youtube" => $youtube
                                            ]);
    }

    public function updateConfiguration(Request $request)
    {
        $record = CurrencyConverter::first();
        $record->amount_in_htg_currency_equivalent_to_one_dollar = $request->amount_in_htg_currency_equivalent_to_one_dollar;
        $record->save();

        if(isset($request->fb_link)){
            SocialMediaLink::whereType("fb")->update(["link" => $request->fb_link]);
        }

        if(isset($request->insta_link)){
            SocialMediaLink::whereType("insta")->update(["link" => $request->insta_link]);
        }

        if(isset($request->youtube_link)){
            SocialMediaLink::whereType("youtube")->update(["link" => $request->youtube_link]);
        }

        if(isset($request->twitter_link)){
            SocialMediaLink::whereType("twitter")->update(["link" => $request->twitter_link]);
        }

        return redirect()->back()->with('success','Data has been updated successfully!');
    }

    public function socialMediaLink(Request $request)
    {
        $record = new SocialMediaLink();
        $record = $request->fb_link;
        $record = $request->twitter_link;
        $record = $request->insta_link;
        $record = $request->you_tube_link;
        $record->save();

        return redirect()->back()->with('success','Data has been updated successfully!');
    }


    // added later
    public function configurations(){
        $school_limit = \App\Models\Configuration::where('tag','maximum_school_limit')->first();
        return view('configuration.list')->with(['school_limit'=>$school_limit]);
    }

    public function updateConfigurations(Request $request){
        
        $configuration = \App\Models\Configuration::find($request->id);
        $configuration->maximum_limit = $request->maximum_limit;

        if($configuration->save()){
            return redirect()->back()->with('success','The Configuration has been updated successfully!');
        }else{
            return redirect()->back()->with('warning','Something went wrong!');
        }
    }
    // added later

}
