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
use App\ChitietYC;
use App\YeuCau_lth;
use App\YeuCauPM;
use App\YeuCau;
use App\Diemdanh;
use Carbon\Carbon;
use App\Sapxep;
use App\PhanHoi;
use Illuminate\Support\Facades\Auth;
use App\Services\PayUService\Exception;
class TeacherController extends Controller
{
	public function teacher_dashboard(){
		if (Auth::check() != null){
			if (Auth::user()->role == "Lecturers") {
				return view('teacher.dashboard');
			}
			return redirect('home'); 
		}
		return redirect('login');    	
	}

	public function teacher_noti(){
		if (Auth::check() != null){
			if (Auth::user()->role == "Lecturers") {
				return view('teacher.noti');
			}
			return redirect('home'); 
		}
		return redirect('login');    	
	}


	public function teacher_feedback(){
		if (Auth::check() != null){
			if (Auth::user()->role == "Lecturers") {
				$macanbo = Canbo::where('id_account', Auth::user()->id)->get();
				$lophp = LopHP::join('mon_hoc', 'mon_hoc.ma_mon', 'lop_hp.ma_mon')->join('can_bo','can_bo.ma_canbo', 'lop_hp.ma_canbo')->get();
				return view('teacher.feedback', compact('macanbo', 'lophp'));
			}
			return redirect('home'); 
		}
		return redirect('login');    	
	}


	public function teacher_lhp(){
		if (Auth::check() != null){
			if (Auth::user()->role == "Lecturers") {
				$macanbo = Canbo::where('id_account', Auth::user()->id)->get();
				$lophp = LopHP::join('mon_hoc', 'mon_hoc.ma_mon', 'lop_hp.ma_mon')->join('can_bo','can_bo.ma_canbo', 'lop_hp.ma_canbo')->get();
				$phanmem= PhanMem::orderBy('ten_pm','asc')->get();

				$tuan = TuanTH::get();
				return view('teacher.lhp', compact('lophp', 'macanbo','phanmem','tuan'));
			}
			return redirect('home'); 
		}
		return redirect('login');    	
	}

	public function addYeucaulth(Request $req){

		$maCB = Canbo::where('id_account', Auth::user()->id)->get();
		foreach ($maCB as $mcb) {
			$yeucaulth = new YeuCau_lth;
			$yeucaulth->status = "Đang chờ";
			$yeucaulth->save();
			$idYC = $yeucaulth->id;

			$chitietYC = new ChitietYC;
			$chitietYC->ma_canbo = $mcb->ma_canbo;
			$chitietYC->id_yeucau = $idYC;
			$chitietYC->ma_lophp = $req->mhp;
			$chitietYC->thu = $req->thu;
			$chitietYC->buoi = $req->buoi;
			$chitietYC->save();
			$idChitietYC = $chitietYC->id;

			foreach ($req->pm as $phanmem) {
				$ycpm = new YeuCauPM;
				$ycpm->id_chitietyc = $idChitietYC;
				$ycpm->id_pm = $phanmem;
				$ycpm->save();
			}

			foreach ($req->tuan as $tuan) {
				$tuanth = new TuanYC;
				$tuanth->id_chitietyc = $idChitietYC;
				$tuanth->id_tuan = $tuan;
				$tuanth->save();

				$sapxep = new Sapxep();
				$sapxep->id_tuanyc = $tuan;
				$sapxep->save();
			}

			return redirect()->back()->with('Added','Thêm thành công!');
		}  	
	}



    // ====================================================diem danh
	public function teacher_attendance(Request $req){
		if (Auth::check() != null){
			if (Auth::user()->role == "Lecturers") {
				$macanbo = Canbo::where('id_account', Auth::user()->id)->get();
				$lophp = LopHP::join('mon_hoc', 'mon_hoc.ma_mon', 'lop_hp.ma_mon')->join('can_bo','can_bo.ma_canbo', 'lop_hp.ma_canbo')->get();

				return view('teacher.attendance', compact('lophp', 'macanbo'));
			}
			return redirect('home'); 
		}
		return redirect('login');
	}

