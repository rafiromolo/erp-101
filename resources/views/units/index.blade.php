<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Satuan (Unit)
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('units.create') }}" class="inline-block mb-4 px-4 py-2 bg-gray-800 text-white rounded">
                + Tambah Unit
            </a>

            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-left">Nama Unit</th>
                        <th class="p-3 text-left">Symbol</th>
                        <th class="p-3 text-left">Dibuat</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($units as $unit)
                        <tr class="border-b">
                            <td class="p-3">{{ $unit->name }}</td>
                            <td class="p-3">{{ $unit->symbol }}</td>
                            <td class="p-3">{{ $unit->created_at->format('d M Y') }}</td>
                            <td class="p-3">
                                <a href="{{ route('units.edit', $unit->id) }}" class="text-blue-600 hover:underline">Edit</a>

                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus unit ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center text-gray-500">
                                Belum ada unit.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $units->links() }}
            </div>
        </div>
    </div>
</x-app-layout>