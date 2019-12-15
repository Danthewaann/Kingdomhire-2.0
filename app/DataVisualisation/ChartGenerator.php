<?php

namespace App\DataVisualisation;

use Khill\Lavacharts\DataTables\DataFactory;
use Illuminate\Database\Eloquent\Collection;
use Lava;
use App\Vehicle;

class ChartGenerator
{
    /**
     * Draw reservations chart for active vehicles
     * Only vehicles that have at least 1 reservation will be included
     * in the chart
     * 
     * @param CollectionW $activeVehicles 
     */
    public static function drawReservationsBarChart(Collection $activeVehicles)
    {
        $vehiclesTable = Lava::DataTable();
        $vehiclesTable->addStringColumn('Vehicle');
        $vehiclesTable->addNumberColumn('Number of reservations');

        $vehicles = $activeVehicles->reject(function ($vehicle) {
            return $vehicle->reservations->count() < 1;
        });
        $maxReservationsForVehicle = 0;

        foreach ($vehicles as $vehicle) {
            //Get the number of reservations from the vehicle that has the most reservations
            $numOfReservations = $vehicle->reservations->count();
            if($numOfReservations > $maxReservationsForVehicle) {
                $maxReservationsForVehicle = $numOfReservations;
            }
            $vehiclesTable->addRow([$vehicle->make_model, $numOfReservations]);
        }

        Lava::BarChart('Vehicle Reservations', $vehiclesTable, [
            'backgroundColor' => 'transparent',
            'colors' => [
                'rgb(75, 206, 138)'
            ],
            'height' => (count($vehicles) > 1 ? (count($vehicles) * 50) + 60 : 150),
            'width' => '100%',
            'fontSize' => '1.1em',
            'fontName' => 'Helvetica',
            'chartArea' => [
                'top' => 30,
                'width' => '92,5%',
                'height' => (count($vehicles) > 1 ? count($vehicles) * 50 : 100)
            ],
            'legend' => [
                'position' => 'top',
                'textStyle' => [
                    'color' => 'white',
                    'fontName' => 'Helvetica',
                ]
            ],
            'bar' => [
                'groupWidth' => (count($vehicles) > 1 ? '75%' : '50%')
            ],
            'vAxis' => [
                'textPosition' => 'in',
                'textStyle' => [
                    'color' => 'white',
                ],
            ],
            'hAxis' => [
                'baselineColor' => 'rgb(62, 167, 113)',
                'textStyle' => [
                    'color' => 'white',
                ],
                'minValue' => 0,
                'maxValue' => ($maxReservationsForVehicle > 2 ? $maxReservationsForVehicle : 2),
                'gridlines' => [
                    'count' => ($maxReservationsForVehicle > 2 ? $maxReservationsForVehicle : 2)+1,
                    'color' => 'rgb(62, 167, 113)'
                ],
                'minorGridlines' => [
                    'count' => 0
                ],
            ],
        ]);
    }

    /**
     * Draw hires chart for all vehicles
     * Both active and past hires will be included in the chart
     * 
     * @param Collection $hires
     * @param int $height - height of chart in pixels, defaults to 400
     */
    public static function drawOverallHiresBarChart(Collection $hires, $height=400)
    {
        $years = [];
        $maxAmountOfHiresForMonth = 0;
        $series = [];
        $hiresPerMonth = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];

        if(count($hires) == 0) {
            $pastHiresTable = Lava::DataTable();
            $pastHiresTable->addStringColumn('Month');
            $pastHiresTable->addNumberColumn('Number of hires');

            foreach ($hiresPerMonth as $month => $hires) {
                $pastHiresTable->addRow([$month, $hires]);
            }
        }
        else {
            foreach ($hires->sortBy('end_date') as $hire) {
                $year = date('Y', strtotime($hire->end_date));
                if (!array_key_exists($year, $years)) {
                    $years[$year] = $hiresPerMonth;
                }
                $years[$year][date('M', strtotime($hire->end_date))]++;
            }
            $json = [
                'cols' => [
                    [
                        'id' => '',
                        'label' => 'Month',
                        'pattern' => '',
                        'type' => 'string'
                    ]
                ],
                'rows' => []
            ];


            $i = 0;
            foreach ($years as $year => $months) {
                array_push($json['cols'], [
                    'id' => '',
                    'label' => $year,
                    'type' => 'number'
                ]);
                $i++;
                if (count($json['rows']) == 0) {
                    foreach ($months as $month => $hires) {
                        array_push($json['rows'], [
                            'c' => [
                                [
                                    'v' => $month,
                                    'f' => $month . ' ' . $year
                                ],
                                [
                                    'v' => $hires,
                                    'f' => $hires . ' for ' . $year
                                ]
                            ]
                        ]);
                    }
                } else {
                    $j = 0;
                    foreach ($months as $month => $hires) {

                        array_push($json['rows'][$j]['c'], [
                            'v' => $hires
                        ]);
                        $j++;
                    }
                }
            }

            $pastHiresTable = DataFactory::createFromJson(json_encode($json));

            foreach (array_keys($years) as $year) {
                array_push($series, [
                    'labelInLegend' => $year,
                ]);
            }

            foreach ($years as $year) {
                foreach (array_keys($year) as $month) {
                    $hiresPerMonth[$month] += $year[$month];
                }
            }

            foreach ($hiresPerMonth as $hires) {
                //Get the number of hires from the month that has the most hires
                if ($hires > $maxAmountOfHiresForMonth) {
                    $maxAmountOfHiresForMonth = $hires;
                }
            }
        }

