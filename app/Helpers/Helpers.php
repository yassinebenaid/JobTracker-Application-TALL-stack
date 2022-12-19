<?php


if (!function_exists("filterEmptyValues")) {

    /**
     * remove empty values from an array
     * * input : [0 =>"" ,1 => "somthing", 2 => "somthing else"];
     * * output : [1 => "somthing", 2 => "somthing else"]
     *
     * @param array $array
     * @return array
     */
    function filterEmptyValues(array $array): array
    {
        $new = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) $new[$key] = filterEmptyValues($value);
            else if (empty($value)) continue;
            else
                $new[$key] = $value;
        }

        foreach ($new as $key => $value) {
            if (empty($value)) unset($new[$key]);
        }

        return $new;
    }
}
