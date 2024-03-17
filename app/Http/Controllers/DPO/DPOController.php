<?php

namespace App\Http\Controllers\DPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DPO\AssetDataRequests;
use App\Models\PRAsset;
use Illuminate\Support\Facades\File;


class DPOController extends Controller
{
    public function addAasset()
    {
        $district=Auth::user()->district;
        return view('DPO.add-asset',compact('district'));
    }

    public function createAsset(AssetDataRequests $data1)
    {
        try
        {
            $data=$data1->validated();
            $prasset=new PRAsset;
            $district=Auth::user()->district;
            $prasset->district=$district;
            $prasset->blocklist=$data['blocklist'];
            $prasset->gp=$data['gp'];
            $prasset->muncipal_area=$data['muncipal_area'];
            $prasset->nameofproperty=$data['nameofproperty'];
            $prasset->owner=$data['owner'];
            $prasset->type=$data['type'];
            $prasset->area_type=$data['area_type'];
            $prasset->use_of_building=$data['use_of_building'];
            $prasset->otheruse=$data['otheruse'];
            $prasset->along_highway=$data['along_highway'];
            $prasset->area_land=$data['area_land'];
            $prasset->areaofbuilding=$data['areaofbuilding'];
            $prasset->gps=$data['gps'];
            $prasset->current_income=$data['current_income'];
            $prasset->legal_dispute=$data['legal_dispute'];

            // Upload PDF file

            if($data1->hasFile('jamabandi'))
            {
                $file=$data1->file('jamabandi');
                $filename=$district.time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/dpo/jamabandi',$filename);
                $prasset->jamabandi=$filename;
            }

            // Upload Image file

            if($data1->hasFile('picture'))
            {
                $file=$data1->file('picture');
                $filename=$district.time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/dpo/picture',$filename);
                $prasset->picture=$filename;
            }
            $prasset->possibility_income=$data['possibility_income'];
            $prasset->save();
            return redirect(url('dpo/view-asset'))->with(["message"=>"Asset Added Successfully!"]);

        }
        catch(\Exceptionn $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function viewAsset()
    {
        echo "DPO Asset Added successfully";
    }
}
