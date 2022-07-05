<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\Create;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAcademic;
class AcademicController extends Controller
{

    protected  $academicRepo;

    public function __construct( IAcademic $academic )
    {
        $this->academicRepo = $academic;
        app()->setLocale(session()->get('language') ??'ar');
    }

    /***************************  get all levels  **************************/
    public function index()
    {
        $objects    = $this->academicRepo->get();
        return view('admin.levels.index', compact('objects'));
    }


    /***************************  store admin **************************/
    public function store(Create $request)
    {
        $data = $request->except('_token');
        $this->academicRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update admin  **************************/
    public function update(Request $request, $id)
    {
        $city = $this->academicRepo->findOrFail($id);
        $this->academicRepo->update($city,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $role = $this->academicRepo->findOrFail($id);
        $this->academicRepo->softDelete($role);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
