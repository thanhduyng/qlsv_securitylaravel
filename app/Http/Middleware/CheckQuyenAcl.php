<?php

namespace App\Http\Middleware;

use App\qlsv_chucnang;
use Closure;
use Illuminate\Support\Facades\DB;

class CheckQuyenAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $qlsv_chucnang = null)
    {
        // Lay tat ca cac quyen khi user login vao he thong
        // 1.lay tat ca cac vai tro cua user
        // dd($qlsv_chucnang);

        $listVaiTroOfUser = DB::table('users')
            ->join('qlsv_uservavaitros', 'users.id', '=', 'qlsv_uservavaitros.id_user')
            ->join('qlsv_vaitros', 'qlsv_uservavaitros.id_vaitro', '=', 'qlsv_vaitros.id')
            ->where('users.id', auth()->id())
            ->select('qlsv_vaitros.*')
            ->get()->pluck('id')->toArray();

            // dd($listVaiTroOfUser);

        // 2. lất tất cả các chức năng khi user login
        $listVaiTroOfUser = DB::table('qlsv_vaitros')
            ->join('qlsv_vaitrovachucnangs', 'qlsv_vaitros.id', '=', 'qlsv_vaitrovachucnangs.id_vaitro')
            ->join('qlsv_chucnangs', 'qlsv_vaitrovachucnangs.id_chucnang', '=', 'qlsv_chucnangs.id')
            ->where('qlsv_vaitros.id', $listVaiTroOfUser)
            ->select('qlsv_chucnangs.*')
            ->get()->pluck('id')->unique();
        //  dd($listVaiTroOfUser);

        // lấy ra mã màn hình tương ứng check phân quyền

        $checkquyen = qlsv_chucnang::where('ma', $qlsv_chucnang)->value('id');

        // dd($checkquyen);
        //kiểm tra user dduowwjc phép vào màn hình hay ko
        if ($listVaiTroOfUser->contains($checkquyen)) {
            return $next($request);
        }
        return abort(401);
    }
}
