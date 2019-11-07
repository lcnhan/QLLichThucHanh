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

class AdminController extends Controller
{
    public function getIndex(){
    	if (Auth::check() == 'Admin') {
    		return view('admin.dashboard');
    	}
		else return redirect('home');
    }


// =====================================================================Hoc Ky
    public function getHK(){
    	if (Auth::check() == 'Admin') {
	    	$hocky = HocKy::orderBy('created_at','desc')->get();
	    	return view('admin.hocky', compact('hocky'));
    	}
		else return redirect('home');
    }

    public function addHK(Request $req){
		if (Auth::check() == 'Admin') {
			$format = 'd/m/Y';
			if (Carbon::createFromFormat($format, $req->ngaybd)->greaterThan(Carbon::createFromFormat($format, $req->ngaykt))) {
				return redirect()->back()->with('DateFail','Lỗi ngày!');
			}
			if (Carbon::parse($req->ngaybd)->diffInDays($req->ngaykt) >= 150){
				return redirect()->back()->with('NumDateFail','Lỗi ngày!');
			}
			else{
				$nk_kt = Carbon::createFromFormat('d/m/Y', $req->ngaybd)->add(1, 'year');
				$nk = Carbon::parse($req->ngaybd)->format('Y')." - ".Carbon::parse($nk_kt)->format('Y');
				$hk = new HocKy;
				$hk->ky_hieu = $req->tenhk;
				$hk->nien_khoa = $nk;
				$hk->ngay_bd = $req->ngaybd;
				$hk->ngay_kt = $req->ngaykt;
				$hk->save();
				$savedID = $hk->id;

				$bd = Carbon::createFromFormat('d/m/Y', $req->ngaybd);
				$kt = Carbon::createFromFormat('d/m/Y', $req->ngaykt);
				$days = $bd->diffInDays($kt);
				$weeks = number_format($days/7, 0, '.', '');

				for ($i=0; $i < $weeks ; $i++) { 
					$tuanth = new TuanTH;
					$tuanth->stt_tuan = "Tuần ".($i+1);
					$tuanth->id_hk = $savedID;
					$t_bd = Carbon::createFromFormat('d/m/Y', $req->ngaybd)->add($i*7, 'day');
					$t_kt = Carbon::createFromFormat('d/m/Y', $req->ngaybd)->add(($i+1)*7-1, 'day');
					$tuanth->ngay_bd = Carbon::parse($t_bd)->format('d/m/Y');
					$tuanth->ngay_kt = Carbon::parse($t_kt)->format('d/m/Y');
					$tuanth->save();
				}

				return redirect()->back()->with('Added','Thêm thành công!');
			}
			
		}
		else return redirect('home');
    }

    public function editHK(Request $req, $id){
    	$format = 'd/m/Y';
		if (Auth::check() == 'Admin') {
			if (Carbon::createFromFormat($format, $req->new_ngaybd)->greaterThan(Carbon::createFromFormat($format, $req->new_ngaykt))) {
				return redirect()->back()->with('DateFail','Lỗi ngày!');
			}
			if (Carbon::parse($req->new_ngaybd)->diffInDays($req->new_ngaykt) >= 150){
				return redirect()->back()->with('NumDateFail','Lỗi ngày!');
			}

			else{
				$nk = Carbon::parse($req->new_ngaybd)->format('Y')." - ".Carbon::parse($req->new_ngaykt)->format('Y');
				HocKy::where('id_hk',$id)->update([
					'ky_hieu'=>$req->new_tenhk,
					'nien_khoa'=>$nk,
					'ngay_bd'=>$req->new_ngaybd,
					'ngay_kt'=>$req->new_ngaykt
				]);
				
				return redirect()->back()->with('Edited','Sửa thành công!');
			}
		}
		else return redirect('home');
    }

    public function editHKStatus(Request $req){
		if (Auth::check() == 'Admin') {
			$hk = HocKy::get();
			foreach ($hk as $key) {
				HocKy::where('id_hk',$key->id_hk)->update([
					'status'=> "Expired"
				]);
			}
			HocKy::where('id_hk',$req->hk_id)->update([
				'status'=>$req->sta
			]);
		}
		else return redirect('home');
    }

