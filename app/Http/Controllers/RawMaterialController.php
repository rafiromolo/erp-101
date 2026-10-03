<?php

namespace App\Http\Controllers;

use App\Models\MaterialCategory;
use App\Models\RawMaterial;
use App\Models\Unit;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function index()
    {
        $materials = RawMaterial::with(['category', 'unit'])->latest()->paginate(10);
        return view('raw-materials.index', compact('materials'));
    }

    public function create()
    {
        $categories = MaterialCategory::all();
        $units = Unit::all();
        return view('raw-materials.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_category_id' => 'required|exists:material_categories,id',
            'unit_id' => 'required|exists:units,id',
            'sku' => 'required|string|max:255|unique:raw_materials,sku',
            'name' => 'required|string|max:255',
            'min_stock' => 'required|numeric|min:0',
            'is_perishable' => 'boolean',
        ]);

        $validated['is_perishable'] = $request->has('is_perishable');

        RawMaterial::create($validated);

        return redirect()->route('raw-materials.index')
            ->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $material = RawMaterial::findOrFail($id);
        $categories = MaterialCategory::all();
        $units = Unit::all();
        return view('raw-materials.edit', compact('material', 'categories', 'units'));
    }

    public function update(Request $request, string $id)
    {
        $material = RawMaterial::findOrFail($id);

        $validated = $request->validate([
            'material_category_id' => 'required|exists:material_categories,id',
            'unit_id' => 'required|exists:units,id',
            'sku' => 'required|string|max:255|unique:raw_materials,sku,' . $material->id,
            'name' => 'required|string|max:255',
            'min_stock' => 'required|numeric|min:0',
            'is_perishable' => 'boolean',
        ]);

        $validated['is_perishable'] = $request->has('is_perishable');

        $material->update($validated);

        return redirect()->route('raw-materials.index')
            ->with('success', 'Bahan baku berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $material = RawMaterial::findOrFail($id);

        if ($material->recipeItems()->exists()
            || $material->stockCards()->exists()
            || $material->stockMovements()->exists()) {
            return redirect()->route('raw-materials.index')
                ->with('error', 'Bahan baku tidak bisa dihapus karena masih dipakai di resep atau tercatat di stok.');
        }

        $material->delete();

        return redirect()->route('raw-materials.index')
            ->with('success', 'Bahan baku berhasil dihapus.');
    }
}