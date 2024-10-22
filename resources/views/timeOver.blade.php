@extends('layouts.app')
@section('main')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center alert alert-warning">The deadline to enter the Assets on this portal ended on 15-10-2024.</h3>
            <p class="text-center">Please provide the Certificate that Asset Entered on this portal is correct on the email id:<strong> panchayatiraj-hp@gov.in</strong></p>
        </div>
        <div class="my-3">
            <a class="dropdown-item text-center" style="color:blue" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form action="{{route('logout')}}" method="POST" id="logout-form" class="d-none">
                @csrf
            </form> 
        </div>
    </div>
@endsection