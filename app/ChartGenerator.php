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
            'height' => '400',
            'chartArea' => [
                'left' => '25%',
                'top' => '25%',
            ],
            'fontSize' => 14,
            'legend' => [
                'position' => 'top',
            ],
            'bar' => [
                'groupWidth' => '10'
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
        $reservations = Reservation::whereVehicleId($vehicle->id)
            ->orderBy('start_date', 'asc')
            ->orderBy('end_date', 'asc')
            ->get();

        $hires = Hire::whereVehicleId($vehicle->id)
            ->orderBy('start_date', 'asc')
            ->orderBy('end_date', 'asc')
            ->get(['start_date', 'end_date']);

        foreach ($reservations as $reservation) {
            array_push($data, [
                'label' => 'Reservation',
                'start' => $reservation->start_date,
                'end' => $reservation->end_date
            ]);
        }

        foreach ($hires as $hire) {
            array_push($data, [
                'label' => 'Hire',
                'start' => $hire->start_date,
                'end' => $hire->end_date
            ]);
        }

        $gantt = new Gantt($data, array(
            'cellwidth'  => 20,
            'cellheight' => 35
        ));

        return $gantt;
    }
}