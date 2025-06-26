@extends('layouts.admin')

@section('page-title', 'Data Anak')

@section('main-content')
<!-- Search and Filter -->
<div class="bg-white shadow rounded-lg mb-6">
    <div class="p-6">
        <form method="GET" action="{{ route('admin.children') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari berdasarkan nama atau NIK..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.children') }}"
                   class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    Reset
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Children Table -->
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">
            Daftar Anak ({{ $children->total() }} total)
        </h3>
        <a href="{{ route('admin.export') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-300">
            Export Data
        </a>
    </div>

    @if($children->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Foto
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            NIK
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenis Kelamin
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Umur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Terakhir
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pengukuran
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($children as $child)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($child->photo)
                                <img src="{{ Storage::url($child->photo) }}" alt="{{ $child->name }}"
                                     class="w-12 h-12 object-cover rounded-full">
                            @else
                                <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 text-xs">👶</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $child->nik }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $child->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $child->age_in_months }} bulan
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($child->latest_measurement)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($child->latest_measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                    @elseif($child->latest_measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                    @elseif($child->latest_measurement->status == 'Normal') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ $child->latest_measurement->status }}
                                </span>
                            @else
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Belum diukur
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $child->measurements->count() }} kali
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.children.show', $child) }}"
                               class="text-blue-600 hover:text-blue-900">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $children->links() }}
        </div>
    @else
        <div class="px-6 py-12 text-center">
            <p class="text-gray-500">Tidak ada data anak ditemukan</p>
        </div>
    @endif
</div>
@endsection
