<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PRAsset;
use App\Models\Rdassets;
use App\Http\Requests\Admin\UserDataRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function addUser()
    {
        return view('Admin.adduser');
    }

    public function createUser(UserDataRequest $req)
    {
        try
        {
            $data=$req->validated();
            $user=new User();
            $user->username=$req['username'];
            $user->email=$req['email'];
            $user->password=Hash::make($req['password']);
            $user->role=$req['role'];
            $user->district=$req['district'];
            $user->save();
            return redirect(url('admin/viewUser'));

        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function viewUser()
    {
        try
        {
            $user=User::all();
            return view('Admin.viewuser',compact('user'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
        
    }

    public function edit($id)
    {
        try
        {
            if($id!=null)
            {
                $user=User::find($id);
                if($user->count()===0)
                {
                    return redirect()->back()->withErrors(['error' =>'No user find']);
                }
                return view('Admin.edituser',compact('user'));
            }
            else
            {
                return redirect()->back()->withErrors(['error' =>"Id can not be null"]);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
        
    }

    public function update(UserUpdateRequest $req,$id)
    {
        try
        {
            if($id!=null)
            {
                $data=$req->validated();
                $user=User::find($id);
                $user->username=$data['username'];
                $user->email=$data['email'];
                $user->password=Hash::make($data['password']);
                $update=$user->update();
                if($update)
                {
                    return redirect(url('admin/viewUser'))->with('message',"User Data Updated Successfully");
                }
            }
            else
            {
                return redirect()->back()->withErrors(['error' => 'ID can not be null']);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function viewRD()
    {
        $rddata = Rdassets::orderBy('created_at', 'desc')->get();
        return view('Admin.viewrddata',compact('rddata'));
    }
    public function viewPR()
    {
        $prasset = PRAsset::orderBy('created_at', 'desc')->get();
        return view('Admin.viewprdata',compact('prasset'));
    }

    public function dashboard()
    {
        // Count Assets from RD 
        $rddataCount = Rdassets::select('district',DB::raw('count(*) as count'))
        ->groupBy('district')
        ->orderBy('district')
        ->get()
        ->keyBy('district');
        // Count Assets from PR
        $prdataCount = PRAsset::select('district',DB::raw('count(*) as count'))
        ->groupBy('district')
        ->orderBy('district')
        ->get()
        ->keyBy('district');

        // Combine data
        $mergedCounts = [];
        foreach($rddataCount as $district=>$data)
        {
            $mergedCounts[$district]['Rdassets']=$data->count;
            $mergedCounts[$district]['PRAsset']=0;
        }

        foreach($prdataCount as $district => $data)
        {
            if(!isset($mergedCounts[$district]))
            {
                $mergedCounts[$district]['Rdassets']=0;
            }
            $mergedCounts[$district]['PRAsset']=$data->count;
        }
        ksort($mergedCounts);
        return view('Admin.dashboard',['districtCount'=>$mergedCounts]);
    }
}
