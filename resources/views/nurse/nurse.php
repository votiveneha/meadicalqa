<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|ererer
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ===========
// User Route
// ===========

Route::post('/fetch-provinces', 'App\Http\Controllers\HomeController@fetchProvinces')->name('fetch-provinces');
Route::get('/', 'App\Http\Controllers\nurse\HomeController@index_main')->name('home_main');
Route::get('/term-and-condition', 'App\Http\Controllers\nurse\HomeController@term_and_condition')->name('term-and-condition');
Route::get('/contact', 'App\Http\Controllers\nurse\HomeController@contact')->name('contact');
Route::get('/about', 'App\Http\Controllers\nurse\HomeController@about')->name('about');
Route::get('/privacy', 'App\Http\Controllers\nurse\HomeController@privacy')->name('privacy');
Route::post('/save-contact', 'App\Http\Controllers\HomeController@saveContact')->name('save-contact');
Route::post('/getNurseTypeJobs', 'App\Http\Controllers\HomeController@getNurseTypeJobs')->name('getNurseTypeJobs');
Route::get('/nurseCareHome', 'App\Http\Controllers\HomeController@nurseCareHome')->name('nurseCareHome');
Route::post('/getSubSpecialties', 'App\Http\Controllers\HomeController@getSubSpecialties')->name('getSubSpecialties');
Route::post('/getNursepractitionorSpecialities', 'App\Http\Controllers\HomeController@getNurseSpecialties')->name('getNursepractitionorSpecialities');
Route::post('/getsurgicalSpeciality', 'App\Http\Controllers\HomeController@getsurgicalSpeciality')->name('getsurgicalSpeciality');
Route::post('/getsurgicalSubSpeciality', 'App\Http\Controllers\HomeController@getsurgicalSubSpeciality')->name('getsurgicalSubSpeciality');

Route::prefix('healthcare-facilities')->name('medical-facilities.')->namespace('App\Http\Controllers\medical_facilities')->group(function () {
  Route::get('/', 'HomeController@index_main')->name('medical_facilities_home_main');
  Route::get('/medical-facilities-registraion', 'HomeController@registraion')->name('medical-facilities-registraion');

  Route::middleware('nurse_middle')->group(function () {});
});

