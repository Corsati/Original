<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\Create;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICountry;
use App\Repositories\Interfaces\ICity;

class CityController extends Controller
{

    protected  $cityRepo;

    public function __construct( ICity $city , ICountry $country)
    {
        $this->cityRepo = $city;
        $this->countryRepo = $country;
        app()->setLocale(session()->get('language') ??'ar');

    }

    /***************************  get all countries  **************************/
    public function index()
    {
        $objects    = $this->cityRepo->get();
        $countries  = $this->countryRepo->get();
        return view('admin.cities.index', compact('objects','countries'));
    }


    /***************************  store admin **************************/
    public function store(Create $request)
    {
        $data = array_filter($request->all());
        $this->cityRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update admin  **************************/
    public function update(Request $request, $id)
    {
        $city = $this->cityRepo->findOrFail($id);
        $this->cityRepo->update($city,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $role = $this->cityRepo->findOrFail($id);
        $this->cityRepo->softDelete($role);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
