<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Brand;

class DeviceController extends Controller
{
    public function list() {
        $devices = Device::latest()->get();
        $brands = Brand::latest()->get();
        return view('devices.device', [
            'devices' => $devices,
            'brands' => $brands
        ]);
    }
    
    public function store()
    {

        $information = request()->validate(
            [
                'brand_id' => 'required',
                'name' => 'required|min:2|max:100|unique:devices',
            ]
        );
        
        
        Device::create($information);
        
        return redirect('/devices');
    }
}
