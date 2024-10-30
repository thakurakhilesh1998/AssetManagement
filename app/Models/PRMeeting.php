<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PRMeeting extends Model
{
    use HasFactory;
    protected $fillable = ['district','meeting_month','meeting_convened','meeting_date','subject','filename','otp','otp_expiration_at','isVerified'];
    protected $table="prmeetings";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}