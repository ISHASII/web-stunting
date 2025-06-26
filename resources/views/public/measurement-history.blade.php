@extends('layouts.public')

@section('title', 'Riwayat Pengukuran - Sistem Deteksi Stunting')

@section('main-content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <div class="flex flex-wrap items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Pengukuran</h1>
                        <p class="text-gray-600">{{ $child->name }} (NIK: {{ $child->nik }})</p>
                    </div>
                    @if($child->photo)
                        <div>
                            <img src="{{ Storage::url($child->photo) }}" alt="Foto {{ $child->name }}"
                                 class="w-20 h-20 object-cover rounded-lg">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Grafik Pertumbuhan</h2>
                <div class="h-64 flex items-center justify-center bg-gray-100 rounded">
                    <canvas id="growthChart" width="800" height="400"></canvas>
                </div>
            </div>

            <!-- History Table -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Data Pengukuran</h2>
                </div>

                @if($measurements->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Umur (Bulan)
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tinggi (cm)
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Z-Score
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Petugas
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($measurements as $measurement)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $measurement->measurement_date->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $measurement->age_months }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $measurement->height }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $measurement->z_score }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                            @elseif($measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                            @elseif($measurement->status == 'Normal') bg-green-100 text-green-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ $measurement->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $measurement->user ? $measurement->user->name : 'Publik' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-8 py-12 text-center">
                        <p class="text-gray-500">Belum ada data pengukuran</p>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-wrap gap-4 justify-center">
                <a href="{{ route('stunting.form') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    Tambah Pengukuran Baru
                </a>
                <a href="{{ route('home') }}"
                   class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('growthChart').getContext('2d');

    const measurements = @json($measurements->reverse()->values());

    const labels = measurements.map(m => m.age_months + ' bulan');
    const heights = measurements.map(m => parseFloat(m.height));
    const zScores = measurements.map(m => parseFloat(m.z_score));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tinggi Badan (cm)',
                data: heights,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                yAxisID: 'y'
            }, {
                label: 'Z-Score',
                data: zScores,
                borderColor: 'rgb(16, 185, 129)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Umur'
                    }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Tinggi Badan (cm)'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Z-Score'
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Pertumbuhan Anak'
                }
            }
        }
    });
});
</script>
@endsection
