<?php

namespace App\Http\Controllers\BDO;

use App\Http\Controllers\Controller;
use App\Http\Requests\PO\AssetDataRequests;
use App\Http\Requests\PO\AssetUpdateRequests;
use Illuminate\Http\Request;
use App\Models\Rdassets;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class RDController extends Controller
{
     // RD DAta
     public function addAssetRd()
     {
         $bdo=Auth::user()->bdo;
         return view('BDO.add-assetrd',compact('bdo'));
     }
 
     public function viewAsset()
     {
        try
        {
            $bdo=Auth::user()->bdo;
            $rddata=Rdassets::where('blocklist',$bdo)->get();
            return view('BDO/view-assetrd',compact('rddata'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
     }

     public function createAssetPr(AssetDataRequests $data1)
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
             $rdasset->rent_income=$data['rent_income'];
             if($data['rent_deposited']=='-1`')
             {
                 $rdasset['rent_deposited']=null;
             }
             else
             {
                 $rdasset['rent_deposited']=$data['rent_deposited'];
             }
 
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
             return redirect(url('bdo/view-assetrd'))->with(["message"=>"Asset Added Successfully!"]);
 
         }
         catch(\Exceptionn $e)
         {
             return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
         }
     }

     public function editAsset($id)
     {
        try
        {
            $block=Auth::user()->bdo;
            $rddata=Rdassets::find($id);
            return view('BDO/edit-assetrd',compact('rddata','block'));
        }
        catch(\Exception $e)
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
             $rdasset=Rdassets::find($id);
             if($rdasset)
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
                 if($data['use_of_building']!=='Other')
                 {
                     $rdasset->otheruse=null;
                 }
                 else
                 {
                     $rdasset->otheruse=$data['otheruse'];
                 }
 
                 if($data['use_of_building']!=='On Rent')
                 {
                     $rdasset->rent_income=null;
                     $rdasset->rent_deposited=null;
                 }
                 else
                 {
                     $rdasset->rent_income=$data['rent_income'];
                     $rdasset->rent_deposited=$data['rent_deposited'];
                 }
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
                 return redirect('bdo/view-assetrd')->with('message', 'Data updated successfully!');
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