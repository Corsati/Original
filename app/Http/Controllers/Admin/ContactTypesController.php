<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\Create;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IContactType;
class ContactTypesController extends Controller
{

    protected  $contactTypeRepo;

    public function __construct( IContactType $contactType )
    {
        $this->contactTypeRepo = $contactType;
        app()->setLocale(session()->get('language') ??'ar');
    }

    /***************************  get all countries  **************************/
    public function index()
    {
        $objects    = $this->contactTypeRepo->get();
        return view('admin.contact-us-types.index', compact('objects'));
    }


    /***************************  store admin **************************/
    public function store(Create $request)
    {
        $data = $request->except('_token');
        $this->contactTypeRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update admin  **************************/
    public function update(Request $request, $id)
    {
        $object = $this->contactTypeRepo->findOrFail($id);
        $this->contactTypeRepo->update($object,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $object = $this->contactTypeRepo->findOrFail($id);
        $this->contactTypeRepo->softDelete($object);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
