<?php

namespace App\Http\Controllers;

use App\qlsv_diemthi;
use App\qlsv_lophoc;
use App\qlsv_sinhvienlophoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Exit_;

class QlsvDiemthiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Danh sách điểm thi";
        $idlop = $request->get('id_lophoc');
        $qlsv_sinhvienlophoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->where('id_lophoc', $idlop)->where('delete_at', 0)->select('qlsv_sinhviens.id', 'qlsv_sinhviens.hovaten');
        $qlsv_kieuthi = DB::table('qlsv_kieuthis')->pluck('kieuthi', 'id');
        return view('admin/diemthi/viewdiemthi', compact(['qlsv_sinhvienlophoc', 'qlsv_kieuthi', 'title', 'idlop']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = "Danh sách điểm thi";
        $idlop = $request->get('id_lophoc');
        if (isset($idlop)) {
        } else {
            $idlop = 1;
        }

        // dd($idlop);
        $qlsv_sinhvienlophoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->leftJoin('qlsv_diemthis', 'qlsv_diemthis.id_sinhvienlophoc', '=', 'qlsv_sinhvienlophocs.id')
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->where('qlsv_sinhviens.deleted_at', 0)
            ->select('qlsv_sinhvienlophocs.*', 'qlsv_sinhviens.id', 'qlsv_sinhviens.hovaten', 'qlsv_diemthis.id_sinhvienlophoc', 'qlsv_diemthis.*')
            ->get();
        // dd($qlsv_sinhvienlophoc);
        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        // $qlsv_lophoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');
        $qlsv_kieuthi = DB::table('qlsv_kieuthis')->pluck('kieuthi', 'id');
        return view('admin/diemthi/themdiemthi', compact(['qlsv_sinhvienlophoc', 'qlsv_kieuthi', 'title', 'idlop', 'qlsv_lophoc']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_sinhvienlophocs =    $request['id_sinhvienlophoc'];
        //  dd($id_sinhvienlophocs);
        $diemlythuyets =  $request['diemlythuyet'];
        $diemthuchanhs =  $request['diemthuchanh'];
        $idlop = $request['idlop'];
        for ($i = 0; $i < count($id_sinhvienlophocs); $i++) {
            $diemthi = DB::table('qlsv_diemthis')
                ->where('id_sinhvienlophoc', '=', $id_sinhvienlophocs[$i])->get();
            //dd($diemthi);
            if (count($diemthi) == 1) {
                $data = qlsv_diemthi::find($diemthi[0]->id);
                $data->diemlythuyet = $diemlythuyets[$i];
                $data->diemthuchanh = $diemthuchanhs[$i];
                $data->ngaychodiem = Carbon::now("Asia/Ho_Chi_Minh");
                $data->save();
            } else {
                $data = new qlsv_diemthi();
                $data->id_sinhvienlophoc = $id_sinhvienlophocs[$i];
                $data->diemlythuyet = $diemlythuyets[$i];
                $data->diemthuchanh = $diemthuchanhs[$i];
                $data->ngaychodiem = Carbon::now("Asia/Ho_Chi_Minh");
                $data->id_kieuthi = 1;
                $data->deleted_at = 0;
                $data->save();
            }
        }
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_diemthi  $qlsv_diemthi
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_diemthi $qlsv_diemthi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_diemthi  $qlsv_diemthi
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_diemthi $qlsv_diemthi, $id)
    {
        $title = "Sửa điểm thi";
        $qlsv_diemthi = DB::table('qlsv_diemthis')->find($id);

        // dd($qlsv_diemthi);
        $qlsv_kieuthi = DB::table('qlsv_kieuthis')->pluck('kieuthi', 'id');
        $qlsv_lophoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');
        // $qlsv_lophoc = qlsv_lophoc::pluck('tenlophoc', 'id');
        $qlsv_sinhvien = DB::table('qlsv_sinhviens')->pluck('hovaten', 'id');
        $qlsv_sinhvienlophoc = DB::table('qlsv_sinhvienlophocs')->pluck('id_sinhvien', 'id_lophoc', 'id');
        return view('admin/diemthi/editdiemthi', [
            'qlsv_diemthi' => $qlsv_diemthi,
            'qlsv_kieuthi' => $qlsv_kieuthi,
            'qlsv_sinhvien' => $qlsv_sinhvien,
            'qlsv_lophoc' => $qlsv_lophoc,
            'qlsv_sinhvienlophoc' => $qlsv_sinhvienlophoc,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_diemthi  $qlsv_diemthi
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, qlsv_diemthi $qlsv_diemthi)
    {
        $data = qlsv_diemthi::find($request->id);
        $data->diemlythuyet = $request->diemlythuyet;
        $data->diemthuchanh = $request->diemthuchanh;
        $data->ngaychodiem = $request->ngaychodiem;
        $data->ghichu = $request->ghichu;
        $data->id_kieuthi = $request->id_kieuthi;
        $qlsv_lophop = DB::table('qlsv_lophocs')->find($request->id_lophoc);
        //dd($qlsv_lophop);
        $qlsv_sinhvien = DB::table('qlsv_sinhviens')->find($request->id_sinhvien);
        $data->id_sinhvienlophoc = $qlsv_lophop->id;
        $data->id_sinhvienlophoc = $qlsv_sinhvien->id;
        $data->update(["updated_at" => Carbon::now("Asia/Ho_Chi_Minh")]);
        $data->save();
        return redirect('diemthi/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_diemthi  $qlsv_diemthi
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_diemthi $qlsv_diemthi, $id)
    {

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $qlsv_diemthi = DB::table('qlsv_diemthis')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        return response()->json(['_typeMessage' => 'deleteSuccess']);
    }
}