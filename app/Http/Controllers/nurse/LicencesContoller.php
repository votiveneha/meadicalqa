<?php

namespace App\Http\Controllers\nurse;
use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\LicensesModel;
use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Helpers;
use Mail;
use Validator;
use DB;
use URL;
use Session;
use File;

class LicencesContoller extends Controller{

    public function registration_licences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['licenses_data'] = LicensesModel::where("user_id",$user_id)->first();
        return view ("nurse.registration_licences")->with($data);
    }

    public function ahepra_lookup(Request $request)
    {
        $ahpraNumber = $request->ahpraNumber;
        $queryUrl = 'https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx?' . http_build_query([
                'RegistrationNumber' => $ahpraNumber
            ]);

        $response = Http::get($queryUrl);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to contact AHPRA register.'], 500);
        }

        $html = $response->body();

        // Check if "no records found"
        if (stripos($html, 'No records found') !== false) {
            return response()->json(['error' => 'No practitioner found with this AHPRA number.'], 404);
        }

        // Load HTML and parse
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

        return response()->json($result);
    }

    public function update_registration_licenses(Request $request){
        $ahpra_registration_status = $request->ahpra_registration_status;
        $user_id = $request->user_id;

        if($ahpra_registration_status == "RN" || $ahpra_registration_status == "RM" || $ahpra_registration_status == "RN_RM" || $ahpra_registration_status == "NP"){
            $ahpra_number = $request->ahpra_number;
            $ahpra_consent = isset($request->ahpra_consent)?1:0;
            $division = $request->division;
            $endorsements = $request->endorsements;
            $registration_type = $request->reg_registration_type;
            $registration_status = $request->reg_registration_status;
            $notations = json_encode($request->notations);
            $other_notation = $request->other_notation;
            $conditions = json_encode($request->conditions);
            $expiry_date = $request->expiry_date;
            $principal_place = $request->principal_place;
            $other_places = json_encode($request->other_places);
            //$upload_register_evidence = $request->upload_register_evidence;

            
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

            
            $graduate_ahpra_number = $request->graduate_ahpra_number;
            $graduate_division = $request->graduate_division;
            $graduate_registration_type = $request->graduate_registration_type;
            $graduate_registration_status = $request->graduate_registration_status;
            if($ahpra_registration_status == "Graduate_RN" || $ahpra_registration_status == "Graduate_RM"){
                $graduate_date = $request->graduation_expected_date;
            }else{
                $graduate_date = "";
            }
            //$upload_register_evidence = $request->upload_register_evidence;

            
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

            
            $graduate_ahpra_number = "";
            $graduate_division = "";
            $graduate_registration_type = "";
            $graduate_registration_status = "";
            $graduate_date = "";

            $overseas_qualified = json_encode($request->overseas_qualified);
            $overseas_other_text = $request->overseas_other_textreason;
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
        }

        $licenses_data = LicensesModel::where("user_id",$user_id)->first();
        //print_r($licenses_data);die;
        if(!empty($licenses_data)){

            //$licenses_register = LicensesModel::find($user_id);
            $run = LicensesModel::where('user_id',$user_id)->update([
                'ahpra_registration_status'=>$ahpra_registration_status,
                'aphra_verifying_checkbox'=>$ahpra_consent,
                'aphra_registration_no'=>$ahpra_number,
                'register_division'=>$division,
                'register_endorsements'=>$endorsements,
                'register_reg_type'=>$registration_type,
                'register_reg_status'=>$registration_status,
                'register_notations'=>$notations,
                'register_conditions'=>$conditions,
                'register_principal_place'=>$principal_place,
                'register_other_place'=>$other_places,
                'register_other_notation_reason'=>$other_notation,
                'register_expiry'=>$expiry_date,
                'graduate_student_reg_no'=>$graduate_ahpra_number,
                'graduate_division'=>$graduate_division,
                'graduate_reg_type'=>$graduate_registration_type,
                'graduate_reg_status'=>$graduate_registration_status,
                'graduation_date'=>$graduate_date,
                'overseas_qualified_specify'=>$overseas_qualified,
                'other_overseas_qualified'=>$overseas_other_text,
                'not_currently_registered_reason'=>$not_registered,
                'education_related_reason'=>$education_related,
                'returning_practice'=>$returning_practice,
                'personal_career'=>$personal_career,
                'other_not_registered_reason'=>$not_registered_other,
            ]);
            

        }else{
            
            $licenses_register = new LicensesModel();
            $licenses_register->user_id = $user_id;
            $licenses_register->ahpra_registration_status = $ahpra_registration_status;
            $licenses_register->aphra_verifying_checkbox = $ahpra_consent;
            $licenses_register->aphra_registration_no = $ahpra_number;
            
            $licenses_register->register_division = $division;
            $licenses_register->register_endorsements = $endorsements;
            $licenses_register->register_reg_type = $registration_type;
            $licenses_register->register_reg_status = $registration_status;
            $licenses_register->register_notations = $notations;
            $licenses_register->register_conditions = $conditions;
            $licenses_register->register_principal_place = $principal_place;
            $licenses_register->register_other_place = $other_places;
            $licenses_register->register_other_notation_reason = $other_notation;
            $licenses_register->register_expiry = $expiry_date;
            //$licenses_register->register_upload_evidence = $user_id;
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
        $files = $request->file("register_upload_evi");
        //print_r($files);
        $user_id = $request->user_id;

        $getLicensesdata = LicensesModel::where("user_id", $user_id)->first();

        if(!empty($getLicensesdata) && $getLicensesdata->register_upload_evidence != NULL){
            $ev_img = (array)json_decode($getLicensesdata->register_upload_evidence);
            
            $licensesimgs = Helpers::multipleFileUpload($files, $ev_img);
        }else{
            $licensesimgs = Helpers::multipleFileUpload($files, '');
        }

        

        $run = LicensesModel::where('user_id', $user_id)->update(["register_upload_evidence" => $licensesimgs]);
        return $licensesimgs;
    }

    public function deleteLicensesEvidenceImg(Request $request)
    {
        $img_field = $request->img_field;
        $user_id = $request->user_id;
        
        $img = $request->img;

        $getLicensesdata = LicensesModel::where("user_id", $user_id)->first();

        if(!empty($getLicensesdata) && $getLicensesdata->register_upload_evidence != NULL){
            $ev_img = (array)json_decode($getLicensesdata->register_upload_evidence);

            $img_index = array_search($img, $ev_img);

            array_splice($ev_img, $img_index, 1);

            $deleteData = LicensesModel::where('user_id', $user_id)->update(["register_upload_evidence" => json_encode($ev_img)]);
        
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

