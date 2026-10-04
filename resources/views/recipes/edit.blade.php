<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Atur Resep: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('recipes.update', $product->id) }}" class="bg-white p-6 shadow rounded">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Yield (jumlah porsi dihasilkan)</label>
                    <input type="number" name="yield_qty" step="0.01"
                        value="{{ old('yield_qty', $recipe->yield_qty ?? 1) }}"
                        class="w-32 border-gray-300 rounded">
                </div>

                <div x-data="{
                    items: [
                        @if ($recipe && $recipe->items->count())
                            @foreach ($recipe->items as $item)
                                { raw_material_id: '{{ $item->raw_material_id }}', unit_id: '{{ $item->unit_id }}', quantity: '{{ $item->quantity }}' },
                            @endforeach
                        @else
                            { raw_material_id: '', unit_id: '', quantity: '' },
                        @endif
                    ]
                }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Bahan Baku</label>

                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex gap-2 mb-3 items-end border-b pb-3">
                            <div class="flex-1">
                                <label class="block text-xs text-gray-500 mb-1">Bahan Baku</label>
                                <select :name="`items[${index}][raw_material_id]`" x-model="item.raw_material_id"
                                        class="w-full border-gray-300 rounded">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($rawMaterials as $rawMaterial)
                                        <option value="{{ $rawMaterial->id }}">{{ $rawMaterial->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-40">
                                <label class="block text-xs text-gray-500 mb-1">Satuan</label>
                                <select :name="`items[${index}][unit_id]`" x-model="item.unit_id"
                                        class="w-full border-gray-300 rounded">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }} ({{ $unit->symbol }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-28">
                                <label class="block text-xs text-gray-500 mb-1">Jumlah</label>
                                <input type="number" step="0.01" :name="`items[${index}][quantity]`"
                                       x-model="item.quantity" class="w-full border-gray-300 rounded">
                            </div>

                            <button type="button" @click="items.splice(index, 1)"
                                    class="text-red-600 hover:underline pb-2">
                                Hapus
                            </button>
                        </div>
                    </template>

                    <button type="button"
                            @click="items.push({ raw_material_id: '', unit_id: '', quantity: '' })"
                            class="text-blue-600 hover:underline text-sm mb-6">
                        + Tambah Bahan
                    </button>
                </div>

                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded">
                    Simpan Resep
                </button>
            </form>
        </div>
    </div>
</x-app-layout>