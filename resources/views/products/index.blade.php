<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-1">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-green-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <a href="{{ route('products.create') }}" class="inline-block mb-4 px-4 bg-gray-800 text-white rounded">
                + Tambah Kategori
            </a>

            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-left">SKU</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Harga</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-b">
                            <td class="p-3">{{ $product->sku }}</td>
                            <td class="p-3">{{ $product->name }}</td>
                            <td class="p-3">{{ $product->category->name }}</td>
                            <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="p-3">
                                @if ($product->is_active)
                                    <span class="text-green-600">Aktif</span>
                                @else
                                    <span class="text-gray-400">Nonaktif</span>
                                @endif
                            </td>
                            <td class="p-3 space-x-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                                <a href="{{ route('recipes.edit', $product->id) }}" class="text-green-600 hover:underline">Resep</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="p-3 text-center text-gray-500">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>