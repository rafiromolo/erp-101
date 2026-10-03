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

    public function category()
    {
        return $this->belongsTo(MaterialCategory::class, 'material_category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function recipeItems()
    {
        return $this->hasMany(RecipeItem::class);
    }

    public function stockCards()
    {
        return $this->hasMany(StockCard::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
