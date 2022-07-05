<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\UpdateProfile;
use App\Models\Admin;
use App\Repositories\Interfaces\IRole;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    protected $userRepo, $roleRepo;

    public function __construct(IUser $user,IRole $role )
    {
        $this->userRepo     = $user;
        $this->roleRepo     = $role;

    }

    /***************************  get all admins  **************************/
    public function index()
    {
        $admins             = Admin::get();
        $roles              = $this->roleRepo->get();
        return view('admin.admins.index', compact('admins','roles'));
    }


    /***************************  store admin **************************/
    public function store(Create $request)
    {
        $data                = array_filter($request->all());
        Admin::create($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update admin  **************************/
    public function update(Request $request, $id)
    {
        $data                = array_filter($request->all());
        $admin               = Admin::findOrFail($id);
        $admin->update($data);
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        if($id != 1)
        {
            Admin::findOrFail($id)->delete();
        }
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
