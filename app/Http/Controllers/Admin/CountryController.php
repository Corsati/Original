<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\Create;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICountry;

class CountryController extends Controller
{

    protected  $countryRepo;

    public function __construct( ICountry $country)
    {
        $this->countryRepo = $country;
        app()->setLocale(session()->get('language') ??'ar');

    }

    /***************************  get all countries  **************************/
    public function index()
    {
        $objects  = $this->countryRepo->get();
        return view('admin.countries.index', compact('objects'));
    }


    /***************************  store admin **************************/
    public function store(Create $request)
    {
        $data = array_filter($request->all());
        $this->countryRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update admin  **************************/
    public function update(Request $request, $id)
    {
        $country = $this->countryRepo->findOrFail($id);
        $this->countryRepo->update($country,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $role = $this->countryRepo->findOrFail($id);
        $this->countryRepo->softDelete($role);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
