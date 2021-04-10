<?php

namespace App\Http\Controllers;

use App\qlsv_monhoc;
use App\qlsv_worktask;
use App\qlsv_worktaskdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class QlsvWorktaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title="Danh Sách WorkTask";
         $worktask = DB::table("qlsv_worktasks")->where('deleted_at',0)->paginate(2);
		  $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc","id");
		  $worktaskdetail= DB::table("qlsv_worktaskdetails")->get();
        return view("admin/WorkTask/dsworktask", ['worktask' => $worktask,'monhoc' => $monhoc,'worktaskdetail'=>$worktaskdetail,'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Đăng Ký WorkTask ";
		$monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc","id");
		$monhoc1=DB::table("qlsv_monhocs")->where('deleted_at',0)->get();
		$worktask = DB::table("qlsv_worktasks")
		 ->where('deleted_at',0)
		 ->where('id_monhoc',$monhoc1[0]->id)
		 ->max('thutu');
          return view("admin/WorkTask/themworktask",['monhoc' => $monhoc,'title' => $title,'worktask'=>$worktask+1]);
    }

 public function chonmon()
    {
        $title="Chọn Môn Học ";
		$monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc","id");
		 
		 
          return view("admin/WorkTask/chonmon",['monhoc' => $monhoc,'title' => $title]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		date_default_timezone_set("Asia/Ho_Chi_Minh");
        $worktask = new qlsv_worktask();
       
        $worktask->tenworktask = $request->request->get("tenworktask");
		$worktask->id_monhoc=$request->request->get("id_monhoc");
		$worktask->thutu=$request->request->get("thutu");
		$worktask->nguoitao="haubeo";
		$worktask->nguoisua="haubeo";
		$worktask->created_at=Carbon::now();
		$worktask->deleted_at=0;
        $worktask->save();
		$worktaskdetail = new qlsv_worktaskdetail();
        $ten=$request->request->get("ten");
		//dd($ten);
		
		for($i=0;$i<count($ten);$i++){
		 $worktaskdetail = new qlsv_worktaskdetail();
		 if($ten[$i]!=null){
	
		$worktaskdetail->ten=$ten[$i];
		//dd($worktask);
		$worktaskdetail->id_worktask=$worktask->id;
		$worktaskdetail->nguoitao="haubeo";
		$worktaskdetail->nguoisua="haubeo";
		$worktaskdetail->deleted_at=0;
		$worktaskdetail->created_at=Carbon::now();
		//$worktaskdetail->sothutu=$i+1;
        $worktaskdetail->save();
		//dd($worktaskdetail);
		$worktaskdetail = new qlsv_worktaskdetail();
		
		 }
		}
		return redirect('/worktask/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */
	 
	 public function search(qlsv_worktask $qlsv_worktask,Request $request)
    {
        $term =$request->request->get("tenworktask");
        $worktask = DB::table('qlsv_worktasks')->where('tenworktask','LIKE','%'.$term.'%')
                      ->paginate(2);
					  $title="Danh Sách WorkTask Tìm Được";
					    $worktask->withPath('/find?tenworktask='.$term);
						 $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc","id");
					   return view("admin/WorkTask/dsworktask", ['worktask' => $worktask,'title' => $title,'monhoc' => $monhoc]);
    }
	 
	  public function searchmon(qlsv_worktask $qlsv_worktask,Request $request)
    {
		$keyword=$request->get("search");
		 $monhocs = DB::table("qlsv_monhocs")->where('tenmonhoc', 'LIKE', '%'.$keyword.'%')->get();
		  $response = array();
      foreach($monhocs as $monhoc){
         $response[] = array("id"=>$monhoc->id,"value"=>$monhoc->tenmonhoc,"ghichu"=>$monhoc->ghichu);
     }

      return response()->json(['response'=>$response]);
		
	}
     
    public function searchmon1(qlsv_worktask $qlsv_worktask,Request $request)
    {
		$keyword=$request->get("search1");
		 $monhocs = DB::table("qlsv_monhocs")->where('tenmonhoc', 'LIKE', '%'.$keyword.'%')->get();
		  $response = array();
      foreach($monhocs as $monhoc){
         $response[] = array("id"=>$monhoc->id,"value"=>$monhoc->tenmonhoc,"ghichu"=>$monhoc->ghichu);
     }

      return response()->json(['response'=>$response]);
		
	}

	  public function chonmonhoc(qlsv_worktask $qlsv_worktask,Request $request)
    {
       
        $id =$request->request->get("id");
		//$monhoc=DB::table("qlsv_monhocs")->where('id',$term)->get();
		$monhoc = qlsv_monhoc::find($id);
		//dd($monhoc);
        $worktask = DB::table('qlsv_worktasks')
		->join('qlsv_monhocs','qlsv_worktasks.id_monhoc','=','qlsv_monhocs.id')
		->where('qlsv_monhocs.id',$id)
		->where('qlsv_worktasks.deleted_at','=',0)
		->pluck("qlsv_worktasks.tenworktask","qlsv_worktasks.id");
                       $worktaskdetail = DB::table('qlsv_worktaskdetails')->get();
					  $title="Danh Sách WorkTask Tìm Được";
					 // dd($worktask);
					   return view("admin/WorkTask/dsworktaskmon", ['worktask' => $worktask,'title' => $title,'monhoc' => $monhoc,'worktaskdetail' => $worktaskdetail]);
    }
	 public function worktaskmon(qlsv_worktask $qlsv_worktask,Request $request,$id)
    {
        //$id =$request->request->get("id");
		//$monhoc=DB::table("qlsv_monhocs")->where('id',$term)->get();
		$monhoc = qlsv_monhoc::find($id);
		//dd($monhoc);
        $worktask = DB::table('qlsv_worktasks')
		->join('qlsv_monhocs','qlsv_worktasks.id_monhoc','=','qlsv_monhocs.id')
		->where('qlsv_monhocs.id',$id)->pluck("qlsv_worktasks.tenworktask","qlsv_worktasks.id");
                       $worktaskdetail = DB::table('qlsv_worktaskdetails')->get();
					  $title="Danh Sách WorkTask Tìm Được";
					 // dd($worktask);
					   return view("admin/WorkTask/dsworktaskmon", ['worktask' => $worktask,'title' => $title,'monhoc' => $monhoc,'worktaskdetail' => $worktaskdetail]);
    }
	 
    public function show(qlsv_worktask $qlsv_worktask,Request $request)
    {
        $name=$request->name;
		 $sothutu = DB::table('qlsv_worktasks')
		 ->join('qlsv_monhocs','qlsv_worktasks.id_monhoc','=','qlsv_monhocs.id')
		 ->where('qlsv_monhocs.id',$name)
		 ->where('qlsv_worktasks.deleted_at',0)
		 ->where('qlsv_monhocs.deleted_at',0)
		 ->max('qlsv_worktasks.thutu');
		 $sothutu=$sothutu+1;
		return response()->json(['success'=>$sothutu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_worktask $qlsv_worktask,$id)
    {
         $title="Sửa WorkTask";
         $worktask = qlsv_worktask::find($id);
		  $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc","id");
		  $worktaskdetail= DB::table("qlsv_worktaskdetails")->get();
        return view("admin/WorkTask/editworktask", ['worktask' => $worktask,'monhoc' => $monhoc,'worktaskdetail'=>$worktaskdetail,'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_worktask $qlsv_worktask,$id)
    {
		  date_default_timezone_set("Asia/Ho_Chi_Minh");
         $worktaske = qlsv_worktask::find($id);

        $worktaske->tenworktask = $request->request->get("tenworktask");
		$worktaske->thutu=$request->request->get("thutu");
		$worktaske->id_monhoc=$request->request->get("id_monhoc");
		$worktaske->updated_at=Carbon::now();
        $worktaske->save();
		
		$worktaskdetail = new qlsv_worktaskdetail();
        
	     $ten=$request->request->get("ten");
		
		$worktaskdetail = DB::table("qlsv_worktaskdetails")->where('id_worktask',$worktaske->id)->get();
		
		foreach($worktaskdetail as $wdt){
		 DB::table('qlsv_worktaskdetails')->where('id',$wdt->id)->delete();
		 
		}
		for($i=0;$i<count($ten);$i++){
		 
		 if($ten[$i]!=null){
			 $worktaskdetail = new qlsv_worktaskdetail();
	    $worktaskdetail->ten=$ten[$i];
		$worktaskdetail->id_worktask=$worktaske->id;
		//$worktaskdetail->sothutu=$i+1;
		$worktaskdetail->nguoitao="haubeo";
		$worktaskdetail->nguoisua="haubeo";
		$worktaskdetail->updated_at=Carbon::now();
		$worktaskdetail->deleted_at=0;
        $worktaskdetail->save();
		
		
		 }
		}
		 return redirect('/worktask/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_worktask $qlsv_worktask,$id)
    {
		  date_default_timezone_set("Asia/Ho_Chi_Minh");
        $worktask = qlsv_worktask::find($id);

        $worktask->deleted_at=1;
        $worktask->save();
        
         return redirect('/worktask/index');
    }
}
