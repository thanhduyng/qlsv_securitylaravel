<?php

namespace App\Http\Controllers;

use App\qlsv_nhom;
use App\qlsv_vaitro;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $user;
    private $qlsv_vaitro;
    public function __construct(User $user, qlsv_vaitro $qlsv_vaitro)
    {
        $this->user = $user;
        $this->qlsv_vaitro = $qlsv_vaitro;
    }

    public function index(Request $request)
    {
        $title = "Danh sách user";
        $users = $this->user->select('id','name','email')->where('deleted_at',0)->get();
        return view('admin.dsuser', compact(['users', 'title']));
    }

    public function edit($id)
    {
        $title = "Danh sách user";
        $users = User::find($id);
        $nhoms = DB::table('qlsv_nhoms')->pluck('ten', 'id');
        $lopHoc = qlsv_nhom::find($id);
        $listRowOfUser = DB::table('qlsv_uservavaitros')->where('id_user',  $id)->pluck('id_vaitro');
        $listRowOfNhom = DB::table('qlsv_nhomvausers')->where('iduser',  $id)->pluck('idnhom');
        // dd($listRowOfUser);
        $qlsv_vaitros = $this->qlsv_vaitro->all();
        return view('admin.edituser', compact(['qlsv_vaitros','nhoms', 'users', 'listRowOfUser','listRowOfNhom','title']));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->user->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            DB::table('qlsv_uservavaitros')->where('id_user', $id)->delete();
            $userCreate = $this->user->find($id);
            
            // $userCreate->vaitros()->attach($request->vaitros);

             $qlsv_vaitros = $request->vaitros;
            foreach($qlsv_vaitros as $vaitroId){
                DB::table('qlsv_uservavaitros')->insert([
                    'id_user' => $userCreate->id,
                    'id_vaitro' => $vaitroId
                ]);
            }

            $nhoms = $request->nhoms;
            foreach($nhoms as $nhomId){
                DB::table('qlsv_nhomvausers')->insert([
                    'iduser' =>$userCreate->id,
                    'idnhom' => $nhomId
                ]);
            }
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Loi:'.$exception->getMessage() . $exception->getLine());
        }
    }

    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $users = DB::table('users')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        return redirect()->route('user.index');
    }
}
