<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_category_id',
        'unit_id',
        'sku',
        'name',
        'min_stock',
        'is_perishable',
    ];
}
