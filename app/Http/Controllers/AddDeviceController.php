<?php

namespace App\Http\Controllers;

use App\Models\Brand;

class AddDeviceController extends Controller
{
    public function create()
    {
        $brands = Brand::all();
        return View('devices.add-device', [
            'brands' => $brands
        ]);
    }

}
