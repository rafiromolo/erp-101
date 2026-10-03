<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bahan Baku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <a href="{{ route('raw-materials.create') }}" class="inline-block mb-4 px-4 py-2 bg-gray-800 text-white rounded">
                + Tambah Bahan Baku
            </a>

            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-left">SKU</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Satuan</th>
                        <th class="p-3 text-left">Stok Min</th>
                        <th class="p-3 text-left">Perishable</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materials as $material)
                        <tr class="border-b">
                            <td class="p-3">{{ $material->sku }}</td>
                            <td class="p-3">{{ $material->name }}</td>
                            <td class="p-3">{{ $material->category->name }}</td>
                            <td class="p-3">{{ $material->unit->symbol }}</td>
                            <td class="p-3">{{ $material->min_stock }}</td>
                            <td class="p-3">
                                @if ($material->is_perishable)
                                    <span class="text-orange-600">Ya</span>
                                @else
                                    <span class="text-gray-400">Tidak</span>
                                @endif
                            </td>
                            <td class="p-3 space-x-2">
                                <a href="{{ route('raw-materials.edit', $material->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('raw-materials.destroy', $material->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus bahan baku ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-3 text-center text-gray-500">
                                Belum ada bahan baku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $materials->links() }}
            </div>
        </div>
    </div>
</x-app-layout>