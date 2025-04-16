<?php
use Carbon\Carbon;

use App\Models\SpecialityModel;
use App\Models\PractitionerTypeModel;
use App\Models\CountryModel;
use App\Models\User;
use App\Models\StateModel;
use App\Models\LevelYearModel;
use App\Models\EvidenceModel;
use App\Models\EligibilityToWorkModel;
use App\Models\ProfessionModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\DegreeModel;
use App\Models\EmergencyContactModel;
use App\Models\ProfessionalCer;
use App\Models\TrainingModel;
use App\Models\SkillModel;
use App\Models\VaccinationModel;

function specialty()
{
        $specialty_data =  SpecialityModel::where('parent', '0')->orderBy('nurse_level_order', 'asc')->get();
        return $specialty_data;
}
function specialty_name_by_id($specialty)
{
        $specialty_data =  SpecialityModel::where('id', $specialty)->orderBy('id', 'desc')->first();
        return $specialty_data->name;
}
function specialty_name_by_id_NEW($specialty)
{
        $specialty_data =  SpecialityModel::where('id', $specialty)->orderBy('id', 'desc')->first();
        return $specialty_data->name;
}
function sub_specialty($specialty_id)
{
        $specialty_data =  SpecialityModel::where('parent', $specialty_id)->orderBy('id', 'desc')->get();
        return $specialty_data;
}

function JobSpecialties()
{
        $JobSpecialties =  PractitionerTypeModel::where('status', '1')->where('parent','0')->orderBy('id', 'asc')->get();
        return $JobSpecialties;
}
function SubJobSpecialties()
{
        $SubJobSpecialties =  PractitionerTypeModel::where('status', '1')->where('parent','!=','0')->orderBy('id', 'desc')->get();
        return $SubJobSpecialties;
}
function practitioner_type()
{
        $practitioner_type_data =  PractitionerTypeModel::where('status', '1')->orderBy('id', 'desc')->get();
        return $practitioner_type_data;
}
function nurse_midwife_degree()
{
        $nurse_midwife_degree =  DegreeModel::where('status', '1')->orderBy('id', 'desc')->get();
        return $nurse_midwife_degree;
}
function nurse_midwife_degree_by_id($id)
{
        $nurse_midwife_degree =  DegreeModel::where('status', '1')->where('id', $id)->first();
        return $nurse_midwife_degree->name;
}
function practitioner_type_by_id($practitioner)
{
        $practitioner_type_data =  PractitionerTypeModel::where('id', $practitioner)->orderBy('id', 'desc')->first();
        return $practitioner_type_data->name;
}
function country_phone_code()
{
    $country_phone_code = CountryModel::where('status', '1')->select('phonecode','name')->groupBy('phonecode')->orderBy("phonecode", "asc")->get();
    return $country_phone_code;
}
function country_id($country_phone_code)
{
    $country = CountryModel::where('status', '1')->where('phonecode', $country_phone_code)->first();
    return $country->iso2;
}
function country_name_from_db()
{
        $country_data =  CountryModel::where('status', '1')->get();
        return $country_data;
}
function state_name_array($country_id)
{
        // $lastRecord = StateModel::where('country_id', $country_id)->get();
        $lastRecord = StateModel::where('country_code', $country_id)->get();
        return $lastRecord;
}
function state_name($state_id)
{
        $lastRecord = StateModel::where('id', $state_id)->first();
        return $lastRecord->name;
}
function state_list()
{
        $lastRecord = StateModel::all();
        
        return $lastRecord;
}
function country_name($country_id)
{

        $lastRecord = CountryModel::where('iso2', $country_id)->first();
        return $lastRecord->name;
}
function country_name_new($country_id)
{

        $lastRecord = CountryModel::where('id', $country_id)->first();
        return $lastRecord->name;
}
function year_level()
{
        $lastRecord = LevelYearModel::where('status','1')->get();
        return $lastRecord;
}
function evidence_list()
{
        $lastRecord = EvidenceModel::where('status','1')->get();
        return $lastRecord;
}
function profession_data()
{
        $lastRecord = ProfessionModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function emergency_contact_data()
{
        $lastRecord = EmergencyContactModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function clearances_data()
{
        $lastRecord = EligibilityToWorkModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function working_data()
{
        $lastRecord = WorkingChildrenCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function police_check_data()
{
        $lastRecord = PoliceCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}

function getUserDataById($id)
{
        $lastRecord = User::where('id',$id)->first();
        return $lastRecord;
}

function getLevelYearNameById($id)
{
        $lastRecord = LevelYearModel::where('id',$id)->first();
        return $lastRecord->name;
}
function getEvidenceTypeNameById($id)
{
        $lastRecord = EvidenceModel::where('id',$id)->first();
        return $lastRecord->name;
}

function practitioner_type_header()
{
        $practitioner_type_data =  PractitionerTypeModel::where('parent', '0')->orderBy('id', 'desc')->get();
        return $practitioner_type_data;
}
function nurse_Type_header()
{
        $practitioner_type_data =  SpecialityModel::where('parent', '0')->orderBy('id', 'desc')->get();
        return $practitioner_type_data;
}
function email_verified()
{
       
        if(Auth::guard('nurse_middle')->user()->user_stage=='0'){
                return false;
        }else{
                return true;
        }
}
function account_verified()
{
        if(Auth::guard('nurse_middle')->user()->user_stage=='1'){
                return false;
        }else{
                return true;
        }
}

function update_user_stage($user_id)
{
     $user_data = User::where("id",$user_id)->first();   
     //print_r($user_data);
     if(!empty($user_data) && $user_data->user_stage == 1){
        DB::table("users")->where("id",$user_id)->update(["user_stage"=>"5"]); 

        // $to = "votivephp.neha@gmail.com";

        // $mailData = [

        //         'subject' => 'In-progress Nurse Profile',

        //         'email' => $to,


        //         'body' => '<p>Hello  ' . $request->fullname . ' ' . $request->lastname . ', </p><p>Welcome and thank you for registering.</p>  <p>Click the link below to verify your account. </p><p><a href="' . $verificationUrl . '">Verify Now</a></p><p>If the above link doesn\'t work, copy and paste the link below into your browser.</p><p>' . $verificationUrl . '</p>',


        // ];

        // $randnum = rand(1111111111, 9999999999);
        // Mail::to($to)->send(new \App\Mail\DemoMail($mailData));
     }   
       
}

function getUserNameById($id)
{
        $lastRecord = User::where('id',$id)->first();
        if($lastRecord){
                return $lastRecord->name . ' ' . $lastRecord->lastname;
        }
        
}
function professional_certificate_by_id($id)
{
        $certificate =  ProfessionalCer::where('id', $id)->first();
        return $certificate->name;
}
function training_name_by_id($specialty)
{
        $training_data =  TrainingModel::where('id', $specialty)->first();
        return $training_data->name;
}
function skill_name_by_id($id)
{
        $skill_data =  SkillModel::where('id', $id)->first();
        return $skill_data->name;
}
function vaccination_name_by_id($id)
{
        $vaccination_data =  VaccinationModel::where('id', $id)->first();
        return $vaccination_data->name;
}


