<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportMember;
use App\Exports\ExportFormat;
use App\Imports\ImportMember;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Member;
use Carbon\Carbon;

use Session;

class MemberController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Member::all();
        return view('pages.member',compact(['data']));
    }

    public function export() 
    {
        $now=Carbon::now()->format('dmy-His');
        $nameFile="Export Data Member-".$now.".xlsx";
        return Excel::download(new ExportMember, $nameFile);
    }

    public function export_format() 
    {
        $nameFile="Format Export.xlsx";
        return Excel::download(new ExportFormat, $nameFile);
    }

    public function import_excel(Request $request) 
	{
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');
		$name_file = rand().$file->getClientOriginalName();
		$file->move('Import',$name_file);
		Excel::import(new ImportMember, public_path('/Import/'.$name_file));
		Session::flash('success','Import Data Successfully!');

		return redirect('/admin/member');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $data = Member::find($id);
       return view('pages.member.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Member::find($id);
        return view('pages.member.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
			'nik' => 'required',
			'name' => 'required',
			'gender' => 'required',
			'birthday' => 'required',
			'address' => 'required',
		]);
        
        $query=Member::findOrFail($id);
        
        $query->update([
            'nik'=>$request['nik'],
            'name'=>$request['name'],
            'birthday'=>$request['birthday'],
            'gender'=>$request['gender'],
            'address'=>$request['address'],
        ]);

        Session::flash('success','Edit Data Successfully!');

        return redirect('/admin/member');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query=Member::findOrFail($id);
        $query->delete();

        Session::flash('success','Delete Data Successfully!');

        return redirect('/admin/member');
    }


}
