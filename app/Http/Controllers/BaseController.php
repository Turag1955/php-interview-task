<?php

namespace App\Http\Controllers;


use App\Libraries\RequestHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{

    public function getWorkspace()
    {
      
        try {
            $payload = [
                'key'         => setting('trello_apikey'),
                'token'       => setting('trello_secret_key'),
            ];
            $apiUrl = 'https://api.trello.com/1/members/me/organizations/';
            $response = Http::get($apiUrl, $payload);
            $this->data['workspaces'] = RequestHandler::get_data($response);
            return $this->data;
        } catch (\Exception $exception) {
            return $this->data['workspaces'] = null;
        }
    }
}
