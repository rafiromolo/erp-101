<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kategori produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('product-categories.create') }}" class="inline-block mb-4 px-4 bg-gray-800 text-white rounded">
                + Tambah Kategori
            </a>

            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-left">Nama Kategori</th>
                        <th class="p-3 text-left">Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b">
                            <td class="p-3">{{ $category.name }}</td>
                            <td class="p-3">{{ $category->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-3 text-center text-gray-500">
                                Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>