	public function reload_Teacher_attendance(Request $req){
		$dssv = DSSV_LHP::join('sinh_vien','sv_hoc_lhp.mssv','sinh_vien.mssv')->join('lop_hp','sv_hoc_lhp.ma_lophp','lop_hp.ma_lophp')->where('sv_hoc_lhp.ma_lophp', $req->lhp_id)->orderBy('sv_hoc_lhp.mssv','asc')->get();
		$tuan = TuanYC::join('chitiet_yc','tuan_theo_yc.id_chitietyc','chitiet_yc.id_chitietyc')->join('tuan_th','tuan_th.id_tuan','tuan_theo_yc.id_tuan')->where('chitiet_yc.ma_lophp',$req->lhp_id)->get();
		$diemdanh = Diemdanh::join('sv_hoc_lhp','sv_hoc_lhp.id_sv_lhp','diem_danh.id_sv_lhp')->where('sv_hoc_lhp.id_sv_lhp', $req->lhp_id)->get();
		$i = 0;
		echo "<table id=\"example222\" class=\"mdl-data-table table-responsive\" style=\"width:100%\">\n";
		echo "<thead>\n";
		echo "<tr>\n";
		echo "<th>STT</th>\n";
		echo "<th>MSSV</th>\n";
		echo "<th>Họ tên</th>\n";
		foreach($tuan as $t){
			echo "<th>".$t->stt_tuan."</th>\n";
		}
		echo "</tr>\n";
		echo "</thead>\n";
		echo "<tbody>\n";
		foreach($dssv as $sv){
			echo "<tr>\n";
			echo "<td class=\"text-center\">".($i = $i+1)."</td>\n";
			echo "<td>".$sv->mssv."</td>\n";
			echo "<td>".$sv->ten_sv."</td>\n";
			foreach($tuan as $t){
				$maCB = Canbo::where('id_account', Auth::user()->id)->first();
				$dd= Diemdanh::where('id_sv_lhp', $sv->id_sv_lhp)
				->where('id_tuanyc', $t->id_tuanyc)
				->where('ma_canbo', $maCB->ma_canbo)
				->first();

				echo "<td>\n";
				if($dd ){
					echo "<input type=\"checkbox\" checked onclick=\"checkDD('".$sv->id_sv_lhp."', '".$t->id_tuanyc."')\" id=\"".$sv->id_sv_lhp."-".$t->id_tuanyc."\">\n";
				}
				else{
					echo "<input type=\"checkbox\" onclick=\"checkDD('".$sv->id_sv_lhp."', '".$t->id_tuanyc."')\" id=\"".$sv->id_sv_lhp."-".$t->id_tuanyc."\">\n";
				}
				echo "<label for=\"".$sv->id_sv_lhp."-".$t->id_tuanyc."\"> </label>\n";
				echo "</td>\n";
			}
			echo "</tr>\n";
		}

		echo "</tbody>\n";

		echo "<tfoot>\n";
		echo "<tr>\n";
		echo "\n";
		echo "<th>STT</th>\n";
		echo "<th>MSSV</th>\n";
		echo "<th>Họ tên</th>\n";
		foreach($tuan as $t){
			echo "<th>".$t->stt_tuan."</th>\n";
		}
		echo "</tr>\n";
		echo "</tfoot>\n";
		echo "</table>";
	}

	public function addAttendance(Request $req)
	{
    	// $idsvlhp = DSSV_LHP::where('mssv', $req->mssv)->where('ma_lophp', $req->malhp)->get();
		$maCB = Canbo::where('id_account', Auth::user()->id)->first();

		$diemdanh = new Diemdanh;
		$diemdanh->id_sv_lhp = $req->mssv;
		$diemdanh->id_tuanyc = $req->tuan;
		$diemdanh->ma_canbo = $maCB->ma_canbo;
		$diemdanh->save();

	}

	public function removeAttendance(Request $req)
	{
    	// $idsvlhp = DSSV_LHP::where('mssv', $req->mssv)->where('ma_lophp', $req->malhp)->get();
		$maCB = Canbo::where('id_account', Auth::user()->id)->first();
		$diemdanh = Diemdanh::where('id_sv_lhp', $req->mssv)
		->where('id_tuanyc',$req->tuan)
		->where('ma_canbo', $maCB->ma_canbo)->first();
		// foreach($diemdanh as $dd){
		//  	$dd->is_delete = 1;
		//  	$dd->save();
		// }
		$diemdanh->delete();

	}



    // ====================================================my calendar

