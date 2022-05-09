<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function devices() {
        return $this->hasMany(Device::class);
    }
}
