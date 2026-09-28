<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Unit
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-l mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('units.store') }}" method="post" class="bg-white p-6 shadow rounded">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Unit</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <label class="block text-sm font-medium text-gray-700 mb-1">Simbol</label>
                    <input type="text" name="symbol" value="{{ old('symbol') }}" class="w-full border-gray-300 rounded">
                    @error('symbol')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>