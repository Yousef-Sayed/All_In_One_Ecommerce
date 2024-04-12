<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use App\Models\backend\Logs;
use Illuminate\Http\Request;
use App\Models\backend\category;
use App\Models\backend\Prodecut;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProdecutController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Prodecut::select('*');
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('prodecut.edit',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.edit').'</a>';
                $actionBtn .= '<a class="btn btn-danger text-white btn-sm font-weight-bold"
                                    data-toggle="modal"data-id="'. $row->id .'" id="btnDelete" data-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i>  '.__('words.delete').'
                                </a>
                            </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->editColumn('categoryId', function ($date) {
                if(Session::get('lang') == 'ar' ){
                    return category::find($date->categoryId)->nameAr;
                }else{
                    return category::find($date->categoryId)->nameEn;
                }
            })
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->make(true);
        }
        return view('backend.prodecuts.prodecut');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.prodecuts.addProdecut');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'nameEn' => 'required|min:3|string|unique:prodecuts',
            'discriptionEn' => 'required|min:20|string',
            'nameAr' => 'required|min:3|string|unique:prodecuts',
            'discriptionAR' => 'required|min:20|string',
            'quantity' => 'required',
            'categoryId' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);

        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }

        $is_available = 0;
        $path = "";
        if((int)$request->quantity > 0){
            $is_available = 1;
        }else{
            $is_available = 0;
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid(). '-' . $file->getClientOriginalName();
            $file->move(public_path('images/prodecuts'),$filename);
            $path = "images/prodecuts/" . $filename;
        }else{
            $path = "images/prodecuts/default.jpg";
        }

        Prodecut::create([
            'nameEn' => $request->nameEn,
            'descriptionEn' => $request->discriptionEn,
            'colorEn' => ucwords($request->colorEn),
            'quantity' => $request->quantity,
            'nameAr' => $request->nameAr,
            'descriptionAr' => $request->discriptionAR,
            'colorAr' => $request->colorAr,
            'image' => $path,
            'categoryId' => $request->catID,
            'is_available' => $is_available,
            'price' => $request->price,
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgAddProAr'),
                'messageEn' => __('words.msgAddProEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        Session::put('sucess', __('words.msgAdd'));
        return redirect()->route('prodecut.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodecut $prodecut)
    {
        $product = Prodecut::find($prodecut->id);
        return view('backend.prodecuts.editProduct',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodecut $prodecut) : RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'nameEn' => 'required|min:3|string|unique:prodecuts,nameEn,'.$prodecut->id,
            'discriptionEn' => 'required|min:20|string',
            'nameAr' => 'required|min:3|string|unique:prodecuts,nameAr,'.$prodecut->id,
            'discriptionAR' => 'required|min:20|string',
            'quantity' => 'required',
            'catID' => 'required',
            'price' => 'required',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }

        $is_available = 0;
        if((int)$request->quantity > 0){
            $is_available = 1;
        }else{
            $is_available = 0;
        }
        if ($request->hasFile('image')) {
                $img = Prodecut::where('id', $prodecut->id);
                if(basename($img->first()->image) != 'default.jpg'){
                    unlink(public_path($img->first()->image));
                }
                $file = $request->file('image');
                $filename = Str::uuid(). '-' . $file->getClientOriginalName();
                $file->move(public_path('images/prodecuts'),$filename);
                $path = "images/prodecuts/" . $filename;

                Prodecut::where('id',$prodecut->id)->update([
                'nameEn' => $request->nameEn,
                'descriptionEn' => $request->discriptionEn,
                'colorEn' => ucwords($request->colorEn),
                'quantity' => $request->quantity,
                'nameAr' => $request->nameAr,
                'descriptionAr' => $request->discriptionAR,
                'colorAr' => $request->colorAr,
                'image' => $path,
                'categoryId' => $request->catID,
                'is_available' => $is_available,
                'price' => $request->price,
            ]);
        }else{
            Prodecut::where('id',$prodecut->id)->update([
                'nameEn' => $request->nameEn,
                'descriptionEn' => $request->discriptionEn,
                'colorEn' => ucwords($request->colorEn),
                'quantity' => $request->quantity,
                'nameAr' => $request->nameAr,
                'descriptionAr' => $request->discriptionAR,
                'colorAr' => $request->colorAr,
                'categoryId' => $request->catID,
                'is_available' => $is_available,
                'price' => $request->price,
            ]);
        }
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgUpdateProAr'),
                'messageEn' => __('words.msgUpdateProEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        Session::put('sucess', __('words.msgUpdate'));
        return redirect()->route('prodecut.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(is_numeric($request->id)){
            $product = Prodecut::find($request->id);
            $product->delete();
            Session::put('sucess', __('words.msgDelete'));
            if(Auth::guard('admin')->user()->role != "-1"){
                Logs::create([
                    'messageAr' => __('words.msgDeletedProAr'),
                    'messageEn' => __('words.msgDeletedProEn'),
                    'admin_id' => Auth::guard('admin')->user()->id,
                ]);
            }
            return redirect()->back();
        }
    }
    public function deleted(Request $request){
        if($request->ajax())
        {
            $data = Prodecut::onlyTrashed()->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('prodecut.restore',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.restor').'</a>';
                $actionBtn .= '<a class="btn-danger btn-sm font-weight-bold" href="'. route('prodecut.permanentDeletion',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.permanentDeletion').'</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->make(true);
        }
        return view('backend.prodecuts.deleted');
    }
    public function restore($id){
        Prodecut::withTrashed()->where('id', $id)->restore();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgRestoreProAr'),
                'messageEn' => __('words.msgRestoreProEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
    public function permanentDeletion($id){
        $data = Prodecut::withTrashed()->where('id', $id);
        if(basename($data->first()->image) != 'default.jpg'){
            unlink(public_path($data->first()->image));
        }
        $data->forceDelete();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgPermanentDeletedProAr'),
                'messageEn' => __('words.msgPermanentDeletedProEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
}
