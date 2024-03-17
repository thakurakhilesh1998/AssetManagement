<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PO\AssetDataRequests;
use App\Http\Requests\PO\AssetUpdateRequests;
use App\Models\Rdassets;
use Illuminate\Support\Facades\File;

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
            $district=Auth::user()->district;
            $rdasset->district=$district;
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
                $filename=$district.time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/pos/jamabandi',$filename);
                $rdasset->jamabandi=$filename;
            }

            // Upload Image file

            if($data1->hasFile('picture'))
            {
                $file=$data1->file('picture');
                $filename=$district.time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/pos/picture',$filename);
                $rdasset->picture=$filename;
            }
            $rdasset->possibility_income=$data['possibility_income'];
            $rdasset->save();
            return redirect(url('po/view-asset'))->with(["message"=>"Asset Added Successfully!"]);

        }
        catch(\Exceptionn $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function viewAsset()
    {
        try
        {
            $district=Auth::user()->district;
            $rddata=Rdassets::where('district',$district)->get();
            return view('PO/view-asset',compact('rddata'));
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
            $district=Auth::user()->district;
            $rddata=Rdassets::find($id);
            return view('PO/edit-asset',compact('rddata','district'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function change(AssetUpdateRequests $data1,$id)
    {
        $district=Auth::user()->district;
        if($id!==null)
        {
            $rdasset=Rdassets::find($id);
            if($rdasset && $rdasset->district===$district)
            {
                $data=$data1->validated();
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
                // PDF file checking
                if(isset($data['jamabandi']))
                {
                    if($data1->hasFile('jamabandi'))
                    {
                        $destination='uploads/pos/jamabandi/'.$rdasset->jamabandi;
                        if(File::exists($destination))
                        {
                            File::delete($destination);
                        }
                        $file=$data1->file('jamabandi');
                        $filename=$district.time().'.'.$file->getClientOriginalExtension();
                        $file->move('uploads/pos/jamabandi',$filename);
                        $rdasset->jamabandi=$filename;
                    }
                }
                // Picture file checking
                if(isset($data['picture']))
                {
                    if($data1->hasFile('picture'))
                    {
                        $destination='uploads/pos/picture/'.$rdasset->picture;
                        if(File::exists($destination))
                        {
                            File::delete($destination);
                        }
                        $file=$data1->file('picture');
                        $filename=$district.time().'.'.$file->getClientOriginalExtension();
                        $file->move('uploads/pos/picture',$filename);
                        $rdasset->picture=$filename;
                    }
                }
                $rdasset->save();
                return redirect('po/view-asset')->with('message', 'Data updated successfully!');
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

    // Delete Asset
    public function delete(Request $req)
    {
        try
        {
            $district=Auth::user()->district;
            $asset=Rdassets::find($req->id);
            if(!$asset && $asset->district!=$district)
            {
                return response()->json(['error'=>"Asset with this Id does not found."],404);
            }

            $destination='uploads/pos/jamabandi/'.$asset->jamabandi;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $destination='uploads/pos/picture/'.$asset->picture;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $asset->delete();
            return response()->json(['success' => true, 'message' => 'Asset Deleted Successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['success' => false, 'error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }
}
