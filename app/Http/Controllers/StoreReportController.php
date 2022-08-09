<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Libraries\RequestHandler;



class StoreReportController extends Controller
{

    public function __construct()
    {
        $this->data['sitetitle'] = 'Store Report';
    }

    public function index()
    {
        return view('store-report.index', $this->data);
    }

    public function create(Request $request)
    {
        $response = Http::get('https://raw.githubusercontent.com/Bit-Code-Technologies/mockapi/main/purchase.json');
        $data = json_decode($response->getBody()->getContents(), true);
        dd($data);
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->make($request);
        return redirect()->route('admin.category.index')->withSuccess('The data inserted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
    }

    public function edit($id)
    {
        $this->data['category'] = $this->categoryService->find($id);
        return view('admin.category.edit', $this->data);
    }

    public function update(CategoryRequest $request, Categorie $category)
    {
        $this->categoryService->update($category->id, $request);
        return redirect()->route('admin.category.index')->withSuccess('The data updated successfully!');
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('admin.category.index')->with(['success' => 'Delete successfully.']);
    }


    // public function getCategory(Request $request)
    // {
    //     $categorys = Categorie::orderBy('id', 'desc')->get();
    //     $i         = 1;
    //     $categoryArray = [];
    //     if (!blank($categorys)) {
    //         foreach ($categorys as $category) {
    //             $categoryArray[$i]          = $category;
    //             $categoryArray[$i]['setID'] = $i;
    //             $i++;
    //         }
    //     }
    //     return Datatables::of($categoryArray)
    //         ->addColumn('action', function ($category) {
    //             $retAction = '';
    //             if (auth()->user()->can('category_edit')) {
    //                 $retAction .= '<a href="' . route('admin.category.edit', $category) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
    //             }
    //             if (auth()->user()->can('category_delete')) {
    //                 $retAction .= '<form class="float-left pl-2" action="' . route('admin.category.destroy', $category) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
    //             }
    //             return $retAction;
    //         })
    //         ->editColumn('name', function ($category) {
    //             return $category->name;
    //         })
    //         ->editColumn('status', function ($category) {
    //             return ($category->status == 5 ? trans('statuses.' . Status::ACTIVE) : trans('statuses.' . Status::INACTIVE));
    //         })
    //         ->editColumn('id', function ($category) {
    //             return $category->setID;
    //         })
    //         ->make(true);
    // }
}
