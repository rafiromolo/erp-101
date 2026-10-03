<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Bahan Baku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('raw-materials.update', $material->id) }}" class="bg-white p-6 shadow rounded">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Bahan</label>
                    <select name="material_category_id" class="w-full border-gray-300 rounded">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('material_category_id', $material->material_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                    <select name="unit_id" class="w-full border-gray-300 rounded">
                        <option value="">-- Pilih Satuan --</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id', $material->unit_id) == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }} ({{ $unit->symbol }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $material->sku) }}" class="w-full border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bahan Baku</label>
                    <input type="text" name="name" value="{{ old('name', $material->name) }}" class="w-full border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok Minimum</label>
                    <input type="number" step="0.01" name="min_stock" value="{{ old('min_stock', $material->min_stock) }}" class="w-full border-gray-300 rounded">
                </div>

                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox" name="is_perishable" value="1" id="is_perishable" {{ old('is_perishable', $material->is_perishable) ? 'checked' : '' }} class="rounded">
                    <label for="is_perishable" class="text-sm text-gray-700">Mudah Rusak / Perishable</label>
                </div>

                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded">
                    Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>