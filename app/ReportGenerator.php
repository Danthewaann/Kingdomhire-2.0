<?php

namespace App;

use DB;
use App\Hire;
use App\Vehicle;
use PdfReport;
use ExcelReport;
use CSVReport;
use DateTime;
use Session;

class ReportGenerator
{
    public static function generateHiresPerVehicleReport()
    {
        $vehicles_count = Vehicle::withTrashed()->count();
        $hires_count = Hire::count();
        if($vehicles_count > 0 && $hires_count > 0) {
            $vehicle_ids = Vehicle::withTrashed()->select(['id'])->get();
            $query = Hire::select(
                'hires.id', 'hires.name as hire_id', 'vehicle_id', 'start_date', 'end_date', 
                DB::raw('concat(vehicles.make, " ", vehicles.model, " - ", vehicles.name) as vehicle'), 'vehicles.deleted_at as vehicle_active'
            )
            ->join('vehicles', 'vehicle_id', '=', 'vehicles.id')
            ->whereIn('vehicles.id', $vehicle_ids)
            ->orderBy('vehicle')
            ->orderByDesc('end_date');

            $title = "Hires per Vehicle";

            $meta = [
                'Total Vehicles' => $vehicles_count,
                'Avg Hires per Vehicle' => number_format($hires_count / $vehicles_count),
                'Total Hires' => $hires_count,
                'Between' => date('d M Y', strtotime(Hire::orderBy('start_date')->limit(1)->pluck('start_date')[0]))
                            . ' - ' . date('d M Y', strtotime(Hire::orderByDesc('end_date')->limit(1)->pluck('end_date')[0]))
            ];
            
            $columns = [
                'Vehicle',
                'Active' => 'vehicle_active',
                'Hire ID' => 'hire_id',
                'Start Date',
                'End Date',
                'Duration' => function($result) {
                    $start = new DateTime($result->start_date);
                    $end = new DateTime($result->end_date);
                    $interval = $start->diff($end);

                    return $interval->days;
                }
            ];

            $report = PdfReport::of($title, $meta, $query, $columns)
                                ->editColumn('Start Date', [
                                    'displayAs' => function($result) {
                                        return date('d M Y', strtotime($result->start_date));
                                    }
                                ])
                                ->editColumn('End Date', [
                                    'displayAs' => function($result) {
                                        return date('d M Y', strtotime($result->end_date));
                                    }
                                ])
                                ->editColumn('Active', [
                                    'displayAs' => function($result) {
                                        return $result->vehicle_active == null ? 'Yes' : 'No';
                                    }
                                ])
                                ->editColumn('Duration', [
                                    'displayAs' => function($result) {
                                        $start = new DateTime($result->start_date);
                                        $end = new DateTime($result->end_date);
                                        $interval = $start->diff($end);

                                        return $interval->days . ' days';
                                    },
                                    'class' => 'right'
                                ])
                                ->setCss([
                                    '.bolder' => 'font-weight: 800;',
                                ])
                                ->groupBy('Vehicle')
                                ->showTotal([
                                    'Duration' => 'point'
                                ])
                                ->make();

            return $report->stream();
        }
        else {
            Session::flash('status', [
                'Failed to generate PDF report!',
                'No vehicles or hires found to generate report with!'
            ]);

            return back();
        }
    }
}