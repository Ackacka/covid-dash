<?php

class ChartData {

    public static function getDataPoints($chartData) {
        $xAxisDates;
        $yAxisValues;
        $monthTracker = '';

        $dataPoints = array();
        for ($i = 0; $i < count($chartData); $i++) {

            if (!is_null($chartData[$i]['positive'])) {
                $chartDate = $chartData[$i]['date'];
                $date = mktime(12, 0, 0, substr($chartDate, 4, 2), substr($chartDate, 6, 2), substr($chartDate, 0, 4));
                $month = date('M', $date);

//            if($chartData[$i])
                if ($month !== $monthTracker) {
                    array_push($dataPoints, '{ x: new Date(' . $date * 1000 . '), y: ' . $chartData[$i]['positive'] . ', indexLabel: "' . $month . '" }');
                    $monthTracker = $month;
                } else {
                    array_push($dataPoints, '{ x: new Date(' . $date * 1000 . '), y: ' . $chartData[$i]['positive'] . ' }');
                }
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

    public static function getChartTitle($state) {
        $title = '';
        if ($state === 'us') {
            $title = 'COVID cases nationally over time';
        } else {
            $title = 'COVID cases in ' . $state . ' over time';
        }
        return $title;
    }

}
