<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IOrder;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    protected  $orderRepo;

    public function __construct( IOrder $order )
    {
        app()->setLocale(session()->get('language') ??'ar');

    }

    /***************************  get all orders  **************************/
    public function index()
    {
        $objects    = [];
        return view('admin.orders.index', compact('objects'));
    }
}
