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
  Route::get('/forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
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
    Route::post('/viewsubprofessionalcert', 'SpecialityController@addSubspeciality')->name('addSubspeciality');


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
    Route::post('/send_remainder', 'NurseController@send_remainder')->name('send_remainder');
    Route::get('/complete-profile-nurse-list', 'NurseController@completeprofileNurseList')->name('complete-nurse-nurse-list');
    Route::get('/inprogess-profile-nurse-list', 'NurseController@inProgressprofileNurseList')->name('inprogess-nurse-nurse-list');
    Route::get('/approved-nurse-list', 'NurseController@activeNurseList')->name('approved-nurse-list');
    Route::post('/change-status', 'NurseController@changeStatus')->name('change-status');
    Route::post('/change-status-delete', 'NurseController@changeStatusDelete')->name('change-status-delete');
    Route::post('/change-status-block-unblock', 'NurseController@changeStatusBlockUnblock')->name('change-status-block-unblock');
    Route::get('/view-profile/{id}', 'NurseController@viewProfile')->name('view-profile');
    Route::get('/view-certicate/{id}', 'NurseController@view_certificate')->name('view-certicate');
    Route::any('/add-nurse', 'NurseController@addNurse')->name('add_nurse');
    Route::post('/add-nurse-post-1', 'NurseController@addNursePostForm1')->name('add_nurse_post_1');
    Route::post('/add-nurse-post-2', 'NurseController@addNursePostForm2')->name('add_nurse_post_2');
    Route::post('/add-nurse-post-3', 'NurseController@addNursePostForm3')->name('add_nurse_post_3');
    Route::post('/add-nurse-post-4', 'NurseController@addNursePostForm4')->name('add_nurse_post_4');
    Route::post('/add-nurse-post-5', 'NurseController@addNursePostForm5')->name('add_nurse_post_5');
    Route::post('/add-nurse-post-6', 'NurseController@addNursePostForm6')->name('add_nurse_post_6');
    Route::post('/add-nurse-post-7', 'NurseController@addNursePostForm7')->name('add_nurse_post_7');
    Route::post('/add-nurse-post-8', 'NurseController@addNursePostForm8')->name('add_nurse_post_8');
    Route::post('/add-nurse-post-9', 'NurseController@addNursePostForm9')->name('add_nurse_post_9');
    Route::post('/add-nurse-post-10', 'NurseController@addNursePostForm10')->name('add_nurse_post_10');
    Route::post('/add-nurse-post-11', 'NurseController@addNursePostForm11')->name('add_nurse_post_11');
    Route::post('/add-nurse-post-13', 'NurseController@addNursePostForm13')->name('add_nurse_post_13');
    Route::post('/add-nurse-post-14', 'NurseController@addNursePostForm14')->name('add_nurse_post_14');
    Route::post('/add-nurse-post-15', 'NurseController@addNursePostForm15')->name('add_nurse_post_15');
    Route::get('/edit-nurse/{id?}', 'NurseController@EditNurse')->name('edit_nurse');
    Route::post('/edit-nurse-post', 'NurseController@EditNursePost')->name('edit_nurse_post');
    Route::post('/delete-cer-img', 'NurseController@deleteCertificateImg')->name('delete_cer_img');
    Route::post('/upload-deg-img', 'NurseController@UploadDegreeImg')->name('upload-deg-img');
    Route::post('/dlt-deg-img', 'NurseController@deleteDegImg')->name('dlt-deg-img');
    Route::post('/uploadImgs', 'NurseController@uploadImgs')->name('uploadImgs1');
    Route::post('/dlt-deg-img', 'NurseController@deleteDegImg')->name('dlt-deg-img');
    Route::post('/deleteImg1', 'NurseController@deleteImg1')->name('deleteImg1');
    Route::post('/uploadmantraImgs1', 'NurseController@uploadmantraImgs1')->name('uploadmantraImgs1');
    Route::post('/uploadAnotherImgs', 'NurseController@uploadAnotherImgs')->name('uploadAnotherImgs');
    Route::post('/deleteAnoImg1', 'NurseController@deleteAnoImg1')->name('deleteAnoImg1');
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

    // Certificate  Managemenent
    Route::get('/professional-certificate-list', 'ProfessionalcerController@certificateList')->name('certificateList');
    Route::post('/add-certificate', 'ProfessionalcerController@addCertificate')->name('addcertificate');
    Route::post('/update-certificate', 'ProfessionalcerController@updateCertificate')->name('updateCertificate');
    Route::post('/delete-certificate', 'ProfessionalcerController@deleteCertificate')->name('deleteCertificate');
    Route::post('/get-certificate', 'ProfessionalcerController@getCertificate')->name('getCertificate');

    //Sub certificated Management
    Route::get('/professional-subcertificate-list/{id}', 'ProfessionalcerController@certificateSubList')->name('professional-subcertificate-list');
    Route::post('/addGeneralCertificate', 'ProfessionalcerController@addGeneralCertificate')->name('addGeneralCertificate');
    Route::post('/get-sub-certificate', 'ProfessionalcerController@getsubCertificate')->name('getsubCertificate');
    Route::post('/update-sub-certificate', 'ProfessionalcerController@updatesubCertificate')->name('updatesubCertificate');
    Route::post('/delete-sub-certificate', 'ProfessionalcerController@deleteSubCertificate')->name('deleteSubCertificate');

    //Training  Managemenent
    Route::get('/training-list', 'TrainingController@TrainingList')->name('TrainingList');
    Route::post('/add-training', 'TrainingController@addTraining')->name('addTraining');
    Route::post('/update-training', 'TrainingController@updateTraining')->name('updateTraining');
    Route::post('/delete-training', 'TrainingController@deleteTraining')->name('deleteTraining');
    Route::post('/get-training', 'TrainingController@getTraining')->name('getTraining');

    //Vaccination  Managemenent
    Route::get('/vaccination-list', 'VaccinationController@VaccinationList')->name('VaccinationList');
    Route::post('/add-vaccination', 'VaccinationController@addVaccination')->name('addVaccination');
    Route::post('/update-vaccination', 'VaccinationController@updateVaccination')->name('updateVaccination');
    Route::post('/delete-vaccination', 'VaccinationController@deleteVaccination')->name('deleteVaccination');
    Route::post('/get-vaccination', 'VaccinationController@getVaccination')->name('getVaccination');
    Route::get('/evidence-list', 'VaccinationController@EvidenceList')->name('EvidenceList');
    Route::post('/add-evidence', 'VaccinationController@addEvidence')->name('addEvidence');
    Route::post('/get-evidence', 'VaccinationController@getEvidence')->name('getEvidence');
    Route::post('/update-evidence', 'VaccinationController@updateEvidence')->name('updateEvidence');
    Route::post('/delete-evidence', 'VaccinationController@deleteEvidence')->name('deleteEvidence');
    Route::get('/immunization-status-list', 'VaccinationController@imStatusList')->name('imStatusList');
    Route::post('/add-imm-status', 'VaccinationController@addImmStatus')->name('addImmStatus');
    Route::post('/get-imm-status', 'VaccinationController@getImmStatus')->name('getImmStatus');
    Route::post('/update-imm-status', 'VaccinationController@updateImmStatus')->name('updateImmStatus');
    Route::post('/delete-imm-status', 'VaccinationController@deleteImmStatus')->name('deleteImmStatus');

    //Seo  Managemenent
    Route::get('/content_pagelist', 'SeoController@SeoList')->name('SeoList');
    Route::post('/add-page', 'SeoController@addSeo')->name('addSeo');
    Route::post('/update-seo', 'SeoController@updateSeo')->name('updateSeo');
    Route::post('/delete-seo', 'SeoController@deleteSeo')->name('deleteSeo');
    Route::post('/get-seo', 'SeoController@getSeo')->name('getSeo');

    //Mandatory Training  and Education 
    Route::get('/training-education-list', 'MantrainingController@mantrainingList')->name('traeductionList');
    Route::post('/add-man-training', 'MantrainingController@addManTraining')->name('addManTraining');
    Route::post('/update-man-training', 'MantrainingController@updateManTraining')->name('updateManTraining');
    Route::post('/delete-man-training', 'MantrainingController@deleteManTraining')->name('deleteManTraining');
    Route::post('/get-man-training', 'MantrainingController@getManTraining')->name('getManTraining');
    Route::get('/sub-training-education-list/{id}', 'MantrainingController@subManTrainingList')->name('subManTrainingList');
    Route::post('/add-sub-man-training', 'MantrainingController@addSubMantraining')->name('addSubMantraining');
    Route::post('/delete-sub-man-training', 'MantrainingController@deleteSubMantraining')->name('deleteSubMantraining');
    Route::post('/get-sub-man-training', 'MantrainingController@getSubMantraining')->name('getSubMantraining');
    Route::post('/update-sub-man-training', 'MantrainingController@updateSubMantraining')->name('updateSubMantraining');

    /* contact us list */
    Route::get('/contact-list', 'ContentController@contactList')->name('contact-list');

    // tab routes
    Route::any('/exp-tab/{id?}', 'NurseController@viewExpTab')->name('exptab');
    Route::any('/man-tra-tab/{id?}', 'NurseController@viewManTraTab')->name('mantratab');
    Route::post('/getSkillsData', 'NurseController@getSkillsData')->name('getSkillsData');
    Route::post('/exp-data', 'NurseController@Experienceupdate')->name('exp-data');
    Route::post('/man-tr-data', 'NurseController@ManTraupdate')->name('man-tr-data');

    /************[Nurse Profile Vaccination]*************/
    Route::post('/addNurseVaccination', 'NurseController@addNurseVaccination')->name('addNurseVaccination');
    Route::any('/updateVaccinationRecord/{id?}', 'NurseController@updateVaccinationRecord')->name('updateVaccinationRecord');
    Route::any('/getVaccinationData', 'NurseController@getVaccinationData')->name('getVaccinationData');
    Route::any('/removeEvidanceFile', 'NurseController@removeEvidanceFile')->name('removeEvidanceFile');
    Route::post('/removeVaccine', 'NurseController@removeVaccine')->name('removeVaccine');
    Route::any('/removeEvidance', 'NurseController@removeEvidance')->name('removeEvidance');
    Route::any('/updateNurseVaccination', 'NurseController@updateNurseVaccination')->name('updateNurseVaccination');

    /************[Nurse Profile Work Cleareance]*************/
    Route::any('/updateWorkClreance/{id?}', 'NurseController@updateWorkClreance')->name('updateWorkClreance');
    Route::post('/update-profession-user-eligibility', 'NurseController@update_eligibility_to_work')->name('update-profession-user-eligibility');
    Route::post('/update-ndis', 'NurseController@updateNdis')->name('update-ndis');
    Route::post('/update-profession-user-children', 'NurseController@update_children_to_work')->name('update-profession-user-children');
    Route::post('/removeWwcc', 'NurseController@removeWwcc')->name('removeWwcc');
    Route::post('/update-profession-user-police-check', 'NurseController@update_police_check_to_work')->name('update-profession-user-police-check');
    Route::post('/updateSpecializedClearance', 'NurseController@updateSpecializedClearance')->name('updateSpecializedClearance');
    Route::post('/removeSpecialized', 'NurseController@removeSpecialized')->name('removeSpecialized');

     /************[Professional Membership & Awards]*************/
    Route::any('/professionalMembership','NurseController@professionalMembership')->name('professionalMembership');
    Route::get('/organization_country_list','ProfessionalMembership@countryList')->name('organization_country_list');
    Route::post('/addCountry', 'ProfessionalMembership@addCountry')->name('addCountry');
    Route::post('/getCountry', 'ProfessionalMembership@getCountry')->name('getCountry');
    Route::post('/updateCountry', 'ProfessionalMembership@updateCountry')->name('updateCountry');
    Route::post('/deleteCountry', 'ProfessionalMembership@deleteCountry')->name('deleteCountry');
    Route::get('/suborganization_country_list/{id}','ProfessionalMembership@subcountryList')->name('suborganization_country_list'); 
    Route::get('/suborganization_country/{id}/{country_id}','ProfessionalMembership@subcountry')->name('suborganization_country');
    Route::get('/membershipType', 'ProfessionalMembership@membershipType')->name('membershipType'); 
    Route::get('/submembershipType/{id}', 'ProfessionalMembership@subMemberList')->name('submembershipType'); 
    Route::post('/addMembershipType', 'ProfessionalMembership@addMembershipType')->name('addMembershipType');
  });
});
