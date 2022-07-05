<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IPriceTire;
use Illuminate\Http\Request;


class PriceController extends Controller
{
    protected $pricesRepo;

    public function __construct(IPriceTire $prices)
    {
        $this->pricesRepo  = $prices;
        app()->setLocale(session()->get('language') ??'ar');
    }
    /***************************  get all prices  **************************/
    public function index()
    {
        $objects    = $this->pricesRepo->get();
        return view('admin.prices.index', compact('objects'));
    }


    /***************************  store prices **************************/
    public function store(Request $request)
    {
        $data       = array_filter($request->all());
        $this->pricesRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update prices  **************************/
    public function update(Request $request, $id)
    {
        $ob        = $this->pricesRepo->findOrFail($id);
        $this->pricesRepo->update($ob,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete prices  **************************/
    public function destroy($id)
    {
        $ob = $this->pricesRepo->findOrFail($id);
        $this->pricesRepo->softDelete($ob);
        return redirect()->back()->with('success', 'Deleted successfully');
    }






}
