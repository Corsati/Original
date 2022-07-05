<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    protected $contactUsRepo;

    public function __construct(IContactUs $contact_us)
    {
        $this->contactUsRepo = $contact_us;
        app()->setLocale(session()->get('language') ??'ar');
    }

    /***************************  get all contact us messages  **************************/
    public function index()
    {
         $messages    = $this->contactUsRepo->get();
        return view('admin.contact_us.index', compact('messages'));
    }

    /***************************  show message  **************************/
    public function show($id){
        $message = $this->contactUsRepo->findOrFail($id);
        return view('admin.contact_us.show',compact('message'));
    }


    /***************************  delete message  **************************/
    public function destroy($id)
    {
        $message = $this->contactUsRepo->findOrFail($id);
        $this->contactUsRepo->softDelete($message);
        return redirect()->route('admin.contact_us.index')->with('success', 'تم الحذف بنجاح');
    }
}
