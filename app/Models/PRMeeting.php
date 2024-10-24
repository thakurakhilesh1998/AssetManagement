<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PRMeeting extends Model
{
    use HasFactory;
    protected $fillable = ['district','meeting_month','meeting_convened','meeting_date','subject','filename'];
    protected $table="prmeetings";
}