    public function deleteHK($id){
		if (Auth::check() == 'Admin') {
			try{
				TuanTH::where('id_hk',$id)->delete();
				HocKy::where('id_hk',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    // DSLHP Theo học kỳ
    public function no_dslhp(){
    	if (Auth::check() == 'Admin') {
	    	return redirect()->back();
    	}
		else return redirect('home');
    }

    public function get_dslhp($id){
    	if (Auth::check() == 'Admin') {
	    	$lophp = LopHP::join('can_bo','can_bo.ma_canbo','lop_hp.ma_canbo')->join('hoc_ky','hoc_ky.id_hk','lop_hp.id_hk')->join('mon_hoc','mon_hoc.ma_mon','lop_hp.ma_mon')->join('buoi_th','buoi_th.ma_lophp','lop_hp.ma_lophp')->where('lop_hp.id_hk', $id)->orderBy('lop_hp.ma_lophp','asc')->get();
    		$monhoc = Monhoc::orderBy('ma_mon','asc')->get();
    		$hocky = HocKy::orderBy('ngay_kt','desc')->get();
    		$canbo = Canbo::orderBy('ten_cb','asc')->get();
	    	$allHK = HocKy::orderBy('created_at', 'desc')->get();
	    	$hk = $id;
	    	return view('admin.dshk_lhp', compact('lophp', 'allHK', 'hk', 'monhoc', 'hocky', 'canbo'));
    	}
		else return redirect('home');
    }

    public function loadDSLHP_HK(Request $req){
    	if (Auth::check() == 'Admin') {
	    	$lophp = LopHP::join('can_bo','can_bo.ma_canbo','lop_hp.ma_canbo')->join('hoc_ky','hoc_ky.id_hk','lop_hp.id_hk')->join('mon_hoc','mon_hoc.ma_mon','lop_hp.ma_mon')->join('buoi_th','buoi_th.ma_lophp','lop_hp.ma_lophp')->where('lop_hp.id_hk', $req->hk_id)->orderBy('lop_hp.ma_lophp','asc')->get();
	    	$i = 0;

	    	echo "<table id=\"basic-datatables\" class=\"display table table-striped table-hover\">\n";
			echo "<thead>\n";
			echo "<tr>\n";
			echo "<th class=\"text-center\">STT</th>\n";
			echo "<th>Mã lớp</th>\n";
			echo "<th>Tên lớp</th>\n";
			echo "<th>Số buổi thực hành</th>\n";
			echo "<th>Số lượng sinh viên</th>\n";
			echo "<th>Cán bộ phụ trách</th>\n";
			echo "<th>Môn học</th>\n";
			echo "<th>Học kỳ</th>\n";
			echo "<th class=\"text-center\">Control</th>\n";
			echo "</tr>\n";
			echo "</thead>\n";
			echo "<tfoot>\n";
			echo "<tr>\n";
			echo "<th class=\"text-center\">STT</th>\n";
			echo "<th>Mã lớp</th>\n";
			echo "<th>Tên lớp</th>\n";
			echo "<th>Số buổi thực hành</th>\n";
			echo "<th>Số lượng sinh viên</th>\n";
			echo "<th>Cán bộ phụ trách</th>\n";
			echo "<th>Môn học</th>\n";
			echo "<th>Học kỳ</th>\n";
			echo "<th class=\"text-center\">Control</th>\n";
			echo "</tr>\n";
			echo "</tfoot>\n";
			echo "<tbody>\n";
			foreach($lophp as $lhp){
				echo "<tr>\n";
					echo "<td class=\"text-center\">".($i = $i+1)."</td>\n";
					echo "<td>".$lhp->ma_lophp."</td>\n";
					echo "<td><a href=\"dssv/'".$lhp->ma_lophp."\">".$lhp->ten_lophp."</a></td>\n";
					echo "<td>".$lhp->so_buoi_th."</td>\n";
					echo "<td>".$lhp->so_luong_sv."</td>\n";
					echo "<td>".$lhp->ten_cb."</td>\n";
					echo "<td>".$lhp->ma_mon." - ".$lhp->ten_mon."</td>\n";
					echo "<td>Học kỳ ".$lhp->ky_hieu." (".$lhp->nien_khoa.")</td>\n";
					echo "<td class=\"text-center\">\n";
						echo "<button type=\"button\" class=\"btn_control text-primary\" data-toggle=\"modal\" data-target=\"#edit\" onclick=\"editData('".$lhp->ma_lophp."'); changePName('".$lhp->ma_lophp."', '".$lhp->ten_lophp."', '".$lhp->ma_mon."', '".$lhp->so_buoi_th."', '".$lhp->ma_canbo."', '".$lhp->id_hk."', '".$lhp->thu."', '".$lhp->tietbd."' );\">\n";
							echo "<i class=\"fas fa-pen\"></i>\n";
						echo "</button>\n";
						echo "<button type=\"button\" class=\"btn_control text-danger\" onclick=\"deleteData('".$lhp->ma_lophp."')\">\n";
							echo "<i class=\"fas fa-trash\"></i>\n";
						echo "</button>\n";
					echo "</td>\n";
				echo "</tr>\n";
			}
			echo "</tbody>\n";
			echo "</table>";
	    	
	    }
		else return redirect('home');
    }



// =====================================================================Lop
    public function getLop(){
    	if (Auth::check() == 'Admin') {
	    	$nganh = Nganh::orderBy('ten_nganh','asc')->get();
	    	return view('admin.lop', compact('nganh'));
    	}
		else return redirect('home');
    }

    public function loadLop(){
    	if (Auth::check() == 'Admin') {
	    	$lop = Lop::orderBy('ma_lop','asc')->get();
	    	$nganh = Nganh::get();
	    	$i = 0;
	    	foreach ($lop as $value) {
	    		echo "<tr>\n";
				echo "<td class=\"text-center\">".($i = $i+1)."</td>\n";
				echo "<td>".$value->ma_lop."</td>\n";
				echo "<td>".$value->ten_lop."</td>\n";
				foreach ($nganh as $ng) {
					if ($value->ma_nganh == $ng->ma_nganh) {
						echo "<td>".$ng->ten_nganh."</td>\n";
					}
				}
				echo "<td>123</td>\n";
				echo "\n";
				echo "<td>\n";
				echo "<button type=\"button\" class=\"btn_control text-primary\" data-toggle=\"modal\" data-target=\"#EditClass\" onclick=\"editData('$value->ma_lop'); changePName('$value->ma_nganh', '$value->ma_lop', '$value->ten_lop')\">\n";
				echo "<i class=\"fas fa-pen\"></i>\n";
				echo "</button>\n";
				echo "<button type=\"button\" class=\"btn_control text-danger\" onclick=\"deleteClass('$value->ma_lop')\">\n";
				echo "<i class=\"fas fa-trash\"></i>\n";
				echo "</button>\n";
				echo "</td>\n";
				echo "</tr>";
	    	}
	    }
		else return redirect('home');
    }



    public function addClass(Request $req){
		if (Auth::check() == 'Admin') {
			try{
				$lop = new Lop;
				$lop->ma_nganh = $req->manganh;
				$lop->ma_lop = $req->malop;
				$lop->ten_lop = $req->tenlop;
				$lop->save();
				return redirect()->back()->with('Added','Thêm thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('AddFail','Thêm thất bại!');
			}
			
		}
		else return redirect('home');
    }

    public function editClass(Request $req, $id){
		if (Auth::check() == 'Admin') {
			try{
				Lop::where('ma_lop',$id)->update([
					'ma_lop'=>$req->new_malop,
					'ten_lop'=>$req->new_tenlop,
					'ma_nganh'=>$req->new_manganh
				]);
				return redirect()->back()->with('Edited','Sửa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('AddFail','Thêm thất bại!');
			}
		}
		else return redirect('home');
    }

    public function deleteLop($id){
		if (Auth::check() == 'Admin') {
			try{
				Lop::where('ma_lop',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }


// ===================================================================Nganh
	public function getNganh(){
		if (Auth::check() == 'Admin') {
			$nganh = Nganh::orderBy('ten_nganh','asc')->get();
	    	return view('admin.nganh', compact('nganh'));
    	}
		else return redirect('home');
    }

    public function addMajor(Request $req){
		if (Auth::check() == 'Admin') {
			try{
				$nganh = new Nganh;
				$nganh->ma_nganh = $req->manganh;
				$nganh->ten_nganh = $req->tennganh;
				$nganh->save();
				return redirect()->back()->with('Added','Thêm thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('AddFailed','Thêm thất bại!');
			}
			
		}
		else return redirect('home');
    }

    public function editMajor(Request $req, $id){
		if (Auth::check() == 'Admin') {
			try{
				Nganh::where('ma_nganh',$id)->update([
					'ma_nganh'=>$req->new_manganh,
					'ten_nganh'=>$req->new_tennganh
				]);
				return redirect()->back()->with('Edited','Sửa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('EditFailed','Sửa thất bại!');
			}
		}
		else return redirect('home');
    }

    public function deleteMajor($id){
		if (Auth::check() == 'Admin') {
			try{
				Nganh::where('ma_nganh',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
		}
		else return redirect('home');
    }

    // ===================================================================Mon Hoc
    public function getMon(){
    	if (Auth::check() == 'Admin') {
			$mon = Monhoc::orderBy('ma_mon','asc')->get();
	    	return view('admin.monhoc', compact('mon'));
	    }
		else return redirect('home');
    }

    public function addSubject(Request $req){
    	try{
	    	if (Auth::check() == 'Admin') {
				$mon = new Monhoc;
				$mon->ma_mon = $req->mamon;
				$mon->ten_mon = $req->tenmon;
				$mon->tin_chi = $req->tinchi;
				$mon->so_tiet_lt = $req->sotietlt;
				$mon->so_tiet_th = $req->sotietth;
				$mon->save();
		    	return redirect()->back()->with('Added','Thêm thành công!');
	    	}
			else return redirect('home');
		}
		catch(\Exception $e){
			return redirect()->back()->with('AddError','Thêm thất bại!');
		}
    }

    public function editSubject(Request $req, $id){
    	try{
			if (Auth::check() == 'Admin') {
				Monhoc::where('ma_mon',$id)->update([
					'ma_mon'=>$req->new_mamon,
					'ten_mon'=>$req->new_tenmon,
					'tin_chi'=>$req->new_tinchi,
					'so_tiet_lt'=>$req->new_sotietlt,
					'so_tiet_th'=>$req->new_sotietth,
				]);
				return redirect()->back()->with('Edited','Sửa thành công!');
			}
			else return redirect('home');
		}
		catch(\Exception $e){
			return redirect()->back()->with('EditError','Sửa thất bại!');
		}
    }

	public function deleteSubject($id){
		if (Auth::check() == 'Admin') {
			try{
				Monhoc::where('ma_mon',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    public function importSubject(Request $req){
    	if (Auth::check() == 'Admin') {
	    	if ($req->hasFile('excel_file')) {
	    		$fileExtension = $req->file('excel_file')->getClientOriginalExtension();
	    		if ($fileExtension == 'xls' || $fileExtension = 'xlsx') {
	    			try{
	    				Excel::import(new ImportMon, $req->file('excel_file'));
		            	return redirect()->back()->with('Added','Thêm thành công!');
	    			}
	    			catch(\Exception $e){
	    				return redirect()->back()->with('ErrorFile','Thêm thất bại!');
	    			}
		        }
		        else
	    			return redirect()->back()->with('ErrorFileExtension','Thêm thất bại!');
	    	}	
	    	else
	    		return redirect()->back()->with('Error','Thêm thất bại!');
	    }
		else return redirect('home');
    }

    // ===================================================================Cán bộ
    public function getDSCB(){
    	if (Auth::check() == 'Admin') {
			$canbo = Canbo::join('users','users.id','can_bo.id_account')->orderBy('role','asc')->get();
	    	return view('admin.dscb', compact('canbo'));
    	}
		else return redirect('home');
    }

    public function importCB(Request $req){
    	if (Auth::check() == 'Admin') {
	    	if ($req->hasFile('excel_file')) {
	    		$fileExtension = $req->file('excel_file')->getClientOriginalExtension();
	    		if ($fileExtension == 'xls' || $fileExtension = 'xlsx') {
	    			try{
	    				Excel::import(new ImportCB, $req->file('excel_file'));
		            	return redirect()->back()->with('Added','Thêm thành công!');
	    			}
	    			catch(\Exception $e){
	    				return redirect()->back()->with('ErrorFileStruct','Thêm thất bại!');
	    			}
		        }
		        else
	    			return redirect()->back()->with('ErrorFileExtension','Thêm thất bại!');
	    	}	
	    	else
	    		return redirect()->back()->with('Error','Thêm thất bại!');
    	}
		else return redirect('home');
    }

    public function addCB(Request $req){
    	if (Auth::check() == 'Admin') {
    		
	    	$existEmail = User::where('email',$req->email)->get();
	    	$format = 'd/m/Y';
	    	if (count($existEmail) == null) {
	    		if (Carbon::createFromFormat($format, $req->ngsinh)->greaterThan(Carbon::createFromFormat($format, $req->nglam))) {
					return redirect()->back()->with('DateFail','Lỗi ngày!');
				}
				else{
					$existMSCB = Canbo::where('ma_canbo',$req->macb)->get();
					if(count($existMSCB) == null){
						try{
				    		$user = new User;
					    	$user->name = $req->tencb;
					    	$user->email = $req->email;
					    	$user->password = Hash::make($req->pass);
					    	$user->role = $req->role;
					    	$user->save();
					    	$savedID = $user->id;

							$canbo = new Canbo;
							$canbo->id_account = $savedID;
							$canbo->ma_canbo = $req->macb;
							$canbo->ten_cb = $req->tencb;
							$canbo->ngay_sinh = $req->ngsinh;
							$canbo->gioi_tinh = $req->gt;
							$canbo->sdt = $req->sdt;
							$canbo->ngay_vao_lam = $req->nglam;
							$canbo->save();

					    	return redirect()->back()->with('Added','Thêm thành công!');
					    }
		    			catch(\Exception $e){
		    				return redirect()->back()->with('AddFail','Thêm thất bại!');
		    			}
		    		}
		    		return redirect()->back()->with('AddFail','Thêm thất bại!');
				}
	    	}
	    	else return redirect()->back()->with('AddFail','Thêm thất bại!');
    	}
		else return redirect('home');
    }

    public function editCB(Request $req, $id){
		if (Auth::check() == 'Admin') {
			$format = 'd/m/Y';
			if (Carbon::createFromFormat($format, $req->new_ngsinh)->greaterThan(Carbon::createFromFormat($format, $req->new_nglam))) {
					return redirect()->back()->with('DateFail','Lỗi ngày!');
				}
				else{
					try{
						Canbo::where('ma_canbo',$id)->update([
							'ma_canbo'=>$req->new_macb,
							'ten_cb'=>$req->new_tencb,
							'ngay_sinh'=>$req->new_ngsinh,
							'gioi_tinh'=>$req->new_gt,
							'sdt'=>$req->new_sdt,
							'ngay_vao_lam'=>$req->new_nglam
						]);

						User::join('can_bo', 'can_bo.id_account', 'users.id')->where('can_bo.ma_canbo',$id)->update([
							'role'=>$req->new_role,
							'name'=>$req->new_tencb
						]);
						return redirect()->back()->with('Edited','Sửa thành công!');
					}
	    			catch(\Exception $e){
	    				return redirect()->back()->with('AddFail','Thêm thất bại!');
	    			}
	    		}
		}
		else return redirect('home');
    }

    public function deleteCB(Request $req){
		if (Auth::check() == 'Admin') {
			try{
				Canbo::where('ma_canbo',$req->idcb)->delete();
				User::where('id',$req->id_usr)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa Thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    // ===================================================================Sinh viên
    public function getDSSV(){
    	if (Auth::check() == 'Admin') {
			$sinhvien = Sinhvien::join('users','users.id','sinh_vien.id_account')->join('lop','lop.ma_lop','sinh_vien.ma_lop')->orderBy('mssv','asc')->get();
			$lop = Lop::orderBy('ma_lop','asc')->get();
	    	return view('admin.dssv', compact('sinhvien', 'lop'));
	    }
		else return redirect('home');
    }

    public function importSV(Request $req){
    	if (Auth::check() == 'Admin') {
	    	if ($req->hasFile('excel_file')) {
	    		$fileExtension = $req->file('excel_file')->getClientOriginalExtension();
	    		if ($fileExtension == 'xls' || $fileExtension = 'xlsx') {
	    			try{
	    				Excel::import(new ImportSV, $req->file('excel_file'));
		            	return redirect()->back()->with('Added','Thêm thành công!');
	    			}
	    			catch(\Exception $e){
	    				return redirect()->back()->with('ErrorFileStruct','Thêm thất bại!');
	    			}
		        }
		        else
	    			return redirect()->back()->with('ErrorFileExtension','Thêm thất bại!');
	    	}	
	    	else
	    		return redirect()->back()->with('Error','Thêm thất bại!');
    	}
		else return redirect('home');
    }

    public function addSV(Request $req){
    	if (Auth::check() == 'Admin') {
	    	$existEmail = User::where('email',$req->email)->get();
	    	$format = 'd/m/Y';
	    	if (count($existEmail) == null) {
	    		if (Carbon::createFromFormat($format, $req->ngsinh)->greaterThan(Carbon::createFromFormat($format, $req->nghoc))) {
					return redirect()->back()->with('DateFail','Lỗi ngày!');
				}
				else{
					
					$existMSSV = Sinhvien::where('mssv',$req->masv)->get();
					if(count($existMSSV) == null){
						try{
							$user = new User;
					    	$user->name = $req->tensv;
					    	$user->email = $req->email."@student.ctu.edu.vn";
					    	$user->password = Hash::make($req->pass);
					    	$user->role = "Student";
					    	$user->save();
					    	$savedID = $user->id;

							$sinhvien = new Sinhvien;
							$sinhvien->id_account = $savedID;
							$sinhvien->mssv = $req->masv;
							$sinhvien->ten_sv = $req->tensv;
							$sinhvien->khoa_hoc = $req->khoa;
							$sinhvien->ma_lop = $req->malop;
							$sinhvien->ngay_sinh = $req->ngsinh;
							$sinhvien->gioi_tinh = $req->gt;
							$sinhvien->sdt = $req->sdt;
							$sinhvien->nam_vao_hoc = $req->nghoc;
							$sinhvien->save();

					    	return redirect()->back()->with('Added','Thêm thành công!');
					    }
		    			catch(\Exception $e){
		    				return redirect()->back()->with('MSSVFail','Thêm thất bại!');
		    			}
					}
		    		return redirect()->back()->with('Error','Thêm thất bại!');
				}
	    	}
	    	else return redirect()->back()->with('EmailFail','Thêm thất bại!');
    	}
		else return redirect('home');
    }

    public function editSV(Request $req, $id){
		if (Auth::check() == 'Admin') {
			try{
				Sinhvien::where('mssv',$id)->update([
					'mssv'=>$req->new_masv,
					'ten_sv'=>$req->new_tensv,
					'ngay_sinh'=>$req->new_ngsinh,
					'gioi_tinh'=>$req->new_gt,
					'khoa_hoc'=>$req->new_khoa,
					'sdt'=>$req->new_sdt,
					'nam_vao_hoc'=>$req->new_nghoc
				]);

				User::join('sinh_vien', 'sinh_vien.id_account', 'users.id')->where('sinh_vien.mssv',$id)->update([
					'name'=>$req->new_tensv
				]);
				return redirect()->back()->with('Edited','Sửa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('EditFail','Sửa thất bại!');
			}
		}
		else return redirect('home');
    }

    public function deleteSV(Request $req){
		if (Auth::check() == 'Admin') {
			try{
				Sinhvien::where('mssv',$req->idsv)->delete();
				User::where('id',$req->id_usr)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa Thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    // ===================================================================Lop HP
    public function getDSLHP(){
    	if (Auth::check() == 'Admin') {
    		$old_lophp = LopHP::get();
    		$sinhvien = DSSV_LHP::get();
    		foreach ($old_lophp as $o_lhp) {
    			$new_hk = HocKy::where('ky_hieu', $o_lhp->ky_hieu)->where('nien_khoa', $o_lhp->nien_khoa)->get();
    			foreach ($new_hk as $n_hk) {
    				LopHP::where('ma_lophp', $o_lhp->ma_lophp)->update([
						'id_hk'=>$n_hk->id_hk,
						'ma_lophp' => $o_lhp->ky_hieu."_".$o_lhp->nien_khoa."_".$o_lhp->real_ma_lhp
					]);
    			}
    			foreach($sinhvien as $sv){
					$countSV = DSSV_LHP::where('ma_lophp',$o_lhp->ma_lophp)->get();
                	LopHP::where('ma_lophp', $o_lhp->ma_lophp)->update([
						'so_luong_sv'=> count($countSV)
					]);
    			}
    		}
    		$lophp = LopHP::join('can_bo','can_bo.ma_canbo','lop_hp.ma_canbo')->join('hoc_ky','hoc_ky.id_hk','lop_hp.id_hk')->join('mon_hoc','mon_hoc.ma_mon','lop_hp.ma_mon')->join('buoi_th','buoi_th.ma_lophp','lop_hp.ma_lophp')->orderBy('lop_hp.ma_lophp','asc')->get();
    		$monhoc = Monhoc::orderBy('ma_mon','asc')->get();
    		$hocky = HocKy::orderBy('ngay_kt','desc')->get();
    		$canbo = Canbo::orderBy('ten_cb','asc')->get();
    		

    		return view('admin.lhp', compact('lophp', 'monhoc', 'hocky', 'canbo'));
    	}
		else return redirect('home');
    }

    public function addLHP(Request $req){
    	if (Auth::check() == 'Admin') {
    		$existLHP = LopHP::where('real_ma_lhp',$req->malhp)->where('id_hk',$req->hk)->get();
    		if(count($existLHP) != null){
    			return redirect()->back()->with('AddFail','thất bại!');
    		}
    		try{
    			$hocky = HocKy::where('id_hk', $req->hk)->get();
    			foreach ($hocky as $hk) {
    				$lhp = new LopHP;
			    	$lhp->ma_canbo = $req->cb;
			    	$lhp->ma_mon = $req->mon;
			    	$lhp->ma_lophp = $req->malhp;
			    	$lhp->real_ma_lhp = $req->malhp;
			    	$lhp->ten_lophp = $req->tenlhp;
			    	$lhp->so_buoi_th = $req->buoith;
			    	$lhp->ky_hieu = $hk->ky_hieu;
			    	$lhp->nien_khoa = $hk->nien_khoa;
			    	$lhp->id_hk = $req->hk;
			    	$lhp->save();

					$buoith = new BuoiTH;
					$buoith->ma_lophp = $req->malhp;
					$buoith->thu = $req->thu;
					$buoith->tietbd = $req->tiet;
					$buoith->save();
    			}
				
		    	return redirect('admin/lhp')->with('Added','Thêm thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('AddFail','thất bại!');
			}
    		
    	}
		else return redirect('home');
    }

    public function deleteLHP($id){
		if (Auth::check() == 'Admin') {
			try{
				BuoiTH::where('ma_lophp',$id)->delete();
				LopHP::where('ma_lophp',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa Thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    public function editLHP(Request $req, $id){

		if (Auth::check() == 'Admin') {
			try{
				$hk = HocKy::where('id_hk', $req->new_hk)->get();
				BuoiTH::where('ma_lophp',$id)->update([
					'thu'=>$req->new_thu,
					'tietbd'=>$req->new_tiet
				]);
				foreach ($hk as $key) {
					LopHP::where('ma_lophp',$id)->update([
						'ma_canbo'=>$req->new_cb,
						'ma_mon'=>$req->new_mon,
						'real_ma_lhp'=>$req->new_malhp,
						'ten_lophp'=>$req->new_tenlhp,
						'so_buoi_th'=>$req->new_buoith,
						'ky_hieu'=> $key->ky_hieu,
						'nien_khoa'=> $key->nien_khoa,
						'id_hk'=>$req->new_hk
					]);
				}
				
				return redirect()->back()->with('Edited','Sửa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('EditFail','Xóa thất bại!');
			}
				
		}
		else return redirect('home');
    }

    public function importLHP(Request $req){
    	if (Auth::check() == 'Admin') {
	    	if ($req->hasFile('excel_file')) {
	    		$fileExtension = $req->file('excel_file')->getClientOriginalExtension();
	    		if ($fileExtension == 'xls' || $fileExtension = 'xlsx') {
	    			try{
	    				Excel::import(new ImportLHP, $req->file('excel_file'));
		            	return redirect()->back()->with('Added','Thêm thành công!');
	    			}
	    			catch(\Exception $e){
	    				return redirect()->back()->with('ErrorFileStruct','Thêm thất bại!');
	    			}
		        }
		        else return redirect()->back()->with('ErrorFileExtension','Thêm thất bại!');
	    	}	
	    	else return redirect()->back()->with('Error','Thêm thất bại!');
    	}
		else return redirect('home');
    }

    public function getDSSVLHP($id){
    	if (Auth::check() == 'Admin') {
			$dssv = DSSV_LHP::join('sinh_vien','sv_hoc_lhp.mssv','sinh_vien.mssv')->join('lop_hp','sv_hoc_lhp.ma_lophp','lop_hp.ma_lophp')->join('users','sinh_vien.id_account','users.id')->where('sv_hoc_lhp.ma_lophp', $id)->orderBy('sv_hoc_lhp.mssv','asc')->get();

			$mslop = $id;
			$tenlop = LopHP::where('ma_lophp', $id)->get('ten_lophp');
			$allLHP = LopHP::orderBy('ma_lophp','asc')->get();
			$allSV = Sinhvien::orderBy('ten_sv','asc')->get();
	    	return view('admin.dssv_lhp', compact('dssv', 'mslop', 'tenlop','allLHP','allSV'));
	    }
		else return redirect('home');
    }

    public function empty_dssv_lhp(){
    	return redirect()->back();
    }


    public function loadDSSV_LHP(Request $req){
    	if (Auth::check() == 'Admin') {
	    	$dssv = DSSV_LHP::join('sinh_vien','sv_hoc_lhp.mssv','sinh_vien.mssv')->join('lop_hp','sv_hoc_lhp.ma_lophp','lop_hp.ma_lophp')->join('users','sinh_vien.id_account','users.id')->where('sv_hoc_lhp.ma_lophp', $req->lhp_id)->orderBy('sv_hoc_lhp.mssv','asc')->get();
	    	$i = 0;
	    	
	    		echo "<table id=\"basic-datatables\" class=\"display table table-striped table-hover\">\n";
				echo "<thead>\n";
				echo "<tr>\n";
				echo "<th class=\"text-center\">STT</th>\n";
				echo "<th>MSSV</th>\n";
				echo "<th>Tên sinh viên</th>\n";
				echo "<th>Khóa</th>\n";
				echo "<th>Email</th>\n";
				echo "<th>SĐT</th>\n";
				echo "<th class=\"text-center\">Control</th>\n";
				echo "</tr>\n";
				echo "</thead>\n";
				echo "<tfoot>\n";
				echo "<tr>\n";
				echo "<th class=\"text-center\">STT</th>\n";
				echo "<th>MSSV</th>\n";
				echo "<th>Tên sinh viên</th>\n";
				echo "<th>Khóa</th>\n";
				echo "<th>Email</th>\n";
				echo "<th>SĐT</th>\n";
				echo "<th class=\"text-center\">Control</th>\n";
				echo "</tr>\n";
				echo "</tfoot>\n";
				echo "<tbody class=\"tbl_content\">\n";
			foreach ($dssv as $sv) {
				echo "<tr>\n";
				echo "<td class=\"text-center\">".($i = $i+1)."</td>\n";
				echo "<td>".$sv->mssv."</td>\n";
				echo "<td>".$sv->ten_sv."</td>\n";
				echo "<td>".$sv->khoa_hoc."</td>\n";
				echo "<td>".$sv->email."</td>\n";
				echo "<td>".$sv->sdt."</td>\n";
				echo "<td class=\"text-center\">\n";
				echo "<button type=\"button\" class=\"btn_control text-danger\" onclick=\"deleteData('".$sv->mssv."', '".$sv->id_account."')\">\n";
				echo "<i class=\"fas fa-trash\"></i>\n";
				echo "</button>\n";
				echo "</td>\n";
				echo "</tr>\n";
	    	}
	    	echo "</tbody>\n";
			echo "</table>";
	    }
		else return redirect('home');
    }

    public function addSV_LHP(Request $req){
    	if (Auth::check() == 'Admin') {
    		try{
    			if ($req->has('chon_sv')) {
				foreach ($req->chon_sv as $sv) {
						$svlhp = new DSSV_LHP;
						$svlhp->mssv = $sv;
						$svlhp->ma_lophp = $req->malop; 
						$svlhp->save();
    				}
    			}
    			else return redirect()->back()->with('NoSV','');
		    	return redirect('admin/lhp')->with('Added','Thêm thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('AddFail','thất bại!');
			}
    		
    	}
		else return redirect('home');
    }

    public function deleteSVLHP($id){
		if (Auth::check() == 'Admin') {
			try{
				DSSV_LHP::where('id_sv_lhp',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa Thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    public function reloadDSSV_LHP(Request $req){
    	if (Auth::check() == 'Admin') {
	    	$dssv = DSSV_LHP::join('sinh_vien','sv_hoc_lhp.mssv','sinh_vien.mssv')->join('lop_hp','sv_hoc_lhp.ma_lophp','lop_hp.ma_lophp')->join('users','sinh_vien.id_account','users.id')->where('sv_hoc_lhp.ma_lophp', $req->lhp_id)->orderBy('sv_hoc_lhp.mssv','asc')->get();
	    	$allSV = Sinhvien::orderBy('ten_sv','asc')->get();
	    	$i = 0;
	    	
	    	echo "<table id=\"choosesv-datatables\" class=\"display table table-striped table-hover\">\n";
				echo "<thead>\n";
					echo "<tr>\n";
						echo "<th class=\"text-center\">STT</th>\n";
						echo "<th>MSSV</th>\n";
						echo "<th>Tên sinh viên</th>\n";
						echo "<th class=\"text-center\">Chọn</th>\n";
					echo "</tr>\n";
				echo "</thead>\n";
				echo "<tfoot>\n";
					echo "<tr>\n";
						echo "<th class=\"text-center\">STT</th>\n";
						echo "<th>MSSV</th>\n";
						echo "<th>Tên sinh viên</th>\n";
						echo "<th class=\"text-center\">Chọn</th>\n";
					echo "</tr>\n";
				echo "</tfoot>\n";
				echo "<tbody class=\"tbl_content\">\n";
					foreach ($allSV as $sv) {
						echo "<tr>\n";
							echo "<td class=\"text-center\">".($i = $i+1)."</td>\n";
							echo "<td>".$sv->mssv."</td>\n";
							echo "<td>".$sv->ten_sv."</td>\n";
							echo "<td class=\"text-center\">\n";
							foreach ($dssv as $ds) {
								if ($ds->mssv == $sv->mssv) {
									echo "<div class=\"form-check\" hidden>\n";
								}else{
									echo "<div class=\"form-check\">\n";
								}
							}
									echo "<label class=\"form-check-label\">\n";
										echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"".$sv->mssv."\" name=\"chon_sv[]\">\n";
										echo "<span class=\"form-check-sign\"></span>\n";
									echo "</label>\n";
								echo "</div>\n";
							echo "</td>\n";
						echo "</tr>\n";
			    	}
	    		echo "</tbody>\n";
			echo "</table>";
	    }
		else return redirect('home');
    }

    public function importSVLHP(Request $req){
    	if (Auth::check() == 'Admin') {
	    	if ($req->hasFile('excel_file')) {
	    		$fileExtension = $req->file('excel_file')->getClientOriginalExtension();
	    		if ($fileExtension == 'xls' || $fileExtension = 'xlsx') {
	    			try{
	    				Excel::import(new ImportSVLHP, $req->file('excel_file'));
		            	return redirect()->back()->with('Added','Thêm thành công!');
	    			}
	    			catch(\Exception $e){
	    				return redirect()->back()->with('ErrorFileStruct','Thêm thất bại!');
	    			}
		        }
		        else return redirect()->back()->with('ErrorFileExtension','Thêm thất bại!');
	    	}	
	    	else return redirect()->back()->with('Error','Thêm thất bại!');
    	}
		else return redirect('home');
    }

    //======================================================phan mem
    public function getPhanmem(){
    	if (Auth::check() == 'Admin') {
    		$phanmem = PhanMem::orderBy('created_at','asc')->get();
	    	return view('admin.phanmem', compact('phanmem'));

	    	}
		else return redirect('home');
    }

    public function addPM(Request $req){
		if (Auth::check() == 'Admin') {
				$pm = new PhanMem;
				$pm->ten_pm = $req->ten_pm;
				$pm->version = $req->version;
				$pm->save();
				return redirect()->back()->with('Added','Thêm thành công!');
			
			
		}
		else return redirect('home');
    }

    public function editPM(Request $req, $id){
		if (Auth::check() == 'Admin') {
				PhanMem::where('id_pm',$id)->update([
					'ten_pm'=>$req->new_tenPM,
					'version'=>$req->new_version
				]);
				return redirect()->back()->with('Edited','Sửa thành công!');
		}
		else return redirect('home');
    }

    public function deletePM($id){
		if (Auth::check() == 'Admin') {
			try{
				PM_of_Phong::where('id_pm',$id)->delete();
				PhanMem::where('id_pm',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    //======================================================phong
    public function getPhong(){
    	if (Auth::check() == 'Admin') {
    		$phong = Phong::orderBy('created_at','asc')->get();
    		$pm_phong = PM_of_Phong::join('phan_mem','pm_thuoc_phong.id_pm','phan_mem.id_pm')->join('phong','phong.id_phong','pm_thuoc_phong.id_phong')->orderBy('phan_mem.ten_pm','asc')->get();
    		$phanmem = PhanMem::orderBy('ten_pm','asc')->get();
	    	return view('admin.phong', compact('phong', 'pm_phong', 'phanmem'));
	    	}
		else return redirect('home');
    }

    public function loadPMofROOM(Request $req){
    	if (Auth::check() == 'Admin') {
    		$pm_phong = PM_of_Phong::join('phan_mem','pm_thuoc_phong.id_pm','phan_mem.id_pm')->join('phong','phong.id_phong','pm_thuoc_phong.id_phong')->where('pm_thuoc_phong.id_phong', $req->idphong)->orderBy('phan_mem.ten_pm','asc')->get();
    		if (count($pm_phong) == null) {
    			echo "<li class=\"text-center list-group-item d-flex justify-content-between align-items-center\">\n";
				echo "<span class=\"text-danger font-weight-bold\">Không có phần mềm nào trong phòng này!</span>\n";
				echo "</li>";
    		}
    		else{
    			foreach ($pm_phong as $value) {
	    			echo "<li class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center li_item_".$value->id_pm_p."\">\n";
					echo "".$value->ten_pm."\n";
					echo "<span class=\"badge badge-primary badge-pill\">Phiên bản: ".$value->version."</span>\n";
					echo "<button class=\"btn_control text-danger\" onclick=\"del_pm('".$value->id_pm_p."')\"><i class=\"fas fa-times\"></i>";
					echo "</li>";
	    		}
    		}
	    }
		else return redirect('home');
    }

    public function loadallPM(Request $req){
    	if (Auth::check() == 'Admin') {
    		$phanmem = PhanMem::get();

			foreach ($phanmem as $pm) {
				$pm_phong = PM_of_Phong::where('id_pm', $pm->id_pm)->where('id_phong', $req->idphong)->get();
				if (count($pm_phong) == null) {
					echo "<li class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">\n";
					echo "".$pm->ten_pm."\n";
					echo "<span class=\"badge badge-primary badge-pill\">Phiên bản: ".$pm->version."</span>\n";
					echo "<div class=\"form-check\">\n";
					echo "<label class=\"form-check-label my-0\">\n";
					echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"".$pm->id_pm."\" name=\"chon_pm[]\">\n";
					echo "<span class=\"form-check-sign\" style=\"font-size: 11px !important;\"></span>\n";
					echo "</label>\n";
					echo "</div>\n";
					echo "</li>";
				}
    		}
	    }
		else return redirect('home');
    }

    public function addPM_R(Request $req){
		if (Auth::check() == 'Admin') {
			try{
				if ($req->has('chon_pm')) {
					foreach ($req->chon_pm as $value) {
						$pmr = new PM_of_Phong;
						$pmr->id_pm = $value;
						$pmr->id_phong = $req->pr_id;
						$pmr->save();
					}
				}
				return redirect()->back()->with('Added','Thêm thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('AddFailed','Thêm thất bại!');
			}
		}
		else return redirect('home');
    }

    public function deletePMR(Request $req){
		if (Auth::check() == 'Admin') {
			try{
				PM_of_Phong::where('id_pm_p',$req->idpmr)->delete();
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }

    public function addPhong(Request $req){
		if (Auth::check() == 'Admin') {
			try{
				$ph = new Phong;
				$ph->ten_phong = $req->ten_phong;
				$ph->soluong_may = $req->soluong_may;
				$ph->hdh = $req->hdh;
				$ph->ram = $req->ram;
				$ph->cpu = $req->cpu;
				$ph->save();
				return redirect()->back()->with('Added','Thêm thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('AddFailed','Thêm thất bại!');
			}
		}
		else return redirect('home');
    }

    public function editPhong(Request $req, $id){
		if (Auth::check() == 'Admin') {
			try{
				Phong::where('id_phong',$id)->update([
					'ten_phong'=>$req->new_ten_phong,
					'soluong_may'=>$req->new_soluong_may,
					'hdh'=>$req->new_hdh,
					'ram'=>$req->new_ram,
					'cpu'=>$req->new_cpu
				]);
				return redirect()->back()->with('Edited','Sửa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('EditFailed','Sửa thất bại!');
			}
		}
		else return redirect('home');
    }

    public function deletePhong($id){
		if (Auth::check() == 'Admin') {
			try{
				PM_of_Phong::where('id_phong',$id)->delete();
				Phong::where('id_phong',$id)->delete();
				return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			}
			catch(\Exception $e){
				return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			}
			
		}
		else return redirect('home');
    }



// ============================================================================yeucau
    public function getYeucau(){
    	if (Auth::check() == 'Admin') {
    		$lhp = LopHP::get();
    		$canbo = Canbo::get();
	    	$yeucau = YeuCau::join('can_bo','can_bo.ma_canbo','chitiet_yc.ma_canbo')->join('lop_hp','lop_hp.ma_lophp','chitiet_yc.ma_lophp')->orderBy('can_bo.ma_canbo','asc')->get();
	    	$tuan = TuanYC::join('chitiet_yc','tuan_theo_yc.id_chitietyc','chitiet_yc.id_chitietyc')->join('tuan_th','tuan_th.id_tuan','tuan_theo_yc.id_tuan')->get();
	    	$phong=Phong::get();
	    	return view('admin.yeucau', compact('yeucau','lhp','canbo','tuan','phong'));
    	}
		else return redirect('home');
    }

    public function loadYC(Request $req){
    	
    	$tuan=TuanYC::join('chitiet_yc','tuan_theo_yc.id_chitietyc','chitiet_yc.id_chitietyc')->join('tuan_th','tuan_th.id_tuan','tuan_theo_yc.id_tuan')->join('sap_xep', 'sap_xep.id_tuanyc', 'tuan_theo_yc.id_tuanyc')->where('chitiet_yc.id_chitietyc',$req->phong_id)->get();

		$phong=Phong::get();

		$hienthi = Sapxep::get();
		foreach($tuan as $t){
			echo "<tr>\n";
			echo "<td class=\"text-center py-0\">\n";
			echo "".$t->stt_tuan."\n";
			echo "</td>\n";
			echo "\n";
			echo "<td class=\"py-0\">\n";
			echo "<select name=\"phong\" id=\"phong\" class=\"custom_select\" onchange=\"changePhong(".$t->id_tuanyc.", $(this).val(), ".$t->id_yeucau.")\">\n";
			foreach($phong as $p){
					if($p->id_phong == $t->id_phong){
						echo "<option value=\"".$p->id_phong."\" selected>".$p->ten_phong. " </option>\n";
					}
					else
					{
						echo "<option value=\"".$p->id_phong."\">".$p->ten_phong." </option>\n";
					}
					
				// foreach ($hienthi as $ht) {

				// if($ht->id_tuanyc == $t->id_tuanyc){
				// 	echo "<option selected value=\"".$ht->id_phong."\">".$ht->Sapxep_phong->ten_phong." </option>\n";
				// 	foreach($phong as $p){
				// 		echo "<option value=\"".$p->id_phong."\">".$p->ten_phong." </option>\n";
				// 	}
				// }
				// else{
				// 	foreach($phong as $p){
				// 		echo "<option value=\"".$p->id_phong."\">".$p->ten_phong." </option>\n";
				// 	}
				// }


					// echo "<option value=\"".$p->id_phong."\">".$p->ten_phong." </option>\n";
					
				// }
			}
		}
		echo "</select>\n";
		echo "</td>\n";
		echo "</tr>";
    }



    public function sapxep(Request $req){
    	if (Auth::check() == 'Admin') {
    		$dem = Sapxep::where('id_tuanyc',$req->tuanyc_id)->get();

    		if(count($dem) == null){
    			$sapxep = new Sapxep;
	    		$sapxep->id_tuanyc = $req->tuanyc_id;
	    		$sapxep->id_phong = $req->phong_id;
	    		$sapxep->save();
	    		$yeucau_lth = YeuCau_lth::where('id_yeucau', $req->id_yeucau)->first();
    				$yeucau_lth->status = 0;
    				$yeucau_lth->save();
    		}else{
    			$yeucau = Sapxep::where('id_sx',$dem[0]['id_sx'])->update([
				'id_tuanyc'=>$req->tuanyc_id,
				'id_phong'=>$req->phong_id
					]);
    			$yeucau_lth = YeuCau_lth::where('id_yeucau', $req->id_yeucau)->first();
    				$yeucau_lth->status = 0;
    				$yeucau_lth->save();
    		}

    		$sx = Sapxep::where('id_tuanyc',$req->tuanyc_id)->get();
    		foreach($sx as $dt){
    			if($dt->id_phong == null){
    				$yeucau_lth = YeuCau_lth::where('id_yeucau', $req->id_yeucau)->first();
    				$yeucau_lth->status = 0;
    				$yeucau_lth->save();
    			}
    		}
    	}
		else return redirect('home');
    }

  //   public function editYeucau(Request $req, $id){

		// if (Auth::check() == 'Admin') {
		// 	try{
		// 		$yeucau = YeuCau::where('id_chitietyc',$id)->update([
		// 		'ma_canbo'=>$req->new_ma_canbo,
		// 		'ma_lophp'=>$req->new_ma_lophp,
		// 		'thu'=>$req->new_thu,
		// 		'buoi'=>$req->new_buoi,
		// 		'id_yeucau '=>$req->new_id_yeucau
		// 			]);
				
				
		// 		return redirect()->back()->with('Edited','Sửa thành công!');
		// 	}
		// 	catch(\Exception $e){
		// 		return redirect()->back()->with('EditFail','Xóa thất bại!');
		// 	}
				
		// }
		// else return redirect('home');
  //   }

    public function deleteYeucau($id){
		if (Auth::check() == 'Admin') {
			// try{
			// 	YeuCau_lth::where('id_yeucau',$id)->delete();
			// 	return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			// }
			// catch(\Exception $e){
			// 	return redirect()->back()->with('ErrorDelete','Xóa thất bại!');
			// }
			$yeucau = YeuCau_lth::where('id_yeucau',$id)->first();
			$yeucau->delete();
			return redirect()->back()->with('SuccessfullyDelete','Xóa thành công!');
			
		}
		else return redirect('home');
    }


}
