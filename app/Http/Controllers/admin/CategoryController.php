<?php

namespace App\Http\Controllers\admin;

use App\Models\backend\Prodecut;
use Illuminate\Support\Str;
use App\Models\backend\Logs;
use Illuminate\Http\Request;
use App\Models\backend\category;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
            'nameEn' => 'required|min:3|string|unique:categories,nameEn',
            'discriptionEn' => 'required|min:20|string',
            'nameAr' => 'required|min:3|string|unique:categories,nameAr',
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
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgAddCatAr'),
                'messageEn' => __('words.msgAddCatEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        Session::put('sucess', __('words.msgAdd'));
        return redirect()->route('category.index');
    }

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
            'nameEn' => 'required|min:3|string|unique:categories,nameEn,'.$category->id,
            'discriptionEn' => 'required|min:20|string',
            'nameAr' => 'required|min:3|string|unique:categories,nameAr,'.$category->id,
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
            if(basename($img->first()->image) != 'default.jpg'){
                unlink(public_path($img->first()->image));
            }
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
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgUpdateCatAr'),
                'messageEn' => __('words.msgUpdateCatEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
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
            Prodecut::where('categoryId',$request->id)->delete();
            $cat->delete();
            Session::put('sucess', __('words.msgDelete'));
            if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgDeletedCatAr'),
                'messageEn' => __('words.msgDeletedCatEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
            return redirect()->back();
        }
        // return view('backend.categories.deleteCategory');
    }

    public function deleted(Request $request){

        if($request->ajax())
        {
            $data = category::onlyTrashed()->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('category.restore',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.restor').'</a>';
                $actionBtn .= '<a class="btn-danger btn-sm font-weight-bold" href="'. route('category.permanentDeletion',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.permanentDeletion').'</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->make(true);
        }
        return view('backend.categories.deleted');
    }

    public function restore($id){
        category::withTrashed()->where('id', $id)->restore();
        Prodecut::withTrashed()->where('categoryId', $id)->restore();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgRestoreCatAr'),
                'messageEn' => __('words.msgRestoreCatEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    public function permanentDeletion($id){
        $data = category::withTrashed()->where('id', $id);
        if(basename($data->first()->image) != 'default.jpg'){
            unlink(public_path($data->first()->image));
        }
        Prodecut::where('categoryId',$id)->forceDelete();
        $data->forceDelete();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgPermanentDeletedCatAr'),
                'messageEn' => __('words.msgPermanentDeletedCatEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
}
