<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    function index()
    {
     $users = DB::table('users')->get();
     return view('export_excel')->with('users', $users);
    }

    function excel()
    {
     $users = DB::table('users')->get()->toArray();
     $users_array[] = array('name', 'email');
     foreach($users as $users)
     {
      $users_array[] = array(
       'name'  => $users->name,
       'email'   => $users->email
      );
     }

     
     Excel::create('users Data', function($excel) use ($users_array){
      $excel->setTitle('users Data');
      $excel->sheet('users Data', function($sheet) use ($users_array){
       $sheet->fromArray($users_array, null, 'A1', false, false);
      });
     })->download('xlsx');
    }
}
