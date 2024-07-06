@extends('layouts/admin')
@section('main')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Dashboard</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <th>Sr. No.</th>
                        <th>District Name</th>
                        <th>Panchayati Raj Assets Added</th>
                        <th>Rural Development Assets Added</th>
                    </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach ($districtCount as $district=>$counts)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$district}}</td>
                        <td>{{$counts['PRAsset']}}</td>
                        <td>{{$counts['Rdassets']}}</td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection