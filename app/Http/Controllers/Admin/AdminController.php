<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PRAsset;
use App\Models\Rdasset;
use App\Http\Requests\Admin\UserDataRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function addUser()
    {
        return view('admin.adduser');
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
            return view('admin.viewuser',compact('user'));
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
        
    }
    public function viewPR()
    {
        $prasset= PRAsset::all();
        return view('Admin.viewprdata',compact('prasset'));
    }
}
