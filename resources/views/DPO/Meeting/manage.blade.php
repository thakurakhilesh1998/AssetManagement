@extends('layouts/dpo')
@section('main')
<div class="container-fluid">
    <div class="container text-black">
     
    </div>  
    <div class="card p-3">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
        @endif
        <div class="card-header">
                <h3>View Meeting</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <th>Sr.No.</th>
                    <th>Month Name</th>
                    <th>Whether Meeting Convened?</th>
                    <th>Date of Meeting</th>
                    <th>Proceedings</th>
                    <th>Edit</th>
                    <th>Verify</th>
                </thead>
                <tbody>
                    @foreach($meeting as $index=>$m)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$m->meeting_month}}</td>
                        <td>{{$m->meeting_convened}}</td>
                        <td>{{$m->meeting_date}}</td>

                        <td>
                            @if($m->filename)
                                <a href="{{route('view-proceedings',$m->filename)}}" target="_blank">View File</a>
                            @else
                                No File
                            @endif
                        </td>
                        <td>Edit</td>
                        <td>Verify</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function()
    {   
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

            console.log(month);
            console.log(year);
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

                console.log(firstDayISO,lastDayISO);
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