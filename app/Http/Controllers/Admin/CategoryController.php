<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\Create;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICategory;
use App\Models\Category;
class CategoryController extends Controller
{

    protected  $categoryRepo;

    public function __construct( ICategory $category )
    {
        $this->categoryRepo = $category;
    }

    /***************************  get all countries  **************************/
    public function index()
    {
        $objects    = $this->categoryRepo->get();
        $main       = Category::whereNull('parent_id')->count();
        $sub        = Category::whereNotNull('parent_id')->count();

        return view('admin.categories.index', compact('objects','main','sub'));
    }


    public function main(){
        $objects    = Category::whereNull('parent_id')->get();
        $main       = Category::whereNull('parent_id')->count();
        $sub        = Category::whereNotNull('parent_id')->count();
        return view('admin.categories.index', compact('objects','main','sub'));

    }

    public function subCategories($id = null){
        $text       = '';
        if($id)
        {
            $objects= Category::where('parent_id',$id)->get();

        }
        else
        $objects    = Category::whereNotNull('parent_id')->get();
        $main       = Category::whereNotNull('parent_id')->count();
        $sub        = Category::whereNotNull('parent_id')->count();
        if($id)
        {
        $categories = Category::find($id);
        if($categories)
              $text = array_reverse(Category::find($id)->getAllParentsText());
        else
              $text = Category::find($id)->name;
        }

        return view('admin.categories.index', compact('objects','main','sub','id','text'));

    }
    /***************************  store admin **************************/
    public function store(Create $request)
    {
        $data       = $request->except('_token');
        $this->categoryRepo->store($data);
        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update admin  **************************/
    public function update(Request $request, $id)
    {
        $category   = $this->categoryRepo->findOrFail($id);
        $this->categoryRepo->update($category,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $role       = $this->categoryRepo->findOrFail($id);
        $this->categoryRepo->softDelete($role);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
