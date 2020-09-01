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