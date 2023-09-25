<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;

class SubscriberController extends Controller
{

    // Fetching all subscribers

    public function subscriberList()
    {

        $allSubscribersList = Subscriber::orderBy('created_at', 'DESC')->get();
        return view('subscribers.list', compact('allSubscribersList'));

    }

    public function demo()
    {

        return view('subscribers.demo');

    }

    //View Particular subscriber

    public function viewSubscriber($id)
    {

        $ParticularSubscriber = Subscriber::where('id', $id)->first();

        return view('subscribers.view', compact('ParticularSubscriber'));

    }

}
