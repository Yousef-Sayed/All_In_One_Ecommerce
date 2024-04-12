<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use App\Models\backend\Logs;
use App\Models\backend\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = News::whereNull('deleted_at')->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $output = '<div class="dropdown show">';
                        $output .= '<a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#051922;color:white;">';
                        $output .=     ''.__('words.acion').'';
                        $output .= '</a>';
                        $output .= '<div class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink">';
                            if($row->status == '0'){
                                    $output .= '<a class="btn btn-info text-white btn-sm font-weight-bold w-75 m-2" href="'. route('news.active',$row->id).'"><i class="fas fa-eye"></i>  ' .__('words.show').'</a>';
                            }else{
                                    $output .= '<a class="btn btn-warning text-white btn-sm font-weight-bold w-75 m-2" href="'. route('news.disAvtive',$row->id).'"><i class="fas fa-eye-slash"></i>  ' .__('words.hide').'</a>';
                                }
                        $output .= '<a class="btn btn-success text-white btn-sm font-weight-bold w-75 m-2" href="'. route('news.edit',$row->id).'"><i class="fas fa-edit"></i>  ' .__('words.edit').'</a>';
                        $output .=    '<a class="btn text-white btn-sm font-weight-bold w-75 m-2"
                                            data-toggle="modal"data-id="'. $row->id .'" id="btnDelete" data-target="#deleteModal" style="background-color:red">
                                            <i class="far fa-trash-alt"></i>  '.__('words.delete').'
                                        </a>';
                        $output .= '</div>';
                    $output .= '</div>';
                return $output ;
            })
            ->addColumn('body', function ($row) {
                return strip_tags(html_entity_decode($row->body));
            })
            ->rawColumns(['body'])
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->addColumn('show',function ($data){
                if($data->status == '1'){
                    return '<div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-circle" style="color: #6cd404; font-size: 14px; margin:0 3px"></i>
                                <span style="font-size: 14px;">'. __("words.visiable") .'</span>
                            </div>';
                }else{
                    return '<div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-circle" style="color: #FFD43B; font-size: 14px; margin:0 3px"></i>
                                <span style="font-size: 14px;">'. __("words.invisible") .'</span>
                            </div>';
                }
            })
            ->rawColumns(['show','action'])
            ->make(true);
        }
        return view('backend.news.news');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Active($value)
    {
        News::where('id',$value)->update([
            'status' => '1'
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgShowNewsAr'),
                'messageEn' => __('words.msgShowNewsEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
    public function disActive($value)
    {
        News::where('id',$value)->update([
            'status' => '0'
        ]);
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgHideNewsAr'),
                'messageEn' => __('words.msgHideNewsEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    public function create()
    {
        return view('backend.news.addNews');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:30|string',
            'content' => 'required|min:20|max:1000|string',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid(). '-' . $file->getClientOriginalName();
            $file->move(public_path('images/news'),$filename);
            $path = "images/news/" . $filename;
        }else{
            $path = "images/news/default.jpg";
        }
        News::create([
            'title' => $request->title,
            'body' => $request->content,
            'image' => $path,
        ]);
        Session::put('sucess', __('words.msgAdd'));
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgAddNewsAr'),
                'messageEn' => __('words.msgAddNewsEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $news = News::find($id);
        return view('backend.news.editNews',compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:30|string',
            'content' => 'required|min:20|max:1000|string',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);
        if($validator->fails()){
            Session::put('errors', $validator->messages());
            return back();
        }
        if ($request->hasFile('image')) {
                $img = News::where('id', $id);
                if(basename($img->first()->image) != 'default.jpg'){
                    unlink(public_path($img->first()->image));
                }
                $file = $request->file('image');
                $filename = Str::uuid(). '-' . $file->getClientOriginalName();
                $file->move(public_path('images/news'),$filename);
                $path = "images/news/" . $filename;

                News::where('id',$id)->update([
                    'title' => $request->title,
                    'body' => $request->content,
                    'image' => $path,
            ]);
        }else{
            News::where('id',$id)->update([
                'title' => $request->title,
                'body' => $request->content,
            ]);
        }
        Session::put('sucess', __('words.msgUpdate'));
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgUpdateNewsAr'),
                'messageEn' => __('words.msgUpdateNewsEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
    public function delete(string $id,Request $request)
    {
        News::where('id',$request->id)->delete();
        Session::put('sucess', __('words.msgDelete'));
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgDeleteNewsAr'),
                'messageEn' => __('words.msgDeleteNewsEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }

    public function restore($id){
        News::withTrashed()->where('id', $id)->restore();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgRestoreNewsAr'),
                'messageEn' => __('words.msgRestoreNewsEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
    public function permanentDeletion($id){
        $data = News::withTrashed()->where('id', $id);
        if(basename($data->first()->image) != 'default.jpg'){
            unlink(public_path($data->first()->image));
        }
        $data->forceDelete();
        if(Auth::guard('admin')->user()->role != "-1"){
            Logs::create([
                'messageAr' => __('words.msgPermanentDeletedNewsAr'),
                'messageEn' => __('words.msgPermanentDeletedNewsEn'),
                'admin_id' => Auth::guard('admin')->user()->id,
            ]);
        }
        return redirect()->back();
    }
    public function deleted(Request $request){

        if($request->ajax())
        {
            $data = News::onlyTrashed()->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<div class=" d-flex align-content-center justify-content-center">';
                $actionBtn .= '<a class="btn-success btn-sm font-weight-bold" href="'. route('news.restore',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.restor').'</a>';
                $actionBtn .= '<a class="btn-danger btn-sm font-weight-bold" href="'. route('news.permanentDeletion',$row->id).'"><i class="far fa-edit"></i>  ' .__('words.permanentDeletion').'</a>';
                return $actionBtn;
            })
            ->addColumn('body', function ($row) {
                return strip_tags(html_entity_decode($row->body));
            })
            ->rawColumns(['body','action'])
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->make(true);
        }
        return view('backend.news.deleted');
    }
}
