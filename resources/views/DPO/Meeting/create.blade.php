@extends('layouts/dpo')
@section('main')
<div class="container-fluid">
    <div class="container text-black">
        <div class="h3 mb-3 text-gray-800">
            <h3>Add Meeting</h3>
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
            @endif
        </div>
    </div>  
    <div class="card p-3">
       <form action="" method="POST" action="dpo/add-meeting" id="addMeeting" name="addMeeting"  enctype="multipart/form-data">
            @csrf
            {{-- Month of Meeting --}}
            <div class="mb-3">
                <label for="Month of Meeting" class="form-label">Select Month of Meeting<span class="text-danger">*</span></label>
                <select name="month" id="monthr" class="form-control">
                  <option value="-1">--Select Month of Meeting--</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                </select>
            </div>
            {{-- Whether Meeting held --}}
            <div class="mb-3">
                <label for="Meeting convened" class="form-label">Whether meeting convened for this month?<span class="text-danger">*</span></label>
                <select name="meeting_convened" id="meeting_convened" class="form-control">
                  <option value="-1">--Select if meeting is convened--</option>
                  <option value="September">Yes</option>
                  <option value="October">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Date of Meeting" class="form-label">Date of Meeting<span class="text-danger">*</span></label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="Subject of meeting" class="form-label">Subject of Meeting<span class="text-danger">*</span></label>
                <input type="text" name="subject" id="subject" class="form-control">
            </div>
            <div class="mb-3">
                <label for="proceedings">Proceedings of the meeting<span class="text-danger">*</span></label>
                <input type="file" accept="pdf" name="proceedings" class="form-control">
            </div>
            <div class="mb-3">
                <input type="submit" value="Add Meeting" name="add" id="add" class="form-control btn btn-primary">
            </div>
       </form>
    </div>
</div>
@endsection
