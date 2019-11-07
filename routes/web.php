<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/',[
	'as'=>'home',
	'uses'=>'PageController@getIndex'
]);

Route::get('/home',[
	'as'=>'home2',
	'uses'=>'PageController@getIndex'
]);


// ============================================================= Admin
Route::get('dashboard/Admin',[
	'as'=>'admin',
	'uses'=>'AdminController@getIndex'
]);

//============================================================== Lop Hoc Phan
Route::get('admin/lhp',[
	'as'=>'dslhp',
	'uses'=>'AdminController@getDSLHP'
]);

Route::post('addLHP',[
	'as'=>'addLHP',
	'uses'=>'AdminController@addLHP'
]);

Route::get('deleteLHP/{id}',[
	'as'=>'deleteLHP',
	'uses'=>'AdminController@deleteLHP'
]);

Route::get('editLHP/{id}',[
	'as'=>'editLHP',
	'uses'=>'AdminController@editLHP'
]);

Route::post('importLHP',[
	'as'=>'importLHP',
	'uses'=>'AdminController@importLHP'
]);

// Danh sách sv theo lhp
Route::get('dssv/',[
	'as'=>'empty_dssv_lhp',
	'uses'=>'AdminController@empty_dssv_lhp'
]);

Route::get('dssv/{id}',[
	'as'=>'dssv_lhp',
	'uses'=>'AdminController@getDSSVLHP'
]);

Route::get('loadDSSV_LHP',[
	'as'=>'loadDSSV_LHP',
	'uses'=>'AdminController@loadDSSV_LHP'
]);

Route::post('addSV_LHP',[
	'as'=>'addSV_LHP',
	'uses'=>'AdminController@addSV_LHP'
]);

Route::get('deleteSVLHP/{id}',[
	'as'=>'deleteSVLHP',
	'uses'=>'AdminController@deleteSVLHP'
]);

Route::get('reloadDSSV_LHP',[
	'as'=>'reloadDSSV_LHP',
	'uses'=>'AdminController@reloadDSSV_LHP'
]);

Route::post('importSVLHP',[
	'as'=>'importSVLHP',
	'uses'=>'AdminController@importSVLHP'
]);
//============================================================== Hoc ky
Route::get('admin/hk',[
	'as'=>'hocky',
	'uses'=>'AdminController@getHK'
]);

Route::post('addHK',[
	'as'=>'addHK',
	'uses'=>'AdminController@addHK'
]);

Route::get('deleteHK/{id}',[
	'as'=>'deleteHK',
	'uses'=>'AdminController@deleteHK'
]);

Route::get('editHK/{id}',[
	'as'=>'editHK',
	'uses'=>'AdminController@editHK'
]);

Route::get('dslhp/',[
	'as'=>'no_dslhp',
	'uses'=>'AdminController@no_dslhp'
]);

Route::get('dslhp/{id}',[
	'as'=>'dslhp',
	'uses'=>'AdminController@get_dslhp'
]);

Route::get('loadDSLHP_HK',[
	'as'=>'loadDSLHP_HK',
	'uses'=>'AdminController@loadDSLHP_HK'
]);

Route::post('editHKStatus/',[
	'as'=>'editHKStatus',
	'uses'=>'AdminController@editHKStatus'
]);

//============================================================== Lop
Route::get('admin/lop',[
	'as'=>'lop',
	'uses'=>'AdminController@getLop'
]);

Route::get('loadLop',[
	'as'=>'loadLop',
	'uses'=>'AdminController@loadLop'
]);

Route::post('addClass',[
	'as'=>'addClass',
	'uses'=>'AdminController@addClass'
]);

Route::get('editClass/{id}',[
	'as'=>'editClass',
	'uses'=>'AdminController@editClass'
]);

Route::get('deleteLop/{id}',[
	'as'=>'deleteLop',
	'uses'=>'AdminController@deleteLop'
]);


//================================================================ Ngành
Route::get('admin/nganh',[
	'as'=>'nganh',
	'uses'=>'AdminController@getNganh'
]);

Route::post('addMajor',[
	'as'=>'addMajor',
	'uses'=>'AdminController@addMajor'
]);

Route::get('editMajor/{id}',[
	'as'=>'editMajor',
	'uses'=>'AdminController@editMajor'
]);

Route::get('deleteMajor/{id}',[
	'as'=>'deleteMajor',
	'uses'=>'AdminController@deleteMajor'
]);


//================================================================ Môn học
Route::get('admin/monhoc',[
	'as'=>'monhoc',
	'uses'=>'AdminController@getMon'
]);

Route::post('addSubject',[
	'as'=>'addSubject',
	'uses'=>'AdminController@addSubject'
]);

Route::post('importSubject',[
	'as'=>'importSubject',
	'uses'=>'AdminController@importSubject'
]);

Route::get('editSubject/{id}',[
	'as'=>'editSubject',
	'uses'=>'AdminController@editSubject'
]);

Route::get('deleteSubject/{id}',[
	'as'=>'deleteSubject',
	'uses'=>'AdminController@deleteSubject'
]);

//============================================================ Cán bộ
Route::get('admin/dscb',[
	'as'=>'dscb',
	'uses'=>'AdminController@getDSCB'
]);

Route::post('importCB',[
	'as'=>'importCB',
	'uses'=>'AdminController@importCB'
]);

Route::post('addCB',[
	'as'=>'addCB',
	'uses'=>'AdminController@addCB'
]);

