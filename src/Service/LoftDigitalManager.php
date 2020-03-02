<?php

namespace App\Service;

class LoftDigitalManager
{
    public function sortRouteArray($json): array
    {
        $unsortedArray = json_decode($json, true);
        $length = count($unsortedArray);
        $comparison = 0;

        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length - 1; $j++) {
                $comparison++;

                if ($unsortedArray[ $j ]['to'] !== $unsortedArray[ $j + 1 ]['from']) {
                    $tmp = $unsortedArray[ $j + 1 ];
                    $unsortedArray[ $j + 1 ] = $unsortedArray[ $j ];
                    $unsortedArray[ $j ] = $tmp;
                }

                if ($unsortedArray[$j]['to'] < $unsortedArray[$j + 1]['from']) {
                    $tmp = $unsortedArray[$j + 1];
                    $unsortedArray[$j + 1] = $unsortedArray[$j];
                    $unsortedArray[$j] = $tmp;
                }
            }
        }

        $merged = [];
        foreach ($unsortedArray as $route){
            foreach ($route as $key => $value ) {
                $merged[] = $value;
            }
        }

        return array_values(array_unique($merged));
    }
}