Route::prefix('agencies')->name('agencies.')->namespace('App\Http\Controllers\agencies')->group(function () {
  Route::get('/', 'HomeController@index_main')->name('agencies_home_main');
  Route::get('/agencies-registraion', 'HomeController@registraion')->name('agencies-registraion');


  Route::middleware('nurse_middle')->group(function () {});
});
Route::prefix('nurse')->name('nurse.')->namespace('App\Http\Controllers\nurse')->group(function () {

  Route::get('/forgot-password', 'HomeController@forgotPassword')->name('forgot-password');
  Route::post('/forgot-password', 'HomeController@SendResetPasswordLink')->name('send-reset-password-link');
  Route::post('/addnewsletter', 'HomeController@addnewsletters')->name('addnewsletter');
  Route::post('/contact_us_data', 'HomeController@contact_us_data')->name('contact_us_data');

  Route::get('/reset-password/{token}/{lp}', 'HomeController@ResetPassword')->name('reset-password');
  Route::post('/reset-password', 'HomeController@UpdatePassword')->name('update-password');

  Route::post('/userloginAction', 'HomeController@userloginAction')->name('userloginAction');
  Route::post('/mail-exist', 'HomeController@mail_exist')->name('mail-exist');

  Route::get('/fetch-subspecialty', 'HomeController@fetchSubspecialty')->name('fetch-subspecialty');
  Route::get('/logout', 'HomeController@logout')->name('logout');
  Route::get('/login', 'HomeController@login')->name('login');

  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/nurse-register', 'HomeController@nurse_register')->name('nurse-register');
  Route::get('/email-verification-pending', 'HomeController@emailVerificationPending')->name('email-verification-pending');
  Route::get('/resent-verification', 'HomeController@resentVerification')->name('resent-verification-link');
  Route::get('/email-verification/{token}', 'HomeController@email_verification')->name('email-verification');
  Route::post('/do-nurse-register', 'HomeController@do_nurse_register')->name('do-nurse-register');
  Route::get('/profile-under-reviewed', 'HomeController@profileUnderReviewed')->name('profile-under-reviewed');
  Route::middleware('nurse_middle')->group(function () {
    Route::get('/my-profile', 'HomeController@manage_profile')->name('my-profile');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::post('/changepassword', 'HomeController@changepassword')->name('changepassword');
    Route::post('/updateProfile', 'HomeController@updateProfile')->name('updateProfile');
    Route::post('/user-upload-image', 'HomeController@upload_profile_image')->name('user-upload-image');
    Route::post('/change_password', 'HomeController@change_password')->name('change_password');
    Route::post('/update-profession', 'HomeController@update_profession')->name('update-profession');
    Route::post('/update-profession-user-ahpra_numberI', 'HomeController@update_profession_ahpra_numberI')->name('update-profession-user-ahpra_numberI');
    
    
    
    Route::post('/update-profession-user-emergency', 'HomeController@update_emergency')->name('update-profession-user-emergency');
    Route::post('/update-profession-profile-setting', 'HomeController@update_profession_profile_setting')->name('update-profession-profile-setting');
    Route::post('/updateProfession', 'HomeController@updateProfession')->name('updateProfession');
    Route::post('/updateEducation', 'HomeController@updateEducation')->name('updateEducation');
    Route::post('/updateExperience', 'HomeController@updateExperience')->name('updateExperience');
    Route::post('/updateTraining', 'HomeController@updateTraining')->name('updateTraining');
    Route::post('/updateInterview', 'HomeController@updateInterview')->name('updateInterview');
    Route::post('/updatePreferences', 'HomeController@updatePreferences')->name('updatePreferences');
    Route::post('/updateWorkPreference', 'HomeController@updateWorkPreference')->name('updateWorkPreference');
    
    Route::post('/updateAdditionalInfo', 'HomeController@updateAdditionalInfo')->name('updateAdditionalInfo');
    Route::post('/updateReference', 'HomeController@updateReference')->name('updateReference');
    
    Route::post('/deleteReferee', 'HomeController@deleteReferee')->name('deleteReferee');
    Route::post('/deleteCertification', 'HomeController@deleteCertification')->name('deleteCertification');
    Route::post('/deleteOtherTraining', 'HomeController@deleteOtherTraining')->name('deleteOtherTraining');
    Route::post('/deleteOtherEducation', 'HomeController@deleteOtherEducation')->name('deleteOtherEducation');
    Route::post('/deleteWorkExperience', 'HomeController@deleteWorkExperience')->name('deleteWorkExperience');
    Route::post('/deleteImg', 'HomeController@deleteImg')->name('deleteImg');
    Route::post('/deleteImg1', 'HomeController@deleteImg1')->name('deleteImg1');
    Route::post('/deleteImgCert', 'HomeController@deleteImgCert')->name('deleteImgCert');
    Route::post('/uploadImgs', 'HomeController@uploadImgs')->name('uploadImgs');
    Route::post('/uploadImgs1', 'HomeController@uploadImgs1')->name('uploadImgs1');
    Route::post('/uploadmantraImgs1', 'HomeController@uploadmantraImgs1')->name('uploadmantraImgs1');
    Route::post('/uploadAnotherImgs', 'HomeController@uploadAnotherImgs')->name('uploadAnotherImgs');
    Route::post('/deleteTraining', 'HomeController@deleteTraining')->name('deleteTraining');
    Route::post('/deleteAnoImg1', 'HomeController@deleteAnoImg1')->name('deleteAnoImg1');
    Route::post('/deleteImg12', 'HomeController@deleteImg12')->name('deleteImg12');
    Route::post('/deleteotherImg', 'HomeController@deleteotherImg')->name('deleteotherImg');
    Route::post('/deletecertification_img', 'HomeController@deletecertification_img')->name('deletecertification_img');
    Route::post('/getSkillsData', 'HomeController@getSkillsData')->name('getSkillsData');
	  Route::post('/deleteevidence', 'HomeController@deleteEvidence')->name('deleteEvidence');
	
	/**************[Profile Vaccination]**************/
	Route::post('/vaccinationForm', 'HomeController@vaccinationForm')->name('vaccinationForm');
    Route::any('/profileVaccination', 'HomeController@profileVaccination')->name('profileVaccination');
    Route::post('/removeVaccine', 'HomeController@removeVaccine')->name('removeVaccine');
    Route::post('/getContent', 'HomeController@getContent')->name('getContent');
    Route::any('/getVaccinationData', 'HomeController@getVaccinationData')->name('getVaccinationData');
    Route::any('/removeEvidanceFile','HomeController@removeEvidanceFile')->name('removeEvidanceFile');
    Route::any('/removeEvidance','HomeController@removeEvidance')->name('removeEvidance');
	
	/**************[Work Clearance]**************/
  Route::any('/workClearances','ProfessionalController@workClearances')->name('workClearances');
  Route::post('/update-profession-user-eligibility', 'ProfessionalController@update_eligibility_to_work')->name('update-profession-user-eligibility');
  Route::post('/update-ndis', 'ProfessionalController@updateNdis')->name('update-ndis');
  Route::post('/update-profession-user-children', 'ProfessionalController@update_children_to_work')->name('update-profession-user-children');
  Route::post('/removeWwcc', 'ProfessionalController@removeWwcc')->name('removeWwcc');
  Route::post('/update-profession-user-police-check', 'ProfessionalController@update_police_check_to_work')->name('update-profession-user-police-check');
  Route::post('/updateSpecializedClearance', 'ProfessionalController@updateSpecializedClearance')->name('updateSpecializedClearance');
  Route::post('/removeSpecialized', 'ProfessionalController@removeSpecialized')->name('removeSpecialized');

  Route::any('/removeEligibilityFile','ProfessionalController@removeEligibilityFile')->name('removeEligibilityFile');
  Route::any('/removendisFile','ProfessionalController@removendisFile')->name('removendisFile');
  Route::any('/removewwccFile','ProfessionalController@removewwccFile')->name('removewwccFile');
  Route::any('/removePolicyFile','ProfessionalController@removePolicyFile')->name('removePolicyFile');
  Route::any('/removeSpecializedFile','ProfessionalController@removeSpecializedFile')->name('removeSpecializedFile');

  /**************[Setting & Availability]**************/
  Route::get('/setting_availablity', 'HomeController@setting_availablity')->name('setting_availablity');
  Route::post('/update-profession-profile-setting', 'HomeController@update_profession_profile_setting')->name('update-profession-profile-setting');
  
  /**************[Professional Membership]**************/
  Route::any('/professionalMembership','ProfessionalController@professionalMembership')->name('professionalMembership');
  Route::any('/getCountryOrgnizations','ProfessionalController@getCountryOrgnizations')->name('getCountryOrgnizations');
  Route::any('/getCountrySubOrgnizations','ProfessionalController@getCountrySubOrgnizations')->name('getCountrySubOrgnizations');
  Route::any('/getMembershipData','ProfessionalController@getMembershipData')->name('getMembershipData');
  Route::any('/getSubMembershipData','ProfessionalController@getSubMembershipData')->name('getSubMembershipData');
  Route::any('/getawardsRecognitions','ProfessionalController@getawardsRecognitions')->name('getawardsRecognitions');
  Route::post('/updateProfessionalMembership', 'ProfessionalController@updateProfessionalMembership')->name('updateProfessionalMembership');
  Route::post('/uploadMembershipImgs', 'ProfessionalController@uploadMembershipImgs')->name('uploadMembershipImgs');
  Route::post('/uploadAwardImgs', 'ProfessionalController@uploadAwardImgs')->name('uploadAwardImgs');
  Route::post('/deleteEvidenceImg', 'ProfessionalController@deleteEvidenceImg')->name('deleteEvidenceImg');
  Route::post('/deleteAwardEvidenceImg', 'ProfessionalController@deleteAwardEvidenceImg')->name('deleteAwardEvidenceImg');
  
  /**************[Interview Preferences]**************/
  Route::any('/interview','ProfessionalController@interview')->name('interview');
  
  });
});
