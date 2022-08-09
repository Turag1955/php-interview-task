<?php

namespace App\Http\Controllers;

use App\Models\StoreReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\WorkspaceRequest;

class WorkspaceController extends Controller
{

    public function __construct()
    {
        $this->data['sitetitle'] = 'Store Report';
    }

    public function index()
    {
        return view('workspace.index');
    }


    public function store(WorkspaceRequest $request)
    {
        try {
            $payload = [
                'displayName' => $request->get('displayName'),
                'key'         => setting('trello_apikey'),
                'token'       => setting('trello_secret_key'),
            ];
            $apiUrl = 'https://api.trello.com/1/organizations';
            $response = Http::post($apiUrl,$payload);
            $data = json_decode($response->getBody()->getContents(), true);
            if (!blank($data)) {
                $this->delete();
                StoreReport::insert($data);
                return redirect()->route('/');
            }
        } catch (\Exception $exception) {
            dd($exception);
        }
    }


    protected function getStoreReport()
    {
        $reports = StoreReport::orderBy('purchase_quantity', 'desc')->get();
        return $reports;
    }

    public function delete()
    {
        StoreReport::truncate();
    }
}