	public function teacher_mycalendar(){

		if (Auth::check()) {
			$now_hk = HocKy::join('tuan_th', 'hoc_ky.id_hk', 'tuan_th.id_hk')->where('hoc_ky.status', 'Now')->get();
			$phong = Phong::orderBy('ten_phong', 'asc')->get();

			$alldatasang = YeuCau::join('can_bo','can_bo.ma_canbo','chitiet_yc.ma_canbo')->join('lop_hp','lop_hp.ma_lophp','chitiet_yc.ma_lophp')->join('tuan_theo_yc','tuan_theo_yc.id_chitietyc','chitiet_yc.id_chitietyc')->join('sap_xep','sap_xep.id_tuanyc','tuan_theo_yc.id_tuanyc')->join('tuan_th','tuan_th.id_tuan','tuan_theo_yc.id_tuan')
			->where('chitiet_yc.buoi', 'Sáng')->get();
			$alldatachieu= YeuCau::join('can_bo','can_bo.ma_canbo','chitiet_yc.ma_canbo')->join('lop_hp','lop_hp.ma_lophp','chitiet_yc.ma_lophp')->join('tuan_theo_yc','tuan_theo_yc.id_chitietyc','chitiet_yc.id_chitietyc')->join('sap_xep','sap_xep.id_tuanyc','tuan_theo_yc.id_tuanyc')->join('tuan_th','tuan_th.id_tuan','tuan_theo_yc.id_tuan')
			->where('chitiet_yc.buoi', 'Chiều')->get();
			return view('teacher.mycalendar', compact('now_hk', 'alldatasang', 'alldatachieu', 'phong'));
		}
		else return redirect('login');

	}

//======================================================================================phan hoi
	public function reload_Fb(Request $req){
		$feedback = PhanHoi::join('sv_hoc_lhp', 'sv_hoc_lhp.id_sv_lhp', 'phan_hoi.id_sv_lhp')
		->join('lop_hp', 'lop_hp.ma_lophp','sv_hoc_lhp.ma_lophp')
		->join('can_bo', 'can_bo.ma_canbo', 'lop_hp.ma_canbo')
		->join('sinh_vien', 'sinh_vien.mssv', 'sv_hoc_lhp.mssv')
		->where('lop_hp.ma_lophp', $req->lhp_id)
		->where('can_bo.id_account', Auth::user()->id)->get();
		
		$i = 0;
		echo "<table id=\"example\" class=\"mdl-data-table table-responsive dataTable\" style=\"width:100%\">\n";
		echo "<thead>\n";
		echo "<tr>\n";
		echo "<th>STT</th>\n";
		echo "<th>MSSV</th>\n";
		echo "<th>Họ tên</th>\n";
		echo "<th>Chủ Đề</th>\n";
		echo "<th>Nội Dung</th>\n";
		echo "<th>Ảnh</th>\n";
		echo "<th>Trạng Thái</th>\n";
		echo "<th>Hành Động</th>\n";
		echo "</tr>\n";
		echo "</thead>\n";
		echo "<tbody>\n";
		foreach($feedback as $fb){
			echo "<tr>\n";
			echo "<td class=\"text-center\">".($i = $i+1)."</td>\n";
			echo "<td>".$fb->mssv."</td>\n";
			echo "<td>".$fb->ten_sv."</td>\n";
			echo "<td>".$fb->ten_phanhoi."</td>\n";
			echo "<td>".$fb->noidung_phanhoi."</td>\n";
			echo "<td>". "<a href = \" /files/{$fb->mau_don} \">" . "<img width= \"40\" src= \"/files/{$fb->mau_don} \" />". "</a>" ."</td>\n";
			if($fb->status == 1){
				echo "<td>"."Đã Duyệt"."</td>\n";
			}
			else{
				echo "<td>"."Chưa Duyệt"."</td>\n";
			}
			echo "<td>". "<a href = \" /chapnhanfb/{$fb->id_phanhoi} \">" . "Chấp Nhận" . "</a>" . "|" . "<a href = \" /tuchoifb/{$fb->id_phanhoi} \">" . "Từ Chối" . "</a>" . "</td>\n";
			echo "</tr>\n";
		}

		echo "</tbody>\n";

		echo "<tfoot>\n";
		echo "<tr>\n";
		echo "<th>STT</th>\n";
		echo "<th>MSSV</th>\n";
		echo "<th>Họ tên</th>\n";
		echo "<th>Chủ Đề</th>\n";
		echo "<th>Nội Dung</th>\n";
		echo "<th>Ảnh</th>\n";
		echo "<th>Trạng Thái</th>\n";
		echo "<th>Hành Động</th>\n";
		echo "</tr>\n";
		echo "</tfoot>\n";
		echo "</table>";
	}

}
