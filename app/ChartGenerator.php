<?php

namespace App;

use DB;
use Khill\Lavacharts\Exceptions\InvalidCellCount;
use Khill\Lavacharts\Exceptions\InvalidColumnType;
use Khill\Lavacharts\Exceptions\InvalidLabel;
use Khill\Lavacharts\Exceptions\InvalidRowDefinition;
use Khill\Lavacharts\Exceptions\InvalidRowProperty;
use Khill\Lavacharts\DataTables\DataFactory;
use Khill\Lavacharts\Charts\ChartFactory;
use Khill\Lavacharts\Volcano;
use Lava;
use Swatkins\LaravelGantt\Gantt;

class ChartGenerator
{
    public static function drawReservationsBarChart($activeVehicles)
    {
        $vehiclesTable = Lava::DataTable();
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
            'backgroundColor' => 'transparent',
            'colors' => [
                'rgb(75, 206, 138)'
            ],
            'height' => count($activeVehicles)*55,
            'width' => 700,
            'fontSize' => 14,
            'fontName' => 'Raleway',
            'chartArea' => [
                'width' => '95%',
                'height' => '80%'
            ],
            'legend' => [
                'position' => 'top',
                'textStyle' => [
                    'fontSize' => 14,
                    'color' => 'white',
                    'fontName' => 'Raleway',
                ]
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
            'backgroundColor' => 'transparent',
            'colors' => [
                'rgb(75, 206, 138)'
            ],
            'height' => 400,
            'width' => 755,
            'chartArea' => [
                'left' => '5%',
                'width' => '95%',
                'height' => '85%'
            ],
            'fontSize' => 14,
            'fontName' => 'Raleway',
            'legend' => [
                'position' => 'top',
                'textStyle' => [
                    'fontSize' => 14,
                    'color' => 'white',
                    'fontName' => 'Raleway',
                ]
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
            ]
        ]);
    }

    public static function drawOverallPastHiresBarChart($pastHires)
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

        if(count($pastHires) == 0) {
            $pastHiresTable = \Lava::DataTable();
            try {
                $pastHiresTable->addStringColumn('Month')
                    ->addNumberColumn('Number of hires');
            } catch (InvalidColumnType $e) {
            } catch (InvalidLabel $e) {
            }

            foreach ($hiresPerMonth as $month => $hires) {
                try {
                    $pastHiresTable->addRow([$month, $hires]);
                } catch (InvalidCellCount $e) {
                } catch (InvalidRowDefinition $e) {
                } catch (InvalidRowProperty $e) {
                }
            }
        }
        else {
            foreach ($pastHires as $hire) {
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

            $json_str = json_encode($json);
            $pastHiresTable = DataFactory::createFromJson($json_str);

            $r = 75;
            $g = 206;
            $b = 138;
            foreach (array_keys($years) as $year) {
                array_push($series, [
                    'labelInLegend' => $year,
                    //                'color' => 'rgb('.$r.', '.$g.','.$b.')'
                ]);
                $r += 30;
                $g += 5;
                $b += 15;
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
            'isStacked' => 'true',
            'backgroundColor' => 'transparent',
            'height' => $maxAmountOfHiresForMonth*30,
//            'height' => 700,
            'width' => 700,
            'chartArea' => [
                'left' => '5%',
                'width' => '95%',
                'height' => '85%'
            ],
            'fontSize' => 14,
            'fontName' => 'Raleway',
            'legend' => [
                'maxLines' => count($years),
                'position' => 'top',
                'textStyle' => [
                    'fontSize' => 14,
                    'color' => 'white',
                    'fontName' => 'Raleway',
                ]
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
            'series' => $series
        ]);

        return $maxAmountOfHiresForMonth;
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
                'label' => ($item instanceof Reservation ? 'R ('.$item->made_by.')' : 'H ('.$item->hired_by.')'),
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

    public static function drawVehiclesActiveHiresGanttChart($vehicles)
    {
        $data = array();
        foreach ($vehicles as $vehicle) {
            $activeHire = $vehicle->getActiveHire();
            if($activeHire != null) {
                array_push($data, [
                    'label' => $vehicle->name(),
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
            $gantt = new Gantt($data, array(
                'title' => "Active <br> Hires",
                'cellwidth' => 30,
                'cellheight' => 40
            ));
        }

        return $gantt;
    }
}