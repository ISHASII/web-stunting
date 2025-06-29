<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Measurement;
use App\Exports\MeasurementExport;
use Maatwebsite\Excel\Facades\Excel;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test:export', function () {
    $this->info('Testing Excel export...');

    try {
        // Get some measurements
        $measurements = Measurement::with(['child', 'user'])->take(5)->get();
        $this->info('Found ' . $measurements->count() . ' measurements');

        // Test the export class
        $export = new MeasurementExport($measurements, []);
        $this->info('MeasurementExport class created successfully');

        // Test headings
        $headings = $export->headings();
        $this->info('Headings: ' . implode(', ', $headings));

        // Test mapping the first measurement
        if ($measurements->count() > 0) {
            $mapped = $export->map($measurements->first());
            $this->info('Mapped data: ' . implode(', ', $mapped));
        }

        $this->info('Excel export test completed successfully!');

    } catch (\Exception $e) {
        $this->error('Excel export test failed: ' . $e->getMessage());
        $this->error('File: ' . $e->getFile());
        $this->error('Line: ' . $e->getLine());
    }
})->purpose('Test Excel export functionality');
