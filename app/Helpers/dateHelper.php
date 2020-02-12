<?php

if (! function_exists('miladiToPersianDate'))
{
    /**
     * Convert miladi to shamsi
     */
    function
    miladiToPersianDate ($date,
                         $format = 'Y-m-d',
                         $lang = null)
    {
        $lang = $lang ?? \App::getLocale();

        if (is_null ($date))
        {
            return '';
        }

        if ($lang == 'en')
        {
            $date = new \Carbon\Carbon ($date);
        }
        else
        {
            $date = \jDate($date);
        }

        return $date->format ($format);
    }
}

if (! function_exists('miladiToPersianDateTime'))
{
        /**
         * Convert miladi to shamsi
         */
        function
        miladiToPersianDateTime ($date,
                             $format = 'Y-m-d H:i:s',
                                                 $lang = null)
        {
                return miladiToPersianDate ($date,
                                    $format,
                                    $lang);
        }
}
