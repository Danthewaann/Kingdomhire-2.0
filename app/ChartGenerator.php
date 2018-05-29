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

        foreach ($activeVehicles as $vehicle) {
            try {
                $vehiclesTable->addRow([$vehicle->name(), count($vehicle->reservations)]);
            } catch (InvalidCellCount $e) {
            } catch (InvalidRowDefinition $e) {
            } catch (InvalidRowProperty $e) {
            }
        }

        Lava::BarChart('Vehicle Reservations', $vehiclesTable, [
            'title' => 'Vehicle Reservations',
            'colors' => [
                'rgb(40,143,91)'
            ],
            'height' => count($activeVehicles)*45,
            'chartArea' => [
                'left' => '20%',
                'top' => '15%',
            ],
            'fontSize' => 14,
            'legend' => [
                'position' => 'top',
            ],
            'bar' => [
                'groupWidth' => '15'
            ],
            'hAxis' => [
                'maxValue' => 10,
                'gridlines' => [
                    'count' => 11
                ],
                'title' => 'Number of active reservations',
            ],
        ]);
    }

    public static function drawVehicleReservationsAndHiresGanttChart(Vehicle $vehicle)
    {
        $data = array();
        $reservations = Reservation::whereVehicleId($vehicle->id)->get();
        $hires = Hire::whereVehicleId($vehicle->id)->get();
        $reservationsAndHires = $reservations->merge($hires)->sortBy('start_date');

        foreach ($reservationsAndHires as $item) {
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
        if ($reservationsAndHires->isNotEmpty()) {
            $gantt = new Gantt($data, array(
                'cellwidth' => 35,
                'cellheight' => 40
            ));
        }

        return $gantt;
    }
}