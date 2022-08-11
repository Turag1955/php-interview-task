<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\RequestHandler;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BaseController;

class BoardController extends BaseController
{

    public function __construct()
    {
        $this->getWorkspace();
    }

    public function index($id)
    {
        $payload = [
            'key'         => setting('trello_apikey'),
            'token'       => setting('trello_secret_key'),
        ];
        $apiUrl = "https://api.trello.com/1/organizations/{$id}/boards";
        $response = Http::get($apiUrl, $payload);
        $this->data['boards'] = RequestHandler::get_data($response);
        $this->data['idOrganization'] = $id;
        return view('workspace.board', $this->data);
    }


    public function store(Request $request)
    {
        try {
            $idOrganization = $request->get('idOrganization');
            $payload = [
                'name'           => $request->get('name'),
                'desc'           => $request->get('desc'),
                'idOrganization' => $idOrganization,
                'key'            => setting('trello_apikey'),
                'token'          => setting('trello_secret_key'),
            ];
            $apiUrl = 'https://api.trello.com/1/boards/';
            $response = Http::post($apiUrl, $payload);
            $data = RequestHandler::get_data($response);
            if ($data) {
                return redirect()->route('board.index', $idOrganization)->withSuccess('Board Create successfully!');
            } else {
                return redirect()->route('board.index', $idOrganization)->withSuccess('Board Create Unsuccessfully!');
            }
        } catch (\Exception $exception) {
            return redirect(route('board.index', $idOrganization))->withError($exception->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $board_id = $request->get('board_id');
        $payload = [
            'key'         => setting('trello_apikey'),
            'token'       => setting('trello_secret_key'),
        ];
        $apiUrl = "https://api.trello.com/1/boards/{$board_id}";
        $response = Http::get($apiUrl, $payload);
        $data = json_decode($response->getBody()->getContents(), true);
        return response($data);
    }

    public function update(Request $request)
    {
        try {
            $idOrganization = $request->get('idOrganization');
            $board_id = $request->get('board_id');
            $payload = [
                'name'           => $request->get('name'),
                'desc'           => $request->get('desc'),
                'idOrganization' => $idOrganization,
                'key'            => setting('trello_apikey'),
                'token'          => setting('trello_secret_key'),
            ];
            $apiUrl = "https://api.trello.com/1/boards/{$board_id}";
            $response = Http::put($apiUrl, $payload);
            $data = RequestHandler::get_data($response);
            if ($data) {
                return redirect()->route('board.index', $idOrganization)->withSuccess('Board Update successfully!');
            } else {
                return redirect()->route('board.index', $idOrganization)->withSuccess('Board Update Unsuccessfully!');
            }
        } catch (\Exception $exception) {
            return redirect(route('board.index', $idOrganization))->withError($exception->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $board_id = $request->get('board_id');
            $payload = [
                'idOrganization' => $request->get('idOrganization'),
                'key'            => setting('trello_apikey'),
                'token'          => setting('trello_secret_key'),
            ];
            $apiUrl = "https://api.trello.com/1/boards/{$board_id}";
            $response = Http::delete($apiUrl, $payload);
            $data = RequestHandler::get_data($response);
            if ($data) {
                echo 'Success';
            } else {
                echo 'Error';
            }
        } catch (\Exception $exception) {
        }
    }
}
