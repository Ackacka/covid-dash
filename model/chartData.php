<?php

class ChartData {

    public static function getDataPoints($chartData, $yaxis) {
        $xAxisDates;
        $yAxisValues;

        $dataPoints = array();
        for ($i = 0; $i < count($chartData); $i++) {

            if (!is_null($chartData[$i][$yaxis])) {
                $chartDate = $chartData[$i]['date'];
                $date = mktime(12, 0, 0, substr($chartDate, 4, 2), substr($chartDate, 6, 2), substr($chartDate, 0, 4));

                array_push($dataPoints, '{ x: new Date(' . $date * 1000 . '), y: ' . $chartData[$i][$yaxis] . ' }');//               
            }
        }
        $dataPointsString = '[';
        foreach ($dataPoints as $d) {
            if ($d !== end($dataPoints)) {
                $dataPointsString .= $d . ', ';
            } else {
                $dataPointsString .= $d . ']';
            }
        }

        return $dataPointsString;
    }

    public static function getChartTitle($state, $yaxis) {
        $title = '';
        $firstHalfTitle = '';
        $state = strtoupper($state);
        if ($yaxis === 'positive') {
            $title = 'COVID cases in ' . $state . ' over time';
        } else if ($yaxis === 'hospitalizedCurrently') {
            $title = 'Hospitalizations in ' . $state . ' over time';
        } else if ($yaxis === 'death') {
            $title = 'COVID deaths in ' . $state . ' over time';
        }

        return $title;
    }

}
