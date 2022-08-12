<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\RequestHandler;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BaseController;

class ListController extends BaseController
{


    public function index($idBoard)
    {
        try {
            $listId = [];
            $payload = [
                'key'         => setting('trello_apikey'),
                'token'       => setting('trello_secret_key'),
            ];
            $apiUrl = "https://api.trello.com/1/boards/{$idBoard}/lists";
            $response = Http::get($apiUrl, $payload);
            $this->data['lists'] = RequestHandler::get_data($response);

            foreach ($this->data['lists'] as $list) {
                $listId[] = $list->id;
            }

            $this->data['cardlist'] =  $this->cardList($listId);
            $this->data['idBoard'] = $idBoard;
            $this->getWorkspace();
            return view('workspace.list', $this->data);
        } catch (\Exception $exception) {
            return redirect(route('workspace.index'))->withError($exception->getMessage());
        }
    }


    public function store(Request $request)
    {
        try {
            $idBoard = $request->get('idBoard');
            $payload = [
                'name'    => $request->get('name'),
                'idBoard' => $idBoard,
                'key'     => setting('trello_apikey'),
                'token'   => setting('trello_secret_key'),
            ];
            $apiUrl = 'https://api.trello.com/1/lists';
            $response = Http::post($apiUrl, $payload);
            $data = RequestHandler::get_data($response);
            if ($data) {
                return redirect()->route('list.index', $idBoard)->withSuccess('List Create successfully!');
            } else {
                return redirect()->route('list.index', $idBoard)->withSuccess('List Create Unsuccessfully!');
            }
        } catch (\Exception $exception) {
            return redirect(route('workspace.index'))->withError($exception->getMessage());
        }
    }

    public function cardStore(Request $request)
    {
        try {
            $idBoard = $request->get('idBoard');
            $payload = [
                'name'   => $request->get('name'),
                'desc'   => $request->get('desc'),
                'idList' =>  $request->get('idList'),
                'key'    => setting('trello_apikey'),
                'token'  => setting('trello_secret_key'),
            ];
            $apiUrl = 'https://api.trello.com/1/cards';
            $response = Http::post($apiUrl, $payload);
            $data = RequestHandler::get_data($response);
            if ($data) {
                return redirect()->route('list.index', $idBoard)->withSuccess('Card Create successfully!');
            } else {
                return redirect()->route('list.index', $idBoard)->withSuccess('Card Create Unsuccessfully!');
            }
        } catch (\Exception $exception) {
            return redirect(route('workspace.index'))->withError($exception->getMessage());
        }
    }

    public function cardList($listId = null)
    {
        try {
            $card = [];
            $payload = [
                'key'         => setting('trello_apikey'),
                'token'       => setting('trello_secret_key'),
            ];
            if (!blank($listId)) {
                foreach ($listId as $id) {
                    $apiUrl = "https://api.trello.com/1/lists/{$id}/cards";
                    $response = Http::get($apiUrl, $payload);
                    $card[$id] = json_decode($response->getBody()->getContents(), true);
                }
            }
            return $card;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function cardShow(Request $request)
    {
        try {
            $id = $request->get('card_id');
            $payload = [
                'key'         => setting('trello_apikey'),
                'token'       => setting('trello_secret_key'),
            ];

            $apiUrl = "https://api.trello.com/1/cards/{$id}";
            $response = Http::get($apiUrl, $payload);
            $data = json_decode($response->getBody()->getContents(), true);
            echo json_encode($data);
        } catch (\Exception $exception) {
            return null;
        }
    }
}
