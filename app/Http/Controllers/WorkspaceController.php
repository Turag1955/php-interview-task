<?php

namespace App\Http\Controllers;

use App\Models\StoreReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\WorkspaceRequest;

class WorkspaceController extends BaseController
{

    public function __construct()
    {
        $this->getWorkspace();
    }

    public function index()
    {
        return view('workspace.index', $this->data);
    }

    public function store(Request $request)
    {
        try {
            $payload = [
                'displayName' => $request->get('displayName'),
                'key'         => setting('trello_apikey'),
                'token'       => setting('trello_secret_key'),
            ];
            $apiUrl = 'https://api.trello.com/1/organizations';
            $response = Http::post($apiUrl, $payload);
            $data = json_decode($response->getBody()->getContents(), true);
            if (!blank($data)) {
                return redirect()->route('workspace.index')->withSuccess('Workspace Create successfully!');
            }
        } catch (\Exception $exception) {
            return redirect(route('workspace.index'))->withError($exception->getMessage());
            // dd($exception);
        }
    }
}
