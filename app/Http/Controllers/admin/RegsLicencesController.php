<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;


use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\MandatoryTrainModel;
use Carbon\Carbon;
use File;
use DB;
use Helpers;

class RegsLicencesContoller extends Controller{

    public function registration_licences(Request $request)
    {
        $user_id = $request->id;
        $data['licenses_data'] = LicensesModel::where("user_id",$user_id)->first();
        return view ("admin.edit_registration_licenses")->with($data);
    }

    public function ahepra_lookup(Request $request, AhpraLookupService11 $ahpra)
    {
       $ahpraNumber = $request->input('ahpraNumber');

    $queryUrl = 'https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx?' . http_build_query([
        'RegistrationNumber' => $ahpraNumber
    ]);

    try {
        // Set timeout and retries for better stability
        $response = Http::timeout(20)->retry(3, 1000)->get($queryUrl);

        if ($response->failed()) {
            Log::warning("AHPRA request failed. Status: " . $response->status());
            return response()->json(['error' => 'Failed to contact AHPRA register. Please try again later.'], 503);
        }

        $html = $response->body();

        // Basic "No Records" check
        if (stripos($html, 'No records found') !== false) {
            return response()->json(['error' => 'No practitioner found with this AHPRA number.'], 404);
        }

        // Parse the HTML
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML($html);
        $xpath = new \DOMXPath($doc);

        $extract = function ($label) use ($xpath) {
            $nodeList = $xpath->query("//td[contains(text(), '$label')]/following-sibling::td");
            return $nodeList->length > 0 ? trim($nodeList->item(0)->textContent) : null;
        };

        $result = [
            'division' => $extract('Division'),
            'endorsements' => $extract('Endorsements'),
            'registration_type' => $extract('Registration Type'),
            'registration_status' => $extract('Registration Status'),
            'notations' => $extract('Notations'),
            'conditions' => $extract('Conditions'),
            'expiry' => $extract('Expiry Date'),
            'principal_place' => $extract('Principal Place of Practice'),
            'other_places' => $extract('Other Places of Practice'),
        ];

        // Check if all fields are null
        $allNull = empty(array_filter($result, fn($value) => !is_null($value)));

        if ($allNull) {
            return response()->json(['error' => 'No valid registration data found for this AHPRA number.']);
        }

        return response()->json($result);

    } catch (\Exception $e) {
        Log::error("AHPRA lookup exception: " . $e->getMessage());
        return response()->json(['error' => 'AHPRA service is currently unavailable. Please try again shortly.']);
    }

        
        
        
    }

