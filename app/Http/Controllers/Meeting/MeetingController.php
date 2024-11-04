<?php

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\PRMeeting;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;


class MeetingController extends Controller
{
    public function create()
    {
        $months = [];
        for ($i = 0; $i < 4; $i++) {
            $months[] = Carbon::now()->subMonths($i)->format('F Y');
        }
        return view("DPO/Meeting/create",compact('months'));
    }

    public function addMeeting(Request $request)
    {
        $district=Auth::user()->district;
        $request->validate([
            'meeting_month'=>'required|string',
            'meeting_convened'=>'required|string',
            'meeting_date' => 'nullable|required_if:meeting_convened,Yes|date',
            'subject' => 'nullable|required_if:meeting_convened,Yes|string',
            'filename' => 'nullable|required_if:meeting_convened,Yes|file|mimes:pdf|max:1024',
        ]);
        $filename=null;
        if($request->hasFile('filename'))
        {
            $file=$request->file('filename');
            $extension=$file->getClientOriginalExtension();
            $filename=$district.'_'.time().'.'.$extension;
            $proceedingPath=$request->file('filename')->storeAs('private/dpo',$filename);
        }
        PRMeeting::create([
            'district'=>$district,
            'meeting_month'=>$request->meeting_month,
            'meeting_convened'=> $request->meeting_convened,
            'meeting_date'=>$request->meeting_date,
            'subject'=>$request->subject,
            'filename'=>$filename,
            'user_id'=>Auth::user()->id,
        ]);

        return redirect('dpo/view-meeting')->with('success','Meeting added Successfully');
    }

    public function viewMeeting()
    {
        $district=Auth::user()->district;
        $meeting=PRMeeting::where('district',$district)->get();
        return view('DPO/Meeting/manage',compact('meeting'));
    }

    public function checkMeeting(Request $request)
    {
        $district=Auth::user()->district;
        $month=$request->input('month');
        $meetingExists=PRMeeting::where('district',$district)->where('meeting_month',$month)->exists();
        
        return response()->json(['exists' =>$meetingExists]);
    }

    public function sendOTP($meetingId)
    {
        $meeting=PRMeeting::findOrFail($meetingId);
        $otp=rand(10000,99999);
        $meeting->otp=$otp;
        $meeting->otp_expiration_at=now()->addMinutes(5);
        $meeting->save();
        $otpResponse=tryOtp($meeting->user->phone);
        if($otpResponse)
        {
            return redirect()->route('verify',$meeting->id)->with('message','OTP sent successfully!');
        }
        else
        {

        }
        // $twilio=new Client(env('TWILIO_SID'),env('TWILIO_AUTH_TOKEN'));
        // $twilio->messages->create($meeting->user->phone,
        //     [
        //         'from'=>env('TWILIO_FROM'),
        //         'body'=>"Your OTP code for meeting verification is:$otp"
        //      ]);
        // return redirect()->route('verify',$meeting->id)->with('message','OTP sent successfully!');
    }

    public function showVerifyPage($meetingId)
    {
        $meeting=PRMeeting::findOrFail($meetingId);
        return view('verify',compact('meeting'));
    }

    public function tryOtp($number)
    {
        $apikey=env('2FACTOR_API_KEY');
        $url = "https://2factor.in/api/v1/RequestOTP/$number";
        $response=Http::withHeaders([
             "Content-Type" => "application/json",
            "Authorization" => "Bearer $apikey"
        ])->get($url);

        if($response->successful())
        {
            return $response->json();
        }
        else
        {
            return "Can not send the otp"; // or throw an exception
        }
    }
}
