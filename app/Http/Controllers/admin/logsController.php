<?php

namespace App\Http\Controllers\admin;

use App\Models\backend\Logs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class logsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Logs::select('*')->orderBy('id','desc');

            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $name = Admin::where('id',$row->admin_id)->first();
                if(Session::get('lang') == 'ar'){
                    return $row->messageAr . $name->name . ' ' . 'في ' .$row->created_at->format('d-m-Y - h:m:s A') ;
                }else{
                    return $row->messageEn . $name->name . ' ' . 'In ' .$row->created_at->format('d-m-Y - h:m:s A') ;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('backend.logs.logs');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
