<?php
namespace App\Helpers;
use App\Models\SpecialityModel;

class MatchHelper
{
    public static function calculateTypeOfNurseAndRole($userNurseType, $jobNurseType)
    {
        $maxScore = 15;
        $score = 0;
        
        // Decode JSON safely
        $userNurseTypes = self::normalizeToArray($userNurseType);
        $jobNurseTypes  = self::normalizeToArray($jobNurseType);
        // $userRoles      = self::normalizeToArray($userSpecialRole);
        // $jobRoles       = self::normalizeToArray($jobSpecialRole);

        // ---- 1️⃣ Exact Nurse Type Match ----
        if (count(array_intersect($userNurseTypes, $jobNurseTypes)) > 0) {
            $score += $maxScore; // full match
        } else {
            // ---- 2️⃣ Partial Nurse Type Match (closely related) ----
            foreach ($userNurseTypes as $userType) {
                foreach ($jobNurseTypes as $jobType) {
                    if (self::isCloselyRelated($userType, $jobType)) {
                        $score += ($maxScore * 0.5); // 50% partial
                    }
                }
            }
        }

        // ---- 3️⃣ Role Specificity Match ----
        // if (count(array_intersect($userRoles, $jobRoles)) > 0) {
        //     $score += 5; // optional additional role-based score
        // } else {
        //     foreach ($userRoles as $userRole) {
        //         foreach ($jobRoles as $jobRole) {
        //             if (self::isCloselyRelated($userRole, $jobRole)) {
        //                 $score += 2.5;
        //             }
        //         }
        //     }
        // }

        // ---- Cap the score at 15 ----
        return min($score, $maxScore);
    }

    private static function normalizeToArray($data)
    {
        // Convert JSON, CSV, or string into array
        if (is_null($data)) return [];
        if (is_array($data)) return $data;

        // If stored as JSON string
        $decoded = json_decode($data, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        // If comma-separated string
        if (is_string($data)) {
            return array_map('trim', explode(',', $data));
        }

        return [];
    }

    private static function isCloselyRelated($a, $b)
    {
        $a = strtolower($a);
        $b = strtolower($b);

        // Fetch all top-level nurse categories (parent = 0)
        $parents = SpecialityModel::where('parent', 0)->get();

        $parentArray = [];
        $relatedPairs = [];

        foreach ($parents as $index => $parent) {
            $parentArray[] = $parent->name;

            $children = SpecialityModel::where('parent', $parent->id)
                ->pluck('name')
                ->toArray();

            // store each child array separately
            $relatedPairs[] = $children;
        }

        // ✅ Debug print
        echo "<pre>";
        print_r($relatedPairs);
        echo "</pre>";
        die();

        // Example of match logic (once working, remove print_r/die)
        foreach ($relatedPairs as $childArray) {
            foreach ($childArray as $child) {
                if ((str_contains($a, strtolower($child)) && in_array($b, array_map('strtolower', $childArray))) ||
                    (str_contains($b, strtolower($child)) && in_array($a, array_map('strtolower', $childArray)))) {
                    return true;
                }
            }
        }

        return false;
    }

}

