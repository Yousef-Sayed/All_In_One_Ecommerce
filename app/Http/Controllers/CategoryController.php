<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\backend\category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = category::select('*');

            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('category.edit',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.edit').'</a>';
                $actionBtn .= '<a class="btn btn-danger text-white btn-sm font-weight-bold"
                                    data-toggle="modal"data-id="'. $row->id .'" id="btnDelete" data-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i>  '.__('words.delete').'
                                </a>
                            </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->make(true);
        }
        return view('backend.categories.category');
    }

    public function create()
    {
        return view('backend.categories.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'nameEn' => 'required|min:3|string',
            'discriptionEn' => 'required|min:20|string',
            'nameAr' => 'required|min:3|string',
            'discriptionAR' => 'required|min:20|string',
            'parent' => 'required',
            'image' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }

        $file = $request->file('image');
        $filename = Str::uuid(). '-' . $file->getClientOriginalName();
        $file->move(public_path('images/category'),$filename);
        $path = "images/category/" . $filename;
        category::create([
            'nameEn' => $request->nameEn,
            'discriptionEn' => $request->discriptionEn,
            'image' => $path,
            'nameAr' => $request->nameAr,
            'discriptionAr' => $request->discriptionAR,
            'parent' => $request->parent,
        ]);
        Session::put('sucess', __('words.msgAdd'));
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        $cats = $category->id;
        return view('backend.categories.show',compact('cats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        $cat = category::find($category->id);
        return view('backend.categories.editCategory',compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category) : RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'nameEn' => 'required|min:3|string',
            'discriptionEn' => 'required|min:20|string',
            'nameAr' => 'required|min:3|string',
            'discriptionAr' => 'required|min:20|string',
            'parent' => 'required',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }

        if ($request->hasFile('image')) {
            $img = category::where('id', $category->id);
            // dd(public_path($img->first()->image));
            unlink(public_path($img->first()->image));
            $file = $request->file('image');
            $filename = Str::uuid(). '-' . $file->getClientOriginalName();
            $file->move(public_path('images/category'),$filename);
            $path = "images/category/" . $filename;
            category::where('id',$category->id)->update([
                'nameEn' => $request->nameEn,
                'nameAr' => $request->nameAr,
                'discriptionEn' => $request->discriptionEn,
                'discriptionAr' => $request->discriptionAr,
                'parent' => $request->parent,
                'image' => $path,
            ]);
        }else{
            category::where('id',$category->id)->update([
                'nameEn' => $request->nameEn,
                'nameAr' => $request->nameAr,
                'discriptionEn' => $request->discriptionEn,
                'discriptionAr' => $request->discriptionAr,
                'parent' => $request->parent,
            ]);
        }
        Session::put('sucess', __('words.msgUpdate'));
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(is_numeric($request->id)){
            $cat = category::find($request->id);
            $cat->delete();
            Session::put('sucess', __('words.msgDelete'));
            return redirect()->back();
        }
        // return view('backend.categories.deleteCategory');
    }

}