Route::get('editCB/{id}',[
	'as'=>'editCB',
	'uses'=>'AdminController@editCB'
]);

Route::post('deleteCB',[
	'as'=>'deleteCB',
	'uses'=>'AdminController@deleteCB'
]);

//============================================================ Sinh viên
Route::get('admin/dssv',[
	'as'=>'dssv',
	'uses'=>'AdminController@getDSSV'
]);

Route::post('importSV',[
	'as'=>'importSV',
	'uses'=>'AdminController@importSV'
]);

Route::post('addSV',[
	'as'=>'addSV',
	'uses'=>'AdminController@addSV'
]);

Route::get('editSV/{id}',[
	'as'=>'editSV',
	'uses'=>'AdminController@editSV'
]);

Route::post('deleteSV',[
	'as'=>'deleteSV',
	'uses'=>'AdminController@deleteSV'
]);

//============================================================ phan mem
Route::get('admin/phanmem',[
	'as'=>'getPhanmem',
	'uses'=>'AdminController@getPhanmem'
]);

Route::post('addPM',[
	'as'=>'addPM',
	'uses'=>'AdminController@addPM'
]);

Route::get('editPM/{id}',[
	'as'=>'editPM',
	'uses'=>'AdminController@editPM'
]);

Route::get('deletePM/{id}',[
	'as'=>'deletePM',
	'uses'=>'AdminController@deletePM'
]);

//============================================================Phong
Route::get('admin/phong',[
	'as'=>'getPhong',
	'uses'=>'AdminController@getPhong'
]);

Route::post('addPhong',[
	'as'=>'addPhong',
	'uses'=>'AdminController@addPhong'
]);

Route::get('editPhong/{id}',[
	'as'=>'editPhong',
	'uses'=>'AdminController@editPhong'
]);

Route::get('deletePhong/{id}',[
	'as'=>'deletePhong',
	'uses'=>'AdminController@deletePhong'
]);

Route::get('loadPMofROOM',[
	'as'=>'loadPMofROOM',
	'uses'=>'AdminController@loadPMofROOM'
]);

Route::get('loadallPM',[
	'as'=>'loadallPM',
	'uses'=>'AdminController@loadallPM'
]);

Route::post('addPM_R',[
	'as'=>'addPM_R',
	'uses'=>'AdminController@addPM_R'
]);

Route::get('/deletePMR',[
	'as'=>'deletePMR',
	'uses'=>'AdminController@deletePMR'
]);

//============================================================ yeucau
Route::get('admin/yeucau',[
	'as'=>'getYeucau',
	'uses'=>'AdminController@getYeucau'
]);

Route::post('addYeucau',[
	'as'=>'addYeucau',
	'uses'=>'AdminController@addYeucau'
]);

Route::get('editYeucau',[
	'as'=>'editYeucau',
	'uses'=>'AdminController@editYeucau'
]);

Route::get('deleteYeucau/{id}',[
	'as'=>'deleteYeucau',
	'uses'=>'AdminController@deleteYeucau'
]);

Route::get('loadYC',[
	'as'=>'loadYC',
	'uses'=>'AdminController@loadYC'
]);

Route::post('sapxep',[
	'as'=>'sapxep',
	'uses'=>'AdminController@sapxep'
]);
//============================================================



//========================== teacher  ==========================



//============================================================ yeu cau sap phong
Route::get('teacher/lhp',[
	'as'=>'teacher_lhp',
	'uses'=>'TeacherController@teacher_lhp'
]);

Route::post('addYeucaulth',[
	'as'=>'addYeucaulth',
	'uses'=>'TeacherController@addYeucaulth'
]);
//============================================================ 
Route::get('teacher/dashboard',[
	'as'=>'teacher_dashboard',
	'uses'=>'TeacherController@teacher_dashboard'
]);
//============================================================ thong bao
Route::get('teacher/noti',[
	'as'=>'teacher_noti',
	'uses'=>'TeacherController@teacher_noti'
]);
//============================================================ phan hoi
Route::get('teacher/feedback',[
	'as'=>'teacher_feedback',
	'uses'=>'TeacherController@teacher_feedback'
]);

Route::post('/addFeedback',
 	'PageController@postFeedback');

Route::get('reload_fb',[
	'as'=>'reload_fb',
	'uses'=>'TeacherController@reload_Fb'
]);

//============================================================

//============================================================ diem danh

Route::get('teacher/attendance',[
	'as'=>'teacher_attendance',
	'uses'=>'TeacherController@teacher_attendance'
]);

Route::get('reload_Teacher_attendance',[
	'as'=>'reload_Teacher_attendance',
	'uses'=>'TeacherController@reload_Teacher_attendance'
]);

Route::post('addAttendance',[
	'as'=>'addAttendance',
	'uses'=>'TeacherController@addAttendance'
]);

Route::post('removeAttendance',[
	'as'=>'removeAttendance',
	'uses'=>'TeacherController@removeAttendance'
]);

//============================================================ my calendar

Route::get('teacher/mycalendar',[
	'as'=>'teacher_mycalendar',
	'uses'=>'TeacherController@teacher_mycalendar'
]);

//===================================doi mat khau
Route::get('/changepass',[
	'as'=>'changepass',
	'uses'=>'PageController@getChangePass'
]);

Route::post('changepassword', 'PageController@postChangePassword');


//========================================trang thai
Route::get('/chapnhanfb/{id}', 
	'PageController@postChapNhan');

Route::get('/tuchoifb/{id}', 
	'PageController@postTuChoi');