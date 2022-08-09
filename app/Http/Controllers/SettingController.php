<?php

namespace App\Http\Controllers;

use Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SettingController extends Controller
{


    public function index()
    {
        return view('setting.index');
    }


    public function trelloSettingUpdate(Request $request)
    {
        $niceNames    = [];
        $treelloArray = $this->validate($request, $this->trelloValidateArray(), [], $niceNames);

        Setting::set($treelloArray);
        Setting::save();
        return redirect(route('trello.setting'))->withSuccess('The updated successfully.');
    }

    private function trelloValidateArray()
    {
        return [
            'trello_apikey'  => 'nullable|string',
            'trello_secret_key' => 'nullable|string',
        ];
    }
}
