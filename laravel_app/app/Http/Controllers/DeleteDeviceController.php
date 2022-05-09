<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeleteDeviceController extends Controller
{
    public function deleteDevice()
    {
        $information = request()->validate([
            'delete-id' => 'required',
        ]);
        $device = Device::find($information['delete-id']);
        $device->delete();

        return redirect('/devices');
    }
}
