<?php

namespace App\Http\Controllers\nurse;
use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        return view ("nurse.registration_licences");
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

}

