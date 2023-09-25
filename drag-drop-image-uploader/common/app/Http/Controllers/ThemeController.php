<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Auth;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function ThemeList()
    {
        if (Auth::user()->can("theme_management")) {
            $allThemes = Theme::get();
            // dd($allThemes);
            return view('pages/theme/website_pages_list', compact('allThemes'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function viewThemePage($id)
    {
        if (Auth::user()->can("view_theme")) {

            $SingleTheme = Theme::find($id);
            return view('pages/theme/view_website_page', compact('SingleTheme'));
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //change choice group status

    public function changeThemeStatus(Request $request)
    {
        //dd($request->all());

        Theme::where('id', '!=', $request->id)->update([
            'status' => '0',
        ]);

        $themeChange = Theme::where('id', $request->id)->update([
            'status' => '1',
        ]);
        return response()->json([
            'status' => 'theme_activated',
            'message' => "Theme Activated",
        ]);

    }

    public function editThemePage($id)
    {
        $themeEdit = Theme::find($id);

        return view('pages/theme/edit_website_page', compact('themeEdit'));
    }

}
