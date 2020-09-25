<?php

if(!function_exists('compactOptions')){
    function compactOptions($options)
    {
       $result = [];

        foreach($options as $option) {
            $result[(int) $option['option_id']] = array('commission' => $option['commission']);
        }
        
        return $result;
    }
}



if(!function_exists('sqlDistance')){
    function sqlDistance($lat, $lng)
    {
        return \Illuminate\Support\Facades\DB::raw(
            "TRIM(TRAILING '.0' FROM TRUNCATE
             (( 6371 * acos ( cos ( radians({$lat}) ) * cos( radians( latitude ) )
                   * cos( radians( longitude) - radians({$lng}) )
                   + sin ( radians({$lat}) ) * sin( radians( latitude ) ) ) ), 1))
            AS distance"
        );
    }
}