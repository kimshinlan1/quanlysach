<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;

class EditDeviceController extends Controller
{
    public function editForm() {
        $brands = Brand::all();
        return View('devices.edit-device', [
            'brands' => $brands
        ]);
    }
    public function editDevice() {
        $information = request()->validate(
            [
                'id' => 'required',
                // 'brand_name' => 'required',
                'name' => 'required|min:2|max:100|unique:devices',
            ]
        );
        $device = Device::findOrFail($information['id']);
        $device->name = $information['name'];
        $device->save();
        return redirect('/devices');
    }
}
