@extends('layouts/admin')
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card">
        <div class="card-header">
            <h3>View Rural Development Data</h3>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered text-center align-middle table-striped" id="datatable">
            <thead>
                <th class='align-middle'>Sr. No.</th>
                <th class='align-middle'>District Name</th>
                <th class='align-middle'>Block Name</th>
                <th class='align-middle'>Gram Panchayat Name</th>
                <th class='align-middle'>Is the Asset Under Municipal Area? If yes, name of Municipal Area</th>
                <th class='align-middle'>Name of Property/Description of Property</th>
                <th class='align-middle'>Owner of Building</th>
                <th class='align-middle'>Type of Building</th>
                <th class='align-middle'>Urban/Rural Area</th>
                <th class='align-middle'>Current Use of Building</th>
                <th class='align-middle'>If Current Use of Building <b>On Rent(Rent Amount)</b></th>
                <th class='align-middle'>If Current Use of Building <b>On Rent(Rent Deposited In)</b></th>
                <th class='align-middle'>Current Use of Building(If other please specify Here)</th>
                <th class='align-middle'>Whether located along the National Highway?</th>
                <th class='align-middle'>Area of Land(in square meter)</th>
                <th class='align-middle'>Area of Building(in squre meter)</th>
                <th class='align-middle'>GPS Coordinates</th>
                <th class='align-middle'>Current Rental Income(in Rs.)</th>
                <th class='align-middle'>Description of Legal Dispute(if any)</th>
                <th class='align-middle'>Possibilty of Income</th>
                <th class='align-middle'>Jamabandi Copy</th>
                <th class='align-middle'>High Quality Picture</th>
            </thead>
            <?php
                $i=0;
             ?>
            <tbody>
                @foreach ($rddata as $data)
                <?php $i++;?>
                    <tr>
                        <td class='align-middle'>{{$i}}</td>
                        <td class='align-middle'>{{$data->district}}</td>
                        <td class='align-middle'>{{$data->blocklist}}</td>
                        <td class='align-middle'>{{$data->gp}}</td>
                        <td class='align-middle'>{{$data->muncipal_area}}</td>
                        <td class='align-middle'>{{$data->nameofproperty}}</td>
                        <td class='align-middle'>{{$data->owner}}</td>
                        <td class='align-middle'>{{$data->type}}</td>
                        <td class='align-middle'>{{$data->area_type}}</td>
                        <td class='align-middle'>{{$data->use_of_building}}</td>
                        <td class='align-middle'>{{$data->rent_income}}</td>
                        <td class='align-middle'>{{$data->rent_deposited}}</td>
                        <td class='align-middle'>{{$data->otheruse}}</td>
                        <td class='align-middle'>{{$data->along_highway}}</td>
                        <td class='align-middle'>{{$data->area_land}}</td>
                        <td class='align-middle'>{{$data->areaofbuilding}}</td>
                        <td class='align-middle'>{{$data->gps}}</td>
                        <td class='align-middle'>{{$data->current_income}}</td>
                        <td class='align-middle'>{{$data->legal_dispute}}</td>
                        <td class='align-middle'>{{$data->possibility_income	}}</td>
                        <td class='align-middle'><a href="{{asset('uploads/pos/jamabandi').'/'.$data->jamabandi}}" target="_blank">View</a></td>
                        <td class='align-middle'><a href="{{asset('uploads/pos/picture').'/'.$data->picture}}" target="_blank">View</a></td>
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
