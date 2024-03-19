<?php

namespace App\Http\Controllers\DPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DPO\AssetDataRequests;
use App\Http\Requests\DPO\AssetUpdateRequests;

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
        try
        {
            $district=Auth::user()->district;
            $prdata=PRAsset::where('district',$district)->get();
            return view('dpo/view-asset',compact('prdata'));
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
            $prdata=PRAsset::find($id);
            return view('DPO/edit-asset',compact('prdata','district'));
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
            $prasset=PRAsset::find($id);
            if($prasset && $prasset->district===$district)
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
                $prasset->otheruse=$data['otheruse'];
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
                return redirect('dpo/view-asset')->with('message', 'Data updated successfully!');
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
              $asset=PRAsset::find($req->id);
              if(!$asset && $asset->district!=$district)
              {
                  return response()->json(['error'=>"Asset with this Id does not found."],404);
              }
  
              $destination='uploads/dpo/jamabandi/'.$asset->jamabandi;
              if(File::exists($destination))
              {
                  File::delete($destination);
              }
              $destination='uploads/dpo/picture/'.$asset->picture;
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
