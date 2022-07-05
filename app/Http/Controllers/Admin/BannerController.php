<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IBanner;

class BannerController extends Controller
{

    protected  $bannerRepo;

    public function __construct( IBanner $banner )
    {
        $this->bannerRepo = $banner;
    }

    /***************************  get all banner  **************************/
    public function index()
    {
        $objects    = $this->bannerRepo->get();
        return view('admin.banners.index', compact('objects'));
    }


    /***************************  store banner **************************/
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $this->bannerRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update banner  **************************/
    public function activate( $id)
    {
        $banner     = $this->bannerRepo->find($id);
        if($banner->active == 1)
            $banner->update(['active' => 0]);
        else
            $banner->update(['active' => 1]);

        return redirect()->back()->with('success', 'updated successfully');

    }

    /***************************  delete banner  **************************/
    public function destroy($id)
    {
         $this->bannerRepo->find($id)->delete();
        return redirect()->back()->with('success', 'deleted successfully');
    }

}
