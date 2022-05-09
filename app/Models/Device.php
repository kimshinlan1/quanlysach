<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class Device extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
