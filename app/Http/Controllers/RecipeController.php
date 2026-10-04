<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use App\Models\RawMaterial;
use App\Models\Unit;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function edit(string $productId)
    {
        $product = Product::findOrFail($productId);
        $recipe = Recipe::where('product_id', $product->id)->with('items')->first();
        $rawMaterials = RawMaterial::all();
        $units = Unit::all();

        return view('recipes.edit', compact('product', 'recipe', 'rawMaterials', 'units'));
    }

    public function update(Request $request, string $productId)
    {
        $product = Product::findOrFail($productId);

        $validated = $request->validate([
            'yield_qty' => 'required|numeric|min:0.01',
            'items' => 'required|array|min:1',
            'items.*.raw_material_id' => 'required|exists:raw_materials,id',
            'items.*.unit_id' => 'required|exists:units,id',
            'items.*.quantity' => 'required|numeric|min:0.01',
        ]);

        $recipe = Recipe::firstOrNew(['product_id' => $product->id]);
        $recipe->name = 'Resep ' . $product->name;
        $recipe->yield_qty = $validated['yield_qty'];
        $recipe->save();

        $recipe->items()->delete();
        foreach ($validated['items'] as $item) {
            $recipe->items()->create($item);
        }

        return redirect()->route('products.index')
            ->with('success', 'Resep berhasil disimpan.');
    }
}
