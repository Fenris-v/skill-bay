<?php


namespace App\Traits;


use Carbon\Carbon;

trait TimeFormat
{
    /**
     * Форматирует дату в формате 'd-m-Y H:i:s'
     * @param $date
     * @return string
     */
    public function fullDateFormat($date): string
    {
        return Carbon::make($date)->format('d-m-Y H:i:s');
    }
}
