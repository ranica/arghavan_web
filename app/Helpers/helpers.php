<?php
    /**
     * Mearge Daily Traffics
     * @param  [type] $source [input daily traffic]
     * @param  [type] $target [output daily traffic]
     * @return [type]         [description]
     */
    function meargeDailyTraffics ($source, $target)
    {
        $labels = [];
        $series = [];
        for ($hour = 6; $hour < 20; ++$hour)
        {
            $label = $hour;
            $series_t = [
                    'inputCount'  => 0,
                    'outputCount' => 0
            ];
            // Find respective input record
            foreach ($source as $item)
            {
                if ($item->hour == $hour)
                {
                    $series_t['inputCount'] += $item->count;
                    break;
                }
            }
            // Find respective output record
            foreach ($target as $item)
            {
                if ($item->hour == $hour)
                {
                    $series_t['outputCount'] += $item->count;
                    break;
                }
            }
            $labels[] = $label;
            $series[] = $series_t;
        }


        $output = [
            'labels' => $labels,
            'series' => $series
        ];
        return $output;
    }
    /**
     * Mearge Weekday Traffics
     * @param  [type] $source [input Traffic]
     * @param  [type] $target [output Traffic]
     * @return [type]         [description]
     */
    function meargeWeekdayTraffics ($source, $target)
    {
        $labels = [];
        $series = [];

        for ($number = 0; $number < 7; $number++)
        {
            $day = jddayofweek($number, 1);
            //dd($day);
            $label = getDayNames($day);
            //$label = $day;
            $series_t = [
                    'inputCount'  => 0,
                    'outputCount' => 0
            ];
            // Find respective input record
            foreach ($source as $item)
            {
                if ($item->day == $day)
                {
                    $series_t['inputCount'] += $item->count;
                    break;
                }
            }
            // Find respective output record
            foreach ($target as $item)
            {
                if ($item->day == $day)
                {
                    $series_t['outputCount'] += $item->count;
                    break;
                }
            }
            $labels[] = $label;
            $series[] = $series_t;
        }

        // Move lables
        $dataItem = array_splice ($labels, 5, 2);
        array_splice($labels, 0, 0, $dataItem);
        $dataItem = array_splice ($series, 5, 2);
        array_splice($series, 0, 0, $dataItem);

        $output = [
            'labels' => $labels,
            'series' => $series
        ];

        return $output;
    }

    /**
     * Mearge Month Traffics
     * @param  [type] $source [input Traffics]
     * @param  [type] $target [output Traffics]
     * @return [type]         [description]
     */
    function meargeMonthTraffics ($source, $target)
    {
        $labels = [];
        $series = [];
        for ($number = 1; $number < 13; ++$number)
        {
            $month   = DateTime::createFromFormat('!m', $number)->format('F');
            $label = getMonthNames($month);
            //$label = $month;
            $series_t = [
                    'inputCount'  => 0,
                    'outputCount' => 0
            ];
            // Find respective input record
            foreach ($source as $item)
            {
                if ($item->month == $month)
                {
                    $series_t['inputCount'] += $item->count;
                    break;
                }
            }
            // Find respective output record
            foreach ($target as $item)
            {
                if ($item->month == $month)
                {
                    $series_t['outputCount'] += $item->count;
                    break;
                }
            }
            $labels[] = $label;
            $series[] = $series_t;
        }
        $output = [
            'labels' => $labels,
            'series' => $series
        ];
        return $output;
    }
    /**
     * Convert Milady week day Name to Persian week day Name
     */
    function getDayNames($day, $shorten = false, $len = 1, $numeric = false)
    {
        $ret = '';
        switch ( strtolower($day) ) {
            case 'sat': case 'saturday': $ret = 'شنبه'; $n = 1; break;
            case 'sun': case 'sunday': $ret = 'یکشنبه'; $n = 2; break;
            case 'mon': case 'monday': $ret = 'دوشنبه'; $n = 3; break;
            case 'tue': case 'tuesday': $ret = 'سه شنبه'; $n = 4; break;
            case 'wed': case 'wednesday': $ret = 'چهارشنبه'; $n = 5; break;
            case 'thu': case 'thursday': $ret = 'پنجشنبه'; $n = 6; break;
            case 'fri': case 'friday': $ret = 'جمعه'; $n = 7; break;
        }
        return ($numeric) ? $n : (($shorten) ? mb_substr($ret, 0, $len, 'UTF-8') : $ret);
    }
    /**
     * Convert Milady Month Name to Persian Month Name
     */
    function getMonthNames($month, $shorten = false, $len = 3)
    {
        $ret = '';
        switch ( strtolower($month) ) {
            case 'april': $ret = 'فروردین'; break;
            case 'may': $ret = 'اردیبهشت'; break;
            case 'june': $ret = 'خرداد'; break;
            case 'july': $ret = 'تیر'; break;
            case 'august': $ret = 'امرداد'; break;
            case 'september': $ret = 'شهریور'; break;
            case 'october': $ret = 'مهر'; break;
            case 'november': $ret = 'آبان'; break;
            case 'december': $ret = 'آذر'; break;
            case 'january': $ret = 'دی'; break;
            case 'february': $ret = 'بهمن'; break;
            case 'march': $ret = 'اسفند'; break;
        }
        return ($shorten) ? mb_substr($ret, 0, $len, 'UTF-8') : $ret;
    }
