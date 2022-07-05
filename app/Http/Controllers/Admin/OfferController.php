<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\Create;
use App\Repositories\Interfaces\IOffer;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICountry;
use App\Repositories\Interfaces\ICity;

class OfferController extends Controller
{

    protected  $cityRepo;

    public function __construct( IOffer $offer )
    {
        $this->offerRepo = $offer;
        app()->setLocale(session()->get('language') ??'ar');

    }

    /***************************  get all countries  **************************/
    public function index()
    {
        $objects    = $this->offerRepo->get()->where('type','guest');
        return view('admin.offers.index', compact('objects'));
    }

    /***************************  get all countries  **************************/
    public function home()
    {
        $objects    = $this->offerRepo->get()->where('type','auth');
        return view('admin.offers.index', compact('objects'));
    }


    /***************************  store admin **************************/
    public function store(Request $request)
    {
        $this->offerRepo->store($request->except('_token'));
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update admin  **************************/
    public function update(Request $request, $id)
    {
        $offer = $this->offerRepo->findOrFail($id);
        $this->offerRepo->update($offer,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
       $this->offerRepo->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function status($id){
        $offer = $this->offerRepo->findOrFail($id);
        $offer->update(['open_counter'  => $offer->open_counter ? false : true]);
        return redirect()->back()->with('success', 'updated successfully');
    }
}
