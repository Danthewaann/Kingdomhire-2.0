<?php

namespace App;

use DB;
use Khill\Lavacharts\Exceptions\InvalidCellCount;
use Khill\Lavacharts\Exceptions\InvalidColumnType;
use Khill\Lavacharts\Exceptions\InvalidLabel;
use Khill\Lavacharts\Exceptions\InvalidRowDefinition;
use Khill\Lavacharts\Exceptions\InvalidRowProperty;
use Lava;
use Swatkins\LaravelGantt\Gantt;

class ChartGenerator
{
    public static function drawReservationsBarChart($activeVehicles)
    {
        $vehiclesTable = \Lava::DataTable();
        try {
            $vehiclesTable->addStringColumn('Vehicle')
                ->addNumberColumn('Number of reservations');
        } catch (InvalidColumnType $e) {
        } catch (InvalidLabel $e) {
        }

        $maxReservationsForVehicle = 0;
        foreach ($activeVehicles as $vehicle) {
            //Get the number of reservations from the vehicle that has the most reservations
            $numOfReservations = count($vehicle->reservations);
            if($numOfReservations > $maxReservationsForVehicle) {
                $maxReservationsForVehicle = $numOfReservations;
            }
            try {
            	$vehiclesTable->addRow([$vehicle->name(), $numOfReservations]);
            } catch (InvalidCellCount $e) {
            } catch (InvalidRowDefinition $e) {
            } catch (InvalidRowProperty $e) {
            }
        }

        Lava::BarChart('Vehicle Reservations', $vehiclesTable, [
            'backgroundColor' => '#439D70',
            'colors' => [
                'rgb(75, 206, 138)'
            ],
            'height' => count($activeVehicles)*50,
            'fontSize' => 12,
            'fontName' => 'Raleway',
            'chartArea' => [
//                'left' => '20%',
                'top' => '12.5%',
                'width' => '95%',
                'height' => '75%'
            ],
            'legend' => [
                'position' => 'top',
                'textStyle' => [
                    'fontSize' => 14,
                    'color' => 'white',
                    'fontName' => 'Raleway',
                ]
            ],
            'bar' => [
                'groupWidth' => '20'
            ],
            'vAxis' => [
                'textPosition' => 'in',
                'textStyle' => [
                    'color' => 'white',
                ],
            ],
            'hAxis' => [
                'baselineColor' => 'rgb(75, 206, 138)',
                'textStyle' => [
                    'color' => 'white',
                ],
                'minValue' => 0,
                'maxValue' => ($maxReservationsForVehicle > 3 ? $maxReservationsForVehicle : 3),
                'gridlines' => [
                    'count' => ($maxReservationsForVehicle > 3 ? $maxReservationsForVehicle : 3)+1,
                    'color' => 'rgb(75, 206, 138)'
                ],
            ],
        ]);
    }

    public static function drawPastHiresBarChart($pastHires)
    {
        $pastHiresTable = \Lava::DataTable();
        try {
            $pastHiresTable->addStringColumn('Month')
                ->addNumberColumn('Number of hires');
        } catch (InvalidColumnType $e) {
        } catch (InvalidLabel $e) {
        }

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

        foreach ($pastHires as $hire) {
            $currentYear = date('Y');
            if(date('Y', strtotime($hire->end_date)) == $currentYear) {
                $month = date('M', strtotime($hire->end_date));
                $hiresPerMonth[$month]++;
            }
        }

        $maxAmountOfHiresForMonth = 0;
        foreach ($hiresPerMonth as $month => $hires) {
            //Get the number of hires from the month that has the most hires
            if($hires > $maxAmountOfHiresForMonth) {
                $maxAmountOfHiresForMonth = $hires;
            }
            try {
                $pastHiresTable->addRow([$month, $hires]);
            } catch (InvalidCellCount $e) {
            } catch (InvalidRowDefinition $e) {
            } catch (InvalidRowProperty $e) {
            }
        }

        Lava::ColumnChart('Hires per month', $pastHiresTable, [
            'backgroundColor' => '#439D70',
            'colors' => [
                'rgb(75, 206, 138)'
            ],
            'height' => 350,
            'chartArea' => [
                'top' => '12.5%',
                'width' => '95%',
                'height' => '75%'
            ],
            'fontSize' => 12,
            'fontName' => 'Raleway',
            'legend' => [
                'position' => 'top',
                'textStyle' => [
                    'fontSize' => 14,
                    'color' => 'white',
                    'fontName' => 'Raleway',
                ]
            ],
            'bar' => [
                'groupWidth' => '20'
            ],
            'hAxis' => [
                'textStyle' => [
                    'color' => 'white',
                ],
            ],
            'vAxis' => [
                'baselineColor' => 'rgb(75, 206, 138)',
                'textStyle' => [
                    'color' => 'white',
                ],
                'minValue' => 0,
                'maxValue' => ($maxAmountOfHiresForMonth > 5 ? $maxAmountOfHiresForMonth : 5),
                'gridlines' => [
                    'count' => ($maxAmountOfHiresForMonth > 5 ? $maxAmountOfHiresForMonth : 5)+1,
                    'color' => 'rgb(75, 206, 138)'
                ],
            ],
        ]);
    }

    public static function drawVehicleReservationsAndHiresGanttChart(Vehicle $vehicle)
    {
        $data = array();
        $reservations = Reservation::whereVehicleId($vehicle->id)->get();
        $activeHire = $vehicle->getActiveHire();
        if($activeHire != null) {
            $reservationsAndActiveHire = $reservations->merge(collect([$activeHire]))->sortBy('start_date');
        }
        else {
            $reservationsAndActiveHire = $reservations->sortBy('start_date');
        }
        foreach ($reservationsAndActiveHire as $item) {
            array_push($data, [
                'label' => ($item instanceof Reservation ? 'Reservation' : 'Active hire'),
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
            $gantt = new Gantt($data, array(
                'title' => 'Schedule',
                'cellwidth' => 30,
                'cellheight' => 40
            ));
        }

        return $gantt;
    }
}