    public function update_registration_licenses(Request $request){
        $ahpra_registration_status = $request->ahpra_registration_status;
        $user_id = $request->user_id;

        
        //print_r($authorizing_body_program);die;

        if($ahpra_registration_status == "RN" || $ahpra_registration_status == "RM" || $ahpra_registration_status == "RN_RM" || $ahpra_registration_status == "NP"){
            $ahpra_number = $request->ahpra_number;
            $ahpra_consent = isset($request->ahpra_consent)?1:0;
            
            $upload_register_evidence = $request->registration_upload;
            $last_verified_date = $request->last_verified_date;
            $api_verify = $request->api_verify;

            if($api_verify == 1){
                $division = $request->api_division;
                $endorsements = $request->api_endorsements;
                $registration_type = $request->api_reg_type;
                $registration_status = $request->api_reg_status;
                $notations = $request->api_notations;
                $other_notation = "";
                $conditions = $request->api_conditions;
                $other_condition = "";
                $expiry_date = $request->api_expiry;
                $principal_place = $request->api_principal_practice;
                $api_other_practices = $request->api_other_practices;
            }else{
                $division = $request->division;
                $endorsements = $request->endorsements;
                $registration_type = $request->reg_registration_type;
                $registration_status = $request->reg_registration_status;
                $notation_toggle = isset($request->notation_toggle)?1:0;

                if($notation_toggle == 1){
                    $notations = json_encode($request->notations);
                    $other_notation = $request->other_notation;
                }else{
                    $notations = "";
                    $other_notation = "";
                }

                $condition_toggle = isset($request->condition_toggle)?1:0;

                if($notation_toggle == 1){
                    $conditions = json_encode($request->conditions);
                    $other_condition = $request->other_condition;
                }else{
                    $conditions = "";
                    $other_condition = "";
                }
                
                
                $expiry_date = $request->expiry_date;
                $principal_place = $request->principal_place;
                $other_places = json_encode($request->other_places);
            }
            
            $upload_graduation_evidence = "";
            $upload_overseas_evidence = "";
            $upload_not_reg_evidence = "";
            $graduate_ahpra_number = "";
            $graduate_division = "";
            $graduate_registration_type = "";
            $graduate_registration_status = "";
            $graduate_date = "";

            $overseas_qualified = "";
            $overseas_other_text = "";

            $not_registered = "";
            $education_related = "";
            $returning_practice = "";
            $personal_career = "";
            $not_registered_other = "";
            
        }

        if($ahpra_registration_status == "Graduate_RN" || $ahpra_registration_status == "Graduate_RM" || $ahpra_registration_status == "Student_Nurse" || $ahpra_registration_status == "Student_Midwife"){
            $ahpra_number = "";
            $ahpra_consent = "";
            $division = "";
            $endorsements = "";
            $registration_type = "";
            $registration_status = "";
            $notations = "";
            $other_notation = "";
            $conditions = "";
            $expiry_date = "";
            $principal_place = "";
            $other_places = "";
            $last_verified_date = "";
            $api_verify = "";
            $api_division = "";
            $api_endorsements = "";
            $api_reg_type = "";
            $api_reg_status = "";
            $api_notations = "";
            $api_conditions = "";
            $api_expiry = "";
            $api_principal_practice = "";
            $api_other_practices = "";
            
            $other_condition = "";

            
            $graduate_ahpra_number = $request->graduate_ahpra_number;
            $graduate_division = $request->graduate_division;
            $graduate_registration_type = $request->graduate_registration_type;
            $graduate_registration_status = $request->graduate_registration_status;
            if($ahpra_registration_status == "Graduate_RN" || $ahpra_registration_status == "Graduate_RM"){
                $graduate_date = "";
            }else{
                
                $graduate_date = $request->graduation_expected_date;
            }
            $upload_graduation_evidence = $request->upload_graduation_evidence;
            $upload_register_evidence = "";
            $upload_overseas_evidence = "";
            $upload_not_reg_evidence = "";

            $overseas_qualified = "";
            $overseas_other_text = "";
            
            $not_registered = "";
            $education_related = "";
            $returning_practice = "";
            $personal_career = "";
            $not_registered_other = "";

            
        }

        if($ahpra_registration_status == "Overseas"){
            $ahpra_number = "";
            $ahpra_consent = "";
            $division = "";
            $endorsements = "";
            $registration_type = "";
            $registration_status = "";
            $notations = "";
            $other_notation = "";
            $conditions = "";
            $expiry_date = "";
            $principal_place = "";
            $other_places = "";
            $last_verified_date = "";
            $api_verify = "";
            $api_division = "";
            $api_endorsements = "";
            $api_reg_type = "";
            $api_reg_status = "";
            $api_notations = "";
            $api_conditions = "";
            $api_expiry = "";
            $api_principal_practice = "";
            $api_other_practices = "";
            
            $other_condition = "";

            
            $graduate_ahpra_number = "";
            $graduate_division = "";
            $graduate_registration_type = "";
            $graduate_registration_status = "";
            $graduate_date = "";

            $overseas_qualified = json_encode($request->overseas_qualified);
            $overseas_other_text = $request->overseas_other_textreason;
            $upload_overseas_evidence = $request->upload_overseas_evidence;
            $upload_register_evidence = "";
            $upload_graduation_evidence = "";
            $upload_not_reg_evidence = "";

            $not_registered = "";
            $education_related = "";
            $returning_practice = "";
            $personal_career = "";
            $not_registered_other = "";

        }

        if($ahpra_registration_status == "Not_Registered"){
            $ahpra_number = "";
            $ahpra_consent = "";
            $division = "";
            $endorsements = "";
            $registration_type = "";
            $registration_status = "";
            $notations = "";
            $other_notation = "";
            $conditions = "";
            $expiry_date = "";
            $principal_place = "";
            $other_places = "";
            $last_verified_date = "";
            $api_verify = "";
            $api_division = "";
            $api_endorsements = "";
            $api_reg_type = "";
            $api_reg_status = "";
            $api_notations = "";
            $api_conditions = "";
            $api_expiry = "";
            $api_principal_practice = "";
            $api_other_practices = "";
            
            $other_condition = "";

            
            $graduate_ahpra_number = "";
            $graduate_division = "";
            $graduate_registration_type = "";
            $graduate_registration_status = "";
            $graduate_date = "";

            $overseas_qualified = "";
            $overseas_other_text = "";

            $not_registered = json_encode($request->not_registered);
            $education_related = json_encode($request->education_related);
            $returning_practice = json_encode($request->returning_practice);
            $personal_career = json_encode($request->personal_career);
            $not_registered_other = $request->not_registered_other;
            $upload_not_reg_evidence = $request->upload_not_reg_evidence;
            $upload_overseas_evidence = "";
            $upload_register_evidence = "";
            $upload_graduation_evidence = "";
        }

        $ndis_status = $request->ndis_status;
        $upload_ndis_evidence = $request->upload_ndis_evidence;
        

        if($ndis_status == "registered"){
            $ndis_number = $request->ndis_number;
        }

        if($ndis_status == "compliant"){
            $ndis_number = "";
        }

        if($ndis_status == "not_compliant"){
            $ndis_number = "";
        }

        $meadical_provider_toggle = isset($request->meadical_provider_toggle)?1:0;

        if($meadical_provider_toggle == 1){
            $medical_provider_no = $request->medical_provider_no;
            $medical_upload_evidence = $request->medical_upload_evidence;
        }else{
            $medical_provider_no = "";
            $medical_upload_evidence = "";
        }

        $toggleCheckbox_prescribe = isset($request->toggleCheckbox_prescribe)?1:0;

        if($toggleCheckbox_prescribe == 1){
            $pbs_type = $request->pbs_type;
            $pbs_other_nursing = $request->pbs_other_nursing;
            $prescribe_no = $request->prescribe_no;
            $prescribe_evidence = $request->prescribe_evidence;
        }else{
            $pbs_type = "";
            $pbs_other_nursing = "";
            $prescribe_no = "";
            $prescribe_evidence = "";
        }

        $toggleCheckbox_immunization = isset($request->toggleCheckbox_immunization)?1:0;

        if($toggleCheckbox_immunization == 1){
            $immunization_state = json_encode($request->immunization_state);
            $authorizing_body_program = json_encode($request->authorizing_body_program);
            $date_authorised = $request->date_authorised;
            $immuzination_evidence = $request->immuzination_evidence;
            
        }else{
            $immunization_state = "";
            $authorizing_body_program = "";
            $date_authorised = "";
            $immuzination_evidence = "";
            
        }

        $toggleCheckbox_radiation = isset($request->toggleCheckbox_radiation)?1:0;

        if($toggleCheckbox_radiation == 1){
            $radiation_licence_type = json_encode($request->radiation_licence_type);

            $radiation_licence_content = json_encode($request->radiation_licenses_data);
            
            $licenses_type_other = $request->licenses_type_other;
            $radiation_licenses_no = $request->radiation_licenses_no;
            $radiation_state_issue = json_encode($request->radiation_state_issue);
            $radiation_issue_date = $request->radiation_issue_date;
            $radiation_expiry_date = $request->radiation_expiry_date;
            $radiation_evidence = $request->radiation_evidence;
            //print_r($request->radiation_state_data);die;
            $radiation_state_data = json_encode($request->radiation_state_data);
            //print_r($radiation_state_data);
        }else{
            $radiation_licence_type = "";
            $radiation_licence_content = "";
            
        }

        
        $licenses_data = LicensesModel::where("user_id",$user_id)->first();
        //print_r($licenses_data);die;
        if(!empty($licenses_data)){
            
            //$licenses_register = LicensesModel::find($user_id);
            $run = LicensesModel::where('user_id',$user_id)->update([
                'ahpra_registration_status'=>$ahpra_registration_status,
                'aphra_verifying_checkbox'=>$ahpra_consent,
                'aphra_registration_no'=>$ahpra_number,
                'api_verify'=>$api_verify,
                'register_division'=>$division,
                'register_endorsements'=>$endorsements,
                'register_reg_type'=>$registration_type,
                'register_reg_status'=>$registration_status,
                'register_notations'=>$notations,
                'register_conditions'=>$conditions,
                'register_principal_place'=>$principal_place,
                // 'register_other_place'=>$other_places,
                'register_other_notation_reason'=>$other_notation,
                'register_other_condition_reason'=>$other_condition,
                'register_expiry'=>$expiry_date,
                'register_upload_evidence'=>$upload_register_evidence,
                'last_verified'=>$last_verified_date,
                'graduate_student_reg_no'=>$graduate_ahpra_number,
                'graduate_division'=>$graduate_division,
                'graduate_reg_type'=>$graduate_registration_type,
                'graduate_reg_status'=>$graduate_registration_status,
                'graduation_date'=>$graduate_date,
                'graduation_upload_evidence'=>$upload_graduation_evidence,
                'overseas_qualified_specify'=>$overseas_qualified,
                'other_overseas_qualified'=>$overseas_other_text,
                'overseas_upload_evidence'=>$upload_overseas_evidence,
                'not_currently_registered_reason'=>$not_registered,
                'education_related_reason'=>$education_related,
                'returning_practice'=>$returning_practice,
                'personal_career'=>$personal_career,
                'other_not_registered_reason'=>$not_registered_other,
                'not_registered_evidence_file'=>$upload_not_reg_evidence,
                'ndis_status'=>$ndis_status,
                'ndis_registration_no'=>$ndis_number,
                'ndis_registration_evidence'=>$upload_ndis_evidence,
                'medical_provider_no'=>$medical_provider_no,
                'medical_upload_evidence'=>$medical_upload_evidence,
                'pbs_type'=>$pbs_type,
                'pbs_other_nursing'=>$pbs_other_nursing,
                'prescribe_no'=>$prescribe_no,
                'prescribe_evidence'=>$prescribe_evidence,
                'immunization_state'=>$immunization_state,
                'authorizing_body_program'=>$authorizing_body_program,
                'date_authorised'=>$date_authorised,
                'immuzination_evidence'=>$immuzination_evidence,
                'radiation_licence_type'=>$radiation_licence_type,
                'licenses_type_other'=>$licenses_type_other,
                'radiation_licenses_no'=>$radiation_licence_content,
                'radiation_state_data'=>$radiation_state_data
            ]);
            

        }else{
            $user_stage = update_user_stage($user_id,"Registrations and Licences");
            $licenses_register = new LicensesModel();
            $licenses_register->user_id = $user_id;
            $licenses_register->ahpra_registration_status = $ahpra_registration_status;
            $licenses_register->aphra_verifying_checkbox = $ahpra_consent;
            $licenses_register->aphra_registration_no = $ahpra_number;
            $licenses_register->api_verify = $api_verify;
            $licenses_register->register_division = $division;
            $licenses_register->register_endorsements = $endorsements;
            $licenses_register->register_reg_type = $registration_type;
            $licenses_register->register_reg_status = $registration_status;
            $licenses_register->register_notations = $notations;
            $licenses_register->register_conditions = $conditions;
            $licenses_register->register_principal_place = $principal_place;
            //$licenses_register->register_other_place = $other_places;
            $licenses_register->register_other_notation_reason = $other_notation;
            $licenses_register->register_other_condition_reason = $other_condition;
            $licenses_register->register_expiry = $expiry_date;
            $licenses_register->register_upload_evidence = $upload_register_evidence;
            $licenses_register->last_verified = $last_verified_date;
            $licenses_register->graduate_student_reg_no = $graduate_ahpra_number;
            $licenses_register->graduate_division = $graduate_division;
            $licenses_register->graduate_reg_type = $graduate_registration_type;
            $licenses_register->graduate_reg_status = $graduate_registration_status;
            $licenses_register->graduation_date = $graduate_date;
            $licenses_register->graduation_upload_evidence = $upload_graduation_evidence;
            $licenses_register->overseas_qualified_specify = $overseas_qualified;
            $licenses_register->other_overseas_qualified = $overseas_other_text;
            $licenses_register->overseas_upload_evidence = $upload_overseas_evidence;
            $licenses_register->not_currently_registered_reason = $not_registered;
            $licenses_register->education_related_reason = $education_related;
            $licenses_register->returning_practice = $returning_practice;
            $licenses_register->personal_career = $personal_career;
            $licenses_register->other_not_registered_reason = $not_registered_other;
            $licenses_register->not_registered_evidence_file = $upload_not_reg_evidence;
            $licenses_register->ndis_status = $ndis_status;
            $licenses_register->ndis_registration_no = $ndis_number;
            $licenses_register->ndis_registration_evidence = $upload_ndis_evidence;
            $licenses_register->medical_provider_no = $medical_provider_no;
            $licenses_register->medical_upload_evidence = $medical_upload_evidence;
            $licenses_register->pbs_type = $pbs_type;
            $licenses_register->pbs_other_nursing = $pbs_other_nursing;
            $licenses_register->prescribe_no = $prescribe_no;
            $licenses_register->prescribe_evidence = $prescribe_evidence;
            $licenses_register->immunization_state = $immunization_state;
            $licenses_register->authorizing_body_program = $authorizing_body_program;
            $licenses_register->date_authorised = $date_authorised;
            $licenses_register->immuzination_evidence = $immuzination_evidence;
            $licenses_register->radiation_licence_type = $radiation_licence_type;
            //$licenses_register->licenses_type_other = $licenses_type_other;
            $licenses_register->radiation_licenses_no = $radiation_licence_content;
            $licenses_register->radiation_state_data = $radiation_state_data;
            $run = $licenses_register->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);

        
    }

    public function uploadLicensesEvidenceImgs(Request $request){

        $img_field = $request->img_field;
        $evidence_name = $request->evidence_name;
        
        //print_r($files);die;
        $user_id = $request->user_id;

        

        $getLicensesdata = LicensesModel::where("user_id", $user_id)->first();
        
        //print_r($getLicensesdata);die;

        if(!empty($getLicensesdata)){
            $getLicensesdatas = $getLicensesdata->toArray();
        }else{
            $getLicensesdatas = "";
        }

        if(!empty($getLicensesdatas) && $getLicensesdatas[$evidence_name] != NULL){
            $ev_img = (array)json_decode($getLicensesdatas[$evidence_name]);
            
            if($evidence_name == "authorizing_body_program" || $evidence_name == "radiation_state_data"){
                $files = $request->file($evidence_name);
                
                //print_r($files);die;
                // $immunization_data = (array)json_decode($getLicensesdata->authorizing_body_program);
                $group_name_arr = explode("-",$img_field); 
                //print_r($group_name_arr);
                if (array_key_exists($group_name_arr[1], $ev_img)) {
                    
                    foreach($ev_img as $index=>$imdata){
                        //echo $index."=".$group_name_arr[1];
                        if($index == $group_name_arr[1]){
                            $ev_img_author = json_decode($imdata->evidence);
                            
                            $licensesimgs = Helpers::multipleFileUpload($files[$img_field], $ev_img_author);
                            $ev_img[$index]->evidence = $licensesimgs;
                            
                            $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
                        }
                        
                        
                    }
                }else{
                    
                    $licensesimgs = Helpers::multipleFileUpload($files[$img_field], '');
                    // $ev_img[$group_name_arr[1]]->evidence = $licensesimgs;
                    // $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
                }
                
            }else{
                $files = $request->file($evidence_name);
                $licensesimgs = Helpers::multipleFileUpload($files, $ev_img);
                $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => $licensesimgs]);
            }
            
        }else{
            $files = $request->file($evidence_name);

            if($evidence_name == "authorizing_body_program" || $evidence_name == "radiation_licenses_no"){
                $licensesimgs = Helpers::multipleFileUpload($files[$img_field], '');
                $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => $licensesimgs]);
            }else{
                $licensesimgs = Helpers::multipleFileUpload($files, '');
                $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => $licensesimgs]);
            }
            
            
        }

        

        //
        return $licensesimgs;
    }

    public function deleteLicensesEvidenceImg(Request $request)
    {
        $img_field = $request->img_field;
        $evidence_name = $request->evidence_name;
        $user_id = $request->user_id;
        
        $img = $request->img;

        $getLicensesdata = LicensesModel::where("user_id", $user_id)->first();

        if(!empty($getLicensesdata)){
            $getLicensesdatas = $getLicensesdata->toArray();
        }else{
            $getLicensesdatas = "";
        }

        if(!empty($getLicensesdatas) && $getLicensesdatas[$evidence_name] != NULL){
            $ev_img = (array)json_decode($getLicensesdatas[$evidence_name]);

            if($evidence_name == "authorizing_body_program" || $evidence_name == "radiation_state_data"){
                $group_name_arr = explode("-",$img_field); 
                foreach($ev_img as $index=>$imdata){
                    
                    if($index == $group_name_arr[1]){
                        $ev_img_author = json_decode($imdata->evidence);

                        $img_index = array_search($img, $ev_img_author);

                        array_splice($ev_img_author, $img_index, 1);
                        //print_r($ev_img_author);
                        
                        $ev_img[$index]->evidence = json_encode($ev_img_author);
                        
                        //print_r(json_encode($ev_img));
                        $deleteData = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
                    }else{
                        $deleteData = 1;
                    }
                    
                    
                }
            }else{
                $img_index = array_search($img, $ev_img);

                array_splice($ev_img, $img_index, 1);

                $deleteData = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
            
                
            }

            $destinationPath = public_path() . '/uploads/education_degree/' . $img;

            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }
        }else{
            $deleteData = 1;
        }

        if ($deleteData) {
            return 1;
        }

    }    


}

