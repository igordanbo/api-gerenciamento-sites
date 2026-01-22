<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'total' => Product::count(),

            'status' => [
                'active'        => Product::where('status', 'active')->count(),
                'inactive'      => Product::where('status', 'inactive')->count(),
                'canceled'      => Product::where('status', 'canceled')->count(),
                'lost_domain'   => Product::where('status', 'lost_domain')->count(),
                'frozen_domain' => Product::where('status', 'frozen_domain')->count(),
                'maintenance'   => Product::where('status', 'maintenance')->count(),
            ],

            'hosting' => [
                'laon'     => Product::where('hosting', 'laon')->count(),
                'external' => Product::where('hosting', 'external')->count(),
            ],

            'department' => [
                'laon'      => Product::where('department', 'laon')->count(),
                'wordpress' => Product::where('department', 'wordpress')->count(),
                'opencart'  => Product::where('department', 'opencart')->count(),
                'outros'    => Product::where('department', 'outros')->count(),
            ],

            'service' => [
                'site'      => Product::where('service', 'site')->count(),
                'email' => Product::where('service', 'email')->count(),
                'sistema'  => Product::where('service', 'sistema')->count(),
                'site_email'    => Product::where('service', 'site_email')->count(),
                'site_sistema'    => Product::where('service', 'site_sistema')->count(),
                'sistema_email'    => Product::where('service', 'sistema_email')->count(),
                'site_email_sistema'    => Product::where('service', 'site_email_sistema')->count(),
            ],
        ]);
    }
}
