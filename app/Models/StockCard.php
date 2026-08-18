<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCard extends Model
{
    use HasFactory;

    protected $fillable = ['warehouse_id', 'raw_material_id', 'quantity'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
