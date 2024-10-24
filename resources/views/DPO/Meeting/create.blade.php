@extends('layouts/dpo')
@section('main')
<div class="container-fluid">
    <div class="container text-black">
        <div class="h3 mb-3 text-gray-800">
            <h3>Add Meeting</h3>
          
        </div>
    </div>  
    <div class="card p-3">
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
        @endif
       <form method="POST" action="{{url('dpo/add-meeting')}}" id="addMeeting" name="addMeeting"  enctype="multipart/form-data">
            @csrf
            {{-- Month of Meeting --}}
            <div class="mb-3">
                <label for="Month of Meeting" class="form-label">Select Month of Meeting<span class="text-danger">*</span></label>
                <select name="meeting_month" id="month" class="form-control">
                  <option value="-1">--Select Month of Meeting--</option>
                  @foreach($months as $month)
                        <option value="{{$month}}">{{$month}}</option>  
                  @endforeach
                  
                </select>
            </div>
            <div id="checkMeeting">
            {{-- Whether Meeting held --}}
                <div class="mb-3">
                    <label for="Meeting convened" class="form-label">Whether meeting convened for this month?<span class="text-danger">*</span></label>
                    <select name="meeting_convened" id="meeting_convened" class="form-control">
                    <option value="-1">--Select if meeting is convened--</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    </select>
                </div>
                <div class="mb-3" id="meeting_d">
                    <label for="Date of Meeting" class="form-label">Date of Meeting<span class="text-danger">*</span></label>
                    <input type="date" name="meeting_date" id="meeting_date" class="form-control">
                </div>
                <div class="mb-3" id="meeting_s">
                    <label for="Subject of meeting" class="form-label">Subject of Meeting<span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control">
                </div>
                <div class="mb-3" id="proceedings_f">
                    <label for="proceedings">Proceedings of the meeting<span class="text-danger">*</span></label>
                    <input type="file" accept="application/pdf" name="filename" id='proceedings' class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Add Meeting" name="add" id="add" class="form-control btn btn-primary">
                </div>
            </div>
       </form>
       <div id="already">

       </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function()
    {   
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $('#month').change(function(){
            let selectedMonth=$(this).val();
            if(selectedMonth!=='-1')
            {
                $.ajax(
                    {
                        url:'{{route("meetingexits")}}',
                        method:'POST',
                        data:{
                            _token:token,
                            month:selectedMonth
                        },
                        success:function(response){
                            $('#already').empty();
                            if(response.exists){
                                $('#checkMeeting').hide();
                                $('.alert-danger').remove();
                                $('#already').append('<div class="alert alert-info">Meeting for this month is already added. You can view the meeting details from Manage option.</div>');
                            }
                            else
                            {
                                $('#checkMeeting').show();
                                $('.alert-info').remove();
                            }
                        }
                    }
                )
            }   
        });

        $('#meeting_convened').change(function()
        {
            let value=$(this).val();
            if(value==='Yes')
            {
                $('#meeting_d').show();
                $('#meeting_s').show();
                $('#proceedings_f').show();

            } else if(value==='No')
            {
                $('#meeting_d').hide();
                $('#meeting_s').hide();
                $('#proceedings_f').hide();
            }
        });

        $('#month').change(function() {
        let selectedMonthYear = $(this).val();
        let currentYear = (new Date()).getFullYear();

        // Mapping month names to their respective numbers (0-based index)
        let monthNames = {
            "January": 0, "February": 1, "March": 2, "April": 3, "May": 4, "June": 5,
            "July": 6, "August": 7, "September": 8, "October": 9, "November": 10, "December": 11
        };

        if (selectedMonthYear) {
            let monthYearParts = selectedMonthYear.split(' ');
            let month = monthYearParts[0];
            let year = monthYearParts[1] || currentYear;
            // Find the correct month index from the predefined list
            let monthIndex = monthNames[month];

            if (monthIndex !== undefined) {
                // Correctly calculate the first and last day of the selected month
                let firstDay=new Date(year,monthIndex, 1);
                let lastDay=new Date(year,monthIndex+1,0)

                firstDay.setDate(firstDay.getDate()+1);
                lastDay.setDate(lastDay.getDate()+1);

                let firstDayISO = firstDay.toISOString().split('T')[0]; // Convert to YYYY-MM-DD format
                let lastDayISO = lastDay.toISOString().split('T')[0]; // Convert to YYYY-MM-DD format

                $('#meeting_date').attr('min', firstDayISO);
                $('#meeting_date').attr('max', lastDayISO);
            } else {
                console.error('Invalid month selected');
            }
        }
    });
        $('#meeting_convened').trigger('change');
    });
</script>
<script src="{{asset('assets/js/meeting_validation.js')}}">

</script>
@endsection