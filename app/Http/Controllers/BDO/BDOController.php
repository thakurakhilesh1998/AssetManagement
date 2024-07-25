<?php

namespace App\Http\Controllers\BDO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PRAsset;
use App\Http\Requests\DPO\AssetDataRequests;
use App\Http\Requests\DPO\AssetUpdateRequests;
use Illuminate\Support\Facades\File;


class BDOController extends Controller
{
    public function addAsset()
    {
        $block=Auth::user()->bdo;
        return view('BDO.add-assetpr',compact('block'));
    }

    public function viewAsset()
    {
        try
        {
            $block=Auth::user()->bdo;
            $prdata=PRAsset::where('blocklist',$block)->get();
            return view('BDO/view-assetpr',compact('prdata'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function editAsset($id)
    {
        try
        {
            $block=Auth::user()->bdo;
            $prdata=PRAsset::find($id);
            return view('BDO/edit-assetpr',compact('prdata','block'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
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
            $prasset->rent_income=$data['rent_income'];

            if($data['rent_deposited']=='-1`')
            {
                $prasset['rent_deposited']=null;
            }
            else
            {
                $prasset['rent_deposited']=$data['rent_deposited'];
            }
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
            return redirect(url('bdo/view-assetpr'))->with(["message"=>"Asset Added Successfully!"]);

        }
        catch(\Exceptionn $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }
    public function change(AssetUpdateRequests $data1,$id)
    {
        $block=Auth::user()->bdo;
        $district=Auth::user()->district;
        if($id!==null)
        {
            $prasset=PRAsset::find($id);
            if($prasset && $prasset->blocklist===$block)
            {
                $data=$data1->validated();
                $prasset->blocklist=$data['blocklist'];
                $prasset->gp=$data['gp'];
                $prasset->muncipal_area=$data['muncipal_area'];
                $prasset->nameofproperty=$data['nameofproperty'];
                $prasset->owner=$data['owner'];
                $prasset->type=$data['type'];
                $prasset->area_type=$data['area_type'];
                $prasset->use_of_building=$data['use_of_building'];
                if($data['use_of_building']!=='Other')
                {
                    $prasset->otheruse=null;
                }
                else
                {
                    $prasset->otheruse=$data['otheruse'];
                }

                if($data['use_of_building']!=='On Rent')
                {
                    $prasset->rent_income=null;
                    $prasset->rent_deposited=null;
                }
                else
                {
                    $prasset->rent_income=$data['rent_income'];
                    $prasset->rent_deposited=$data['rent_deposited'];
                }

                
                $prasset->along_highway=$data['along_highway'];
                $prasset->area_land=$data['area_land'];
                $prasset->areaofbuilding=$data['areaofbuilding'];
                $prasset->gps=$data['gps'];
                $prasset->current_income=$data['current_income'];
                $prasset->legal_dispute=$data['legal_dispute'];
                // PDF file checking
                if(isset($data['jamabandi']))
                {
                    if($data1->hasFile('jamabandi'))
                    {
                        $destination='uploads/dpo/jamabandi/'.$prasset->jamabandi;
                        if(File::exists($destination))
                        {
                            File::delete($destination);
                        }
                        $file=$data1->file('jamabandi');
                        $filename=$district.time().'.'.$file->getClientOriginalExtension();
                        $file->move('uploads/dpo/jamabandi',$filename);
                        $prasset->jamabandi=$filename;
                    }
                }
                // Picture file checking
                if(isset($data['picture']))
                {
                    if($data1->hasFile('picture'))
                    {
                        $destination='uploads/dpo/picture/'.$prasset->picture;
                        if(File::exists($destination))
                        {
                            File::delete($destination);
                        }
                        $file=$data1->file('picture');
                        $filename=$district.time().'.'.$file->getClientOriginalExtension();
                        $file->move('uploads/dpo/picture',$filename);
                        $prasset->picture=$filename;
                    }
                }
                $prasset->save();
                return redirect('bdo/view-assetpr')->with('message', 'Data updated successfully!');
            }
            else
            {
                return redirect()->back()->withErrors(['error' => 'ID not valid for the current district']);
            }
        }
        else
        {
            return redirect()->back()->withErrors(['error' =>'ID not be null']);
        }
    }
}
