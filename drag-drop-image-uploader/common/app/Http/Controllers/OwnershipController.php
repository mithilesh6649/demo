<?php

namespace App\Http\Controllers;

use App\Models\Ownership;
use Auth;
use Illuminate\Http\Request;

class OwnershipController extends Controller
{

    function list() {
        if (Auth::user()->can("ownership_management")) {
            $list = Ownership::orderBy('created_at', 'DESC')->get();
            return view('misc.ownership.list', compact('list'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function add()
    {
        if (Auth::user()->can("add_ownership")) {
            return view('misc.ownership.add');
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saves(Request $request)
    {

        $owner = new Ownership();
        $owner->ownership_name = $request->ownership;
        $owner->status = 1;
        $owner->save();

        return redirect()->route('ownerships.list')->with(['status' => 'Ownership Name add successfully']);

    }

    public function views($id)
    {
        if (Auth::user()->can("view_ownership")) {

            $owner = Ownership::where('id', $id)->first();
            return view('misc.ownership.view', compact('owner'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function edit($id)
    {
        if (Auth::user()->can("edit_ownership")) {

            $owner = Ownership::where('id', $id)->first();
            return view('misc.ownership.edit', compact('owner'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function updates(Request $request)
    {
        $owner = Ownership::where('id', $request->id)->first();
        $owner->ownership_name = $request->ownership;
        $owner->status = $request->status;
        $owner->update();

        return redirect()->route('ownerships.list')->with(['status' => 'Ownership details update successfully']);
    }

    public function deletes(Request $request)
    {
        $owner = Ownership::where('id', $request->id)->first();
        if ($owner) {
            $owner->delete();
            return response()->json(['success' => 1]);

        } else {
            return response()->json(['success' => 0]);

        }
    }

    //deletedOfferList
    public function deletedOwnershipsList()
    {
        if (Auth::user()->can("manage_recyle_ownership_tab")) {

            $allOwnership = Ownership::onlyTrashed()->get();

            return view('misc.ownership.deleted_list', compact("allOwnership"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Restore Offer
    public function restoreOwnerships(Request $request)
    {
        Ownership::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteOwnerships(Request $request)
    {
        Ownership::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

}
