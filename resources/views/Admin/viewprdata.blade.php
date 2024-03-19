@extends('layouts/admin')
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card">
        <div class="card-header">
            <h3>View Panchayati Raj Data</h3>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered text-center" id="datatable">
            <thead>
                <th>District Name</th>
                <th>Block Name</th>
                <th>Gram Panchayat Name</th>
                <th>Is the Asset Under Municipal Area? If yes, name of Municipal Area</th>
                <th>Name of Property/Description of Property</th>
                <th>Owner of Building</th>
                <th>Type of Building</th>
                <th>Urban/Rural Area</th>
                <th>Current Use of Building</th>
                <th>Current Use of Building(If other please specify Here)</th>
                <th>Whether located along the National Highway?</th>
                <th>Area of Land(in square meter)</th>
                <th>Area of Building(in squre meter)</th>
                <th>GPS Coordinates</th>
                <th>Current Rental Income(in Rs.)</th>
                <th>Description of Legal Dispute(if any)</th>
                <th>Possibilty of Income</th>
                <th>Jamabandi Copy</th>
                <th>High Quality Picture</th>
            </thead>
            <tbody>
                @foreach ($prasset as $data)
                    <tr>
                        <td>{{$data->district}}</td>
                        <td>{{$data->blocklist}}</td>
                        <td>{{$data->gp}}</td>
                        <td>{{$data->muncipal_area}}</td>
                        <td>{{$data->nameofproperty}}</td>
                        <td>{{$data->owner}}</td>
                        <td>{{$data->type}}</td>
                        <td>{{$data->area_type}}</td>
                        <td>{{$data->use_of_building}}</td>
                        <td>{{$data->otheruse}}</td>
                        <td>{{$data->along_highway}}</td>
                        <td>{{$data->area_land}}</td>
                        <td>{{$data->areaofbuilding}}</td>
                        <td>{{$data->gps}}</td>
                        <td>{{$data->current_income}}</td>
                        <td>{{$data->legal_dispute}}</td>
                        <td>{{$data->possibility_income	}}</td>
                        <td><a href="{{asset('uploads/dpo/jamabandi').'/'.$data->jamabandi}}" target="_blank">View</a></td>
                        <td><a href="{{asset('uploads/dpo/picture').'/'.$data->picture}}" target="_blank">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        
    });
</script>
@endsection
