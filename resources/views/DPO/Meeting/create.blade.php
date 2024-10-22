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
                <label for="Month of Meeting" class="form-label">Select Month of Meeting<span class="text-danger">*</span></label>
                <select name="month" id="monthr" class="form-control">
                  <option value="-1">--Select Month of Meeting--</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                </select>
            </div>
       </form>
    </div>
</div>
@endsection