        Lava::ColumnChart('Overall Hires per month', $pastHiresTable, [
            'colors' => [
                'rgb(75, 206, 138)',
                'rgb(75, 190, 206)',
                'rgb(186, 146, 203)',
                'rgb(206, 194, 75)',
                'rgb(206, 107, 75)'
            ],
            'fontSize' => '1.1em',
            'isStacked' => 'true',
            'backgroundColor' => 'transparent',
            'height' => ($maxAmountOfHiresForMonth >= 40 ? 550 : $height),
            'width' => '100%',
            'chartArea' => [
                'left' => '7.5%',
                'width' => '90%',
                'height' => '80%'
            ],
            'fontName' => 'Helvetica',
            'legend' => [
                'maxLines' => count($years),
                'position' => 'top',
                'textStyle' => [
                    'color' => 'white',
                    'fontName' => 'Helvetica',
                ]
            ],
            'hAxis' => [
                'textStyle' => [
                    'color' => 'white',
                ],
                'slantedText' => 'true',
                'slantedTextAngle' => 90
            ],
            'vAxis' => [
                'baselineColor' => 'rgb(62, 167, 113)',
                'textStyle' => [
                    'color' => 'white',
                ],
                'minValue' => 0,
                'maxValue' => ($maxAmountOfHiresForMonth >= 5 ? $maxAmountOfHiresForMonth : 5),
                'gridlines' => [
                    'count' => ($maxAmountOfHiresForMonth >= 5 ? $maxAmountOfHiresForMonth : 5)+1,
                    'color' => 'rgb(62, 167, 113)'
                ],
                'minorGridlines' => [
                    'count' => 0
                ],
            ],
            'series' => $series
        ]);
    }

    /**
     * Draw Gantt chart that includes both reservations and the active
     * hire of a specific vehicle
     * 
     * @param App\Vehicle $vehicle
     * @return App\DataVisualisation\GanttChart $gantt
     */
    public static function drawVehicleReservationsAndHiresGanttChart(Vehicle $vehicle)
    {
        $data = array();
        $reservations = $vehicle->reservations;
        $activeHire = $vehicle->active_hire;
        if($activeHire != null) {
            $reservationsAndActiveHire = $reservations->merge(collect([$activeHire]))->sortBy('start_date');
        }
        else {
            $reservationsAndActiveHire = $reservations->sortBy('start_date');
        }

        foreach ($reservationsAndActiveHire as $item) {
            array_push($data, [
                'label' => strtoupper(((string) $item)) . ' ('.$item->name.')',
                'start' => $item->start_date,
                /*
                 * when creating the gantt chart, the final day in each reservation/hire is truncated
                 * e.g the end date "2018-05-03" becomes "2018-05-02" on the gantt chart
                 * so we add on an extra day to counter this, so the proper end date is displayed
                */
                'end' => date('Y-m-d', strtotime($item->end_date . ' +1 day'))
            ]);
        }

        $gantt = null;
        if ($reservationsAndActiveHire->isNotEmpty()) {
            $gantt = new GanttChart($data, array(
                'cellwidth' => 20,
                'cellheight' => 40
            ));
        }

        return $gantt;
    }

    /**
     * Draw Gantt chart that includes active hires for all vehicles
     * 
     * @param App\Vehicle[] $vehicles
     * @return App\DataVisualisation\GanttChart $gantt
     */
    public static function drawVehiclesActiveHiresGanttChart(Collection $vehicles)
    {
        $data = array();
        foreach ($vehicles as $vehicle) {
            $activeHire = $vehicle->active_hire;
            if($activeHire != null) {
                array_push($data, [
                    'label' => $vehicle->full_name,
                    'start' => $activeHire->start_date,
                    /*
                     * when creating the gantt chart, the final day in each reservation/hire is truncated
                     * e.g the end date "2018-05-03" becomes "2018-05-02" on the gantt chart
                     * so we add on an extra day to counter this, so the proper end date is displayed
                    */
                    'end' => date('Y-m-d', strtotime($activeHire->end_date . ' +1 day'))
                ]);
            }
        }

        $gantt = null;
        if (count($data) > 0) {
            $gantt = new GanttChart($data, array(
                'cellwidth' => 22,
                'cellheight' => 35
            ));
        }

        return $gantt;
    }
}
