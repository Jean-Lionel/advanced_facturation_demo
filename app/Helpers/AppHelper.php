<?php

namespace App\Helpers;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class AppHelper
{

    public static function monthToFrench($month)
    {
        $french_months = [
            "01" => "JANVIER", "02" => "FEVRIER", "03" => "MARS",
            "04" => "AVRIL", "05" => "MAI", "06" => "JUIN",
            "07" => "JUILLET", "08" => "AOUT", "09" => "SEPTEMBRE",
            "10" => "OCTOBRE", "11" => "NOVEMBRE", "12" => "DECEMBRE",
        ];
        return $french_months[$month];
    }

    public static function dateToFrench($date, $format = "date")
    {

        $search = explode('-', $date);
        $french_months = [
            "01" => "JANVIER", "02" => "FEVRIER", "03" => "MARS",
            "04" => "AVRIL", "05" => "MAI", "06" => "JUIN",
            "07" => "JUILLET", "08" => "AOUT", "09" => "SEPTEMBRE",
            "10" => "OCTOBRE", "11" => "NOVEMBRE", "12" => "DECEMBRE",
        ];

        $french_months = collect($french_months);

        $result = $french_months->first(function ($value, $key) use ($search) {
            return $key == $search[1];
        });

        if ($format == "month") {
            return $result . ' ' . $search[0];
        } else {
            return $search[2] . ' ' . $result . ' ' . $search[0];
        }
    }

    public static function paginateArray($data, $perPage = 15)
    {
        $page = Paginator::resolveCurrentPage();
        $total = count($data);
        $results = array_slice($data, ($page - 1) * $perPage, $perPage);
        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
    }
}
