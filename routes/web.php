<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ===========
// Admin Route
// ===========
Route::prefix('/admin')->name('admin.')->namespace('App\Http\Controllers\admin')->group(function () {
        Route::match(['get', 'post'], '/', 'AuthController@login')->name('login');
        Route::post('/loginAction', 'AuthController@doLogin')->name('loginAction');
        Route::get('/forgot-password','AuthController@forgotPassword')->name('forgot-password');
        Route::post('/verifyEmail', 'AuthController@verifyEmail')->name('verifyEmail');

      
        Route::middleware('admin')->group(function () {
          Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
          Route::get('/logout', 'AuthController@logout')->name('logout');
          Route::get('/my-profile', 'DashboardController@myProfile')->name('my-profile');
          Route::post('/update-profile', 'DashboardController@updateProfile')->name('update-profile');
          Route::post('/change-password', 'DashboardController@changePassword')->name('change-password');

          // Profession Managemenent
          Route::get('/professionList', 'SpecialityController@specialityList')->name('professionList');
          Route::post('/addSpeciality', 'SpecialityController@addSpeciality')->name('addSpeciality');
          Route::post('/updateSpeciality', 'SpecialityController@updateSpeciality')->name('updateSpeciality');
          Route::post('/deleteSpeciality', 'SpecialityController@deleteSpeciality')->name('deleteSpeciality');  
          Route::post('/getSpeciality', 'SpecialityController@getSpeciality')->name('getSpeciality');  
          
          // Sub Profession  Managemenent
          Route::get('/practitionertypeList/{id}', 'SpecialityController@subspecialityList')->name('practitionertypeList');
          Route::post('/addSubspeciality', 'SpecialityController@addSubspeciality')->name('addSubspeciality');
          Route::post('/updateSubspeciality', 'SpecialityController@updateSubspeciality')->name('updateSubspeciality');
          Route::post('/deleteSubspeciality', 'SpecialityController@deleteSubspeciality')->name('deleteSubspeciality');  
          Route::post('/getSubspeciality', 'SpecialityController@getSubspeciality')->name('getSubspeciality'); 
          Route::get('/practitionersubtypeList/{id}', 'SpecialityController@SubtypeofNurse')->name('practitionersubtypeList');


          // Speciality Managemenent
          Route::get('/specialityList', 'SpecialityController@specialityNewList')->name('specialityList');
          Route::post('/addNewSpeciality', 'SpecialityController@addNewSpeciality')->name('addNewSpeciality');
          Route::post('/updateNewSpeciality', 'SpecialityController@updateNewSpeciality')->name('updateNewSpeciality');
          Route::post('/deleteNewSpeciality', 'SpecialityController@deleteNewSpeciality')->name('deleteNewSpeciality');  
          Route::post('/getNewSpeciality', 'SpecialityController@getNewSpeciality')->name('getNewSpeciality');  
          
          // Sub Job  Managemenent
          Route::get('/subjobSpecialitiesList/{id}', 'SpecialityController@subjobSpecialitiesList')->name('subjobSpecialitiesList');
          Route::post('/addSubspecialityJob', 'SpecialityController@addSubspecialityJob')->name('addSubspecialityJob');
          Route::post('/updateSubspecialityJob', 'SpecialityController@updateSubspecialityJob')->name('updateSubspecialityJob');
          Route::post('/deleteSubspeciality', 'SpecialityController@deleteSubspeciality')->name('deleteSubspeciality');  
          Route::post('/getSubspecialityJob', 'SpecialityController@getSubspecialityJob')->name('getSubspecialityJob'); 

          // Sub  sub Job  Managemenent
          Route::get('/SubsubjobSpecialitiesList/{id}', 'SpecialityController@SubsubjobSpecialitiesList')->name('SubsubjobSpecialitiesList');
          Route::get('/SubSpecialitiesjobList/{id}', 'SpecialityController@SubmenujobSpecialitiesList')->name('SubSpecialitiesjobList');
 
        // Nurse Managemenent
        Route::get('/customer-list', 'NurseController@customerList')->name('customer-list');
        Route::get('/incoming-nurse-list', 'NurseController@incommingNurseList')->name('incoming-nurse-list'); 
        Route::get('/approved-nurse-list', 'NurseController@activeNurseList')->name('approved-nurse-list');
        Route::post('/change-status', 'NurseController@changeStatus')->name('change-status');
        Route::post('/change-status-delete', 'NurseController@changeStatusDelete')->name('change-status-delete');
        Route::post('/change-status-block-unblock', 'NurseController@changeStatusBlockUnblock')->name('change-status-block-unblock');
        Route::get('/view-profile/{id}', 'NurseController@viewProfile')->name('view-profile');
        Route::get('/add-nurse', 'NurseController@addNurse')->name('add_nurse');
        Route::get('/customer-list', 'NurseController@customerList')->name('customer-list'); 
             

          // Skill  Managemenent
          Route::get('/skillList', 'SkillController@skillList')->name('skillList');
          Route::post('/addSkill', 'SkillController@addSkill')->name('addSkill');
          Route::post('/updateSkill', 'SkillController@updateSkill')->name('updateSkill');
          Route::post('/deleteSkill', 'SkillController@deleteSkill')->name('deleteSkill');  
          Route::post('/getSkill', 'SkillController@getSkill')->name('getSkill');

          // Degree  Managemenent
          Route::get('/degreeList', 'DegreeController@degreeList')->name('degreeList');
          Route::post('/addDegree', 'DegreeController@addDegree')->name('addDegree');
          Route::post('/updateDegree', 'DegreeController@updateDegree')->name('updateDegree');
          Route::post('/deleteDegree', 'DegreeController@deleteDegree')->name('deleteDegree');  
          Route::post('/getDegree', 'DegreeController@getDegree')->name('getDegree');

        // Verification Managemenent
        Route::get('/professionVerificationList', 'VerificationController@professionVerificationList')->name('professionVerificationList');
        Route::post('/changeProfessionVerificationStatus', 'VerificationController@changeProfessionVerificationStatus')->name('changeProfessionVerificationStatus');
        Route::get('/policeCheckVerificationList', 'VerificationController@policeCheckVerificationList')->name('policeCheckVerificationList');
        Route::post('/changePoliceCheckVerificationStatus', 'VerificationController@changePoliceCheckVerificationStatus')->name('changePoliceCheckVerificationStatus');
          

         /* contact us list */
         Route::get('/contact-list', 'ContentController@contactList')->name('contact-list');
        });
    });

