<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IDuration;
use Illuminate\Http\Request;


class DurationController extends Controller
{
    protected $durationsRepo;

    public function __construct(IDuration $durations)
    {
        $this->durationsRepo  = $durations;
        app()->setLocale(session()->get('language') ??'ar');
    }
    /***************************  get all durations  **************************/
    public function index()
    {
        $objects    = $this->durationsRepo->get();
        return view('admin.durations.index', compact('objects'));
    }


    /***************************  store durationsRepo **************************/
    public function store(Request $request)
    {
        $data       = array_filter($request->all());
        $this->durationsRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update durationsRepo  **************************/
    public function update(Request $request, $id)
    {
        $ob        = $this->durationsRepo->findOrFail($id);
        $this->durationsRepo->update($ob,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete durationsRepo  **************************/
    public function destroy($id)
    {
        $ob = $this->durationsRepo->findOrFail($id);
        $this->durationsRepo->softDelete($ob);
        return redirect()->back()->with('success', 'Deleted successfully');
    }






}
