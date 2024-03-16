<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PO\AssetDataRequests;
use App\Models\Rdassets;

class POController extends Controller
{
    public function addAsset()
    {
        $district=Auth::user()->district;
        return view('PO.add-asset',compact('district'));
    }

    public function createAsset(AssetDataRequests $data1)
    {
        try
        {
            $data=$data1->validated();
            $rdasset=new Rdassets;
            $rdasset->district=Auth::user()->district;
            $rdasset->blocklist=$data['blocklist'];
            $rdasset->gp=$data['gp'];
            $rdasset->muncipal_area=$data['muncipal_area'];
            $rdasset->nameofproperty=$data['nameofproperty'];
            $rdasset->owner=$data['owner'];
            $rdasset->type=$data['type'];
            $rdasset->area_type=$data['area_type'];
            $rdasset->use_of_building=$data['use_of_building'];
            $rdasset->otheruse=$data['otheruse'];
            $rdasset->along_highway=$data['along_highway'];
            $rdasset->area_land=$data['area_land'];
            $rdasset->areaofbuilding=$data['areaofbuilding'];
            $rdasset->gps=$data['gps'];
            $rdasset->current_income=$data['current_income'];
            $rdasset->legal_dispute=$data['legal_dispute'];

            // Upload PDF file

            if($data1->hasFile('jamabandi'))
            {
                $file=$data1->file('jamabandi');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/pos/jamabandi',$filename);
                $rdasset->jamabandi=$filename;
            }

            // Upload Image file

            if($data1->hasFile('picture'))
            {
                $file=$data1->file('picture');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/pos/picture',$filename);
                $rdasset->picture=$filename;
            }
            $rdasset->possibility_income=$data['possibility_income'];
            $rdasset->save();
            return redirect(url('po/viewAsset'))->with(["message"=>"Asset Added Successfully!"]);

        }
        catch(\Exceptionn $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function viewAsset()
    {
        $district=Auth::user()->district();
        $rddata=Rdassets::where('district',$district)->get();
        return view('PO.view-asset',compact('rddata'));
    }
}
