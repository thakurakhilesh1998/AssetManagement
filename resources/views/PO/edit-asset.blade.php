@extends('layouts/po')
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="container text-black">
        <h3 class="h3 mb-3 text-gray-800">
          Update  Non Residential Buildings of Department of Rural Development/DRDA
        </h3>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
        @endif
        <div class="card p-3">
        <form method="POST" action="{{url('po/edit-asset')}}" id="addAsset" name="addAsset"  enctype="multipart/form-data">
            @csrf
            <div class="mb-3" id="blocks-block">
            </div>
            <div class="mb-3">
              <label for="gram panchayat" class="form-label">Name of Gram Panchayat (if Building is located in the Gram Panchayat)</label>
              <input type="text" class="form-control" id="gp" name="gp" value="{{$rddata->gp}}">
            </div>
            <div class="mb-3">
                <label for="gram panchayat" class="form-label">Is building located in Municipal Area? (if yes, Please specify name of Municipal area) </label>
                <input type="text" class="form-control" id="muncipal_area" name="muncipal_area" value="{{$rddata->muncipal_area}}">
              </div>
            <div class="mb-3">
                <label for="name of property" class="form-label">Name of Property/Property Description <span class="text-danger">*</span> </label>
                <textarea name="nameofproperty" id="nameofproperty" class="form-control">{{$rddata->nameofproperty}}</textarea>
            </div>
            <div class="mb-3">
                <label for="Owner of Building" class="form-label">Owner of Building <span class="text-danger">*</span></label>
                <select name="owner" id="owner" class="form-control">
                  <option value="-1">--Select Owner of Building--</option>
                  <option value="Department of Rural Development" {{$rddata->owner==='Department of Rural Development'?'selected':''}}>Department of Rural Development</option>
                  <option value="DRDA" {{$rddata->owner==='DRDA'?'selected':''}}>DRDA</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Owner of Building" class="form-label">Type of Building <span class="text-danger">*</span></label>
                <select name="type" id="type" class="form-control">
                  <option value="-1">--Select Type of Building--</option>
                  <option value="Official" {{$rddata->type==='Official'?'selected':''}}>Official</option>
                  <option value="Shops/Commercial" {{$rddata->type==='Shops/Commercial'?'selected':''}}>Shops/Commercial</option>
                  <option value="Project Related Building" {{$rddata->type==='Project Related Building'?'selected':''}}>Project Related Building</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="areatype" class="form-label">Urban/Rural Area <span class="text-danger">*</span></label>
                <select name="area_type" id="area_type" class="form-control">
                  <option value="-1">--Select Type of Area--</option>
                  <option value="Rural" {{$rddata->area_type==='Rural'?'selected':''}}>Rural</option>
                  <option value="Urban" {{$rddata->area_type==='Urban'?'selected':''}}>Urban</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="areatype" class="form-label">Current Use of the Building <span class="text-danger">*</span></label>
                <select name="use_of_building" id="use_of_building" class="form-control">
                  <option value="-1">--Select Use of Building--</option>
                  <option value="Own Use" {{$rddata->use_of_building==='Own Use'?'selected':''}}>Own Use</option>
                  <option value="On Rent" {{$rddata->use_of_building==='On Rent'?'selected':''}}>On Rent</option>
                  <option value="Vacant" {{$rddata->use_of_building==='Vacant'?'selected':''}}>Vacant</option>
                  <option value="Legal Dispute" {{$rddata->use_of_building==='Legal Dispute'?'selected':''}}>Legal Dispute</option>
                  <option value="Other" {{$rddata->use_of_building==='Other'?'selected':''}}>Other</option>
                </select>
            </div>

            <div class="mb-3" id="use_check_other">
                <label for="Current Use if Other" class="form-label">Current Use of Building (if other please specify here)</label>
                <input type="text" class="form-control" id="otheruse" name="otheruse" value="{{$rddata->otheruse}}">
            </div>

            <div class="mb-3">
                <label for="areatype" class="form-label">Whether located along the National Highway?<span class="text-danger"> *</span></label>
                <select name="along_highway" id="along_highway" class="form-control">
                  <option value="-1">--Select--</option>
                  <option value="Yes" {{$rddata->along_highway==='Yes'?'selected':''}}>Yes</option>
                  <option value="No" {{$rddata->along_highway==='No'?'selected':''}}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="Area of Land" class="form-label">Area of Land(in square meter)<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="area_land" name="area_land" value="{{$rddata->area_land}}">
            </div>

            <div class="mb-3">
                <label for="Area of Building" class="form-label">Area of Building ( in square meter)<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="areaofbuilding" name="areaofbuilding" value="{{$rddata->areaofbuilding}}">
            </div>

            <div class="mb-3">
                <label for="GP Coordinates" class="form-label">GPS Coordinates <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="gps" name="gps" value="{{$rddata->gps}}">
            </div>

            <div class="mb-3">
                <label for="Current Rental Income" class="form-label">Current Rental Income(in Rs.)</label>
                <input type="text" class="form-control" id="current_income" name="current_income" value="{{$rddata->current_income}}">
            </div>

            <div class="mb-3">
                <label for="Current Rental Income" class="form-label">Description of Legal Dispute (if any)</label>
                <textarea name="legal_dispute" id="legal_dispute" class="form-control">{{$rddata->legal_dispute}}</textarea>
            </div>

            <div class="mb-3">
                <label for="Jamabandi Copy(only pdf file)" class="form-label">Jamabandi Copy(only pdf file) <span class="text-danger"> *</span></label>
                <input type="file" class="form-control" id="jamabandi" name="jamabandi" accept="application/pdf">
            </div>

            <div class="mb-3">
                <label for="High Quality Picture " class="form-label">High Quality Picture <span class="text-danger"> *</span></label>
                <input type="file" class="form-control" id="picture" name="picture"   accept="image/jpeg, image/jpg, image/png">
            </div>

            <div class="mb-3">
                <label for="Current Rental Income" class="form-label">Possibility of Revenue Generation(specify) <span class="text-danger">*</span></label>
                <textarea name="possibility_income" id="possibility_income" class="form-control">{{$rddata->possibility_income}}</textarea>
            </div>
            

            <button type="submit" class="btn btn-primary">Add Asset</button>
          </form>
   
        </div>
        </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        // Load the block data
        $.getJSON("{{asset('assets/json/districts_and_blocks.json')}}",function(data)
        {
            
            let blocksName=data['{{$district}}'];
            var blockList = '<label for="Block name" class="form-label">Select Block Name</label><select name="blocklist" id="blocklist" class="form-control"><option value="-1">--Select Block--</option>';
            $.each(blocksName, function(index, block) {
                blockList += '<option value="' + block + '">' + block + '</option>';
            });
            blockList += '</select>';
            $('#blocks-block').html(blockList);
            
        });


        $('#use_check_other').hide();
        $('#use_of_building').on("change",function()
        {
            let use_of_building=$(this).val();
            if(use_of_building==='Other')
            {
                $('#use_check_other').show();
            }
            else
            {
                $('#use_check_other').hide();
            }
        });
    });
</script>
<script src="{{asset('assets/js/po_data_validation.js')}}"></script>
@endsection
