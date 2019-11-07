<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nganh;
use App\Lop;
use App\Monhoc;
use App\Canbo;
use App\Sinhvien;
use App\User;
use App\HocKy;
use App\BuoiTH;
use App\LopHP;
use App\TuanTH;
use App\TuanYC;
use App\DSSV_LHP;
use App\PhanMem;
use App\Phong;
use App\PM_of_Phong;
use App\YeuCau;
use App\YeuCau_lth;
use App\Sapxep;
use App\PhanHoi;
use Carbon\Carbon;
use App\Imports\ImportMon;
use App\Imports\ImportCB;
use App\Imports\ImportLHP;
use App\Imports\ImportSV;
use App\Imports\ImportSVLHP;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\PayUService\Exception;

class PageController extends Controller
{
    public function getIndex(){
    	if (Auth::check()) {
    		$now_hk = HocKy::join('tuan_th', 'hoc_ky.id_hk', 'tuan_th.id_hk')->where('hoc_ky.status', 'Now')->get();
    		$phong = Phong::orderBy('ten_phong', 'asc')->get();

    		$alldatasang = YeuCau::join('can_bo','can_bo.ma_canbo','chitiet_yc.ma_canbo')->join('lop_hp','lop_hp.ma_lophp','chitiet_yc.ma_lophp')->join('tuan_theo_yc','tuan_theo_yc.id_chitietyc','chitiet_yc.id_chitietyc')->join('sap_xep','sap_xep.id_tuanyc','tuan_theo_yc.id_tuanyc')->join('tuan_th','tuan_th.id_tuan','tuan_theo_yc.id_tuan')
            ->where('chitiet_yc.buoi', 'Sáng')->get();
            $alldatachieu= YeuCau::join('can_bo','can_bo.ma_canbo','chitiet_yc.ma_canbo')->join('lop_hp','lop_hp.ma_lophp','chitiet_yc.ma_lophp')->join('tuan_theo_yc','tuan_theo_yc.id_chitietyc','chitiet_yc.id_chitietyc')->join('sap_xep','sap_xep.id_tuanyc','tuan_theo_yc.id_tuanyc')->join('tuan_th','tuan_th.id_tuan','tuan_theo_yc.id_tuan')
            ->where('chitiet_yc.buoi', 'Chiều')->get();

            $monhoc = Monhoc::join('lop_hp', 'lop_hp.ma_mon', 'mon_hoc.ma_mon')->join('sv_hoc_lhp', 'sv_hoc_lhp.ma_lophp', 'lop_hp.ma_lophp')
            ->join('sinh_vien', 'sinh_vien.mssv', 'sv_hoc_lhp.mssv')->where('sinh_vien.id_account', Auth::user()->id)->get();

            $phanhoi = PhanHoi::join('sv_hoc_lhp', 'sv_hoc_lhp.id_sv_lhp', 'phan_hoi.id_sv_lhp')
            ->join('sinh_vien', 'sinh_vien.mssv', 'sv_hoc_lhp.mssv')
            ->join('lop_hp', 'lop_hp.ma_lophp', 'sv_hoc_lhp.ma_lophp')
            ->where('sinh_vien.id_account', Auth::user()->id)->get();
    		// dd($alldatasang);
      //       dd($now_hk);
    		return view('home', compact('now_hk', 'phong', 'alldatasang', 'alldatachieu', 'monhoc', 'phanhoi'));
    	}
    	else return redirect('login');
    }


    public function getChangePass(){
        return view('user.changepassword');
    }

    public function postChangePassword(Request $req){
        $id = Auth::user()->id;
        $user = User::find($id);

        if(\Hash::check($req->oldpassword, $user->password)){

            if($req->password == $req->repassword){
                $user->password == \Hash::make($req->password);
            }
                
            else{
                return redirect()->back()->with('loi', 'Mật khẩu nhập lại không khớp!');
            }  
        }
        else{
            return redirect()->back()->with('loi', 'Mật khẩu cũ không chính xác');
        }
        $user->save();

        return redirect()->back()->with('message', 'Đổi mật khẩu thành công!');
    }

    public function postFeedback(Request $req){
        $id = Auth::user()->id;
        $sv = Sinhvien::where('id_account', $id)->first();
        $lophp = LopHp::where('ma_mon', $req->mon)->first();
        $sv_lophp = DSSV_LHP::where('mssv', $sv->mssv)
        ->where('ma_lophp',$lophp->ma_lophp)->first();

        $fb = new PhanHoi();
        $fb->id_sv_lhp =   $sv_lophp->id_sv_lhp;
        $fb->ten_phanhoi = $req->ten_phanhoi;
        $fb->noidung_phanhoi = $req->noidung_phanhoi;
        if($req->hasFile('mau_don')){
            $file = $req->file('mau_don');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect()->back()->with('message', 'File ảnh không đúng định dạng');
            }
            $name = $file->getClientOriginalName();
            $image = str_random(5)."_".$name;
            while(file_exists("files/".$image))
            {   
                $image = str_random(5)."_".$name;
            }
            $file->move('files/', $image);  
            $fb->mau_don = $image;
        }
        $fb->save();     

        return redirect()->back()->with('message', 'Cập Nhật Thành Công!');
    }

    public function postChapNhan($id){
        $phanhoi = PhanHoi::where('id_phanhoi', $id)->first();
        $phanhoi->status = 1;
        $phanhoi->save();
        return redirect()->route('teacher_feedback');
    }

     public function postTuChoi($id){
        $phanhoi = PhanHoi::where('id_phanhoi', $id)->first();
        $phanhoi->status = 0;
        $phanhoi->save();
        return redirect()->route('teacher_feedback');
    }
}
