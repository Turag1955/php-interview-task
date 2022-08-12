<?php

namespace App\Http\Controllers;

use App\Models\StoreReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class StoreReportController extends Controller
{

    public function index()
    {
        $this->data['reports'] = $this->getStoreReport();
        return view('store-report.index', $this->data);
    }


    public function store(Request $request)
    {
        try {
            $response = Http::get('https://raw.githubusercontent.com/Bit-Code-Technologies/mockapi/main/purchase.json');
            $data = json_decode($response->getBody()->getContents(), true);
            if (!blank($data)) {
                $this->delete();
                StoreReport::insert($data);
                return redirect()->route('/');
            }
        } catch (\Exception $exception) {
            redirect()->route('/')->withErrors($exception->getMessage());
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
