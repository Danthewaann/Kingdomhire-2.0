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
                ->addNumberColumn('Active Reservations');
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
            'title' => 'Current Active Reservations',
            'colors' => [
                'rgb(40,143,91)'
            ],
            'height' => count($activeVehicles)*60,
            'chartArea' => [
                'left' => '20%',
                'top' => '20%',
                'width' => '75%',
            ],
            'fontSize' => 12,
            'legend' => [
                'position' => 'top',
            ],
            'bar' => [
                'groupWidth' => '20'
            ],
            'hAxis' => [
                'maxValue' => ($maxReservationsForVehicle > 3 ? $maxReservationsForVehicle : 3),
                'gridlines' => [
                    'count' => ($maxReservationsForVehicle > 3 ? $maxReservationsForVehicle : 3)+1
                ],
                'title' => 'Number of active reservations',
            ],
        ]);
    }

    public static function drawPastHiresBarChart($pastHires)
    {
        $pastHiresTable = \Lava::DataTable();
        try {
            $pastHiresTable->addStringColumn('Month')
                ->addNumberColumn('Hires Per Month');
        } catch (InvalidColumnType $e) {
        } catch (InvalidLabel $e) {
        }

        $hiresPerMonth = [
            'January' => 0,
            'February' => 0,
            'March' => 0,
            'April' => 0,
            'May' => 0,
            'June' => 0,
            'July' => 0,
            'August' => 0,
            'September' => 0,
            'October' => 0,
            'November' => 0,
            'December' => 0
        ];

        foreach ($pastHires as $hire) {
            $currentYear = date('Y');
            if(date('Y', strtotime($hire->end_date)) == $currentYear) {
                $month = date('F', strtotime($hire->end_date));
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

        Lava::BarChart('Hires per month', $pastHiresTable, [
            'title' => 'Hires Per Month for '.date('Y'),
            'colors' => [
                'rgb(40,143,91)'
            ],
            'height' => 700,
            'chartArea' => [
                'left' => '12.5%',
                'top' => '10%',
                'width' => '80%',
            ],
            'fontSize' => 12,
            'legend' => [
                'position' => 'top',
            ],
            'bar' => [
                'groupWidth' => '20'
            ],
            'hAxis' => [
                'maxValue' => ($maxAmountOfHiresForMonth > 5 ? $maxAmountOfHiresForMonth : 5),
                'gridlines' => [
                    'count' => ($maxAmountOfHiresForMonth > 5 ? $maxAmountOfHiresForMonth : 5)+1
                ],
                'title' => 'Number of hires per month',
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
                'label' => ($item instanceof Reservation ? 'Reservation' : 'Hire'),
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
                'cellwidth' => 30,
                'cellheight' => 35
            ));
        }

        return $gantt;
    }
}