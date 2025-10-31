<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award_recognition extends Model
{
    use HasFactory;
    protected $table = 'awards_recognition_submission';
    protected $guarded =[];
}
