<?php
session_start();
function shuffle_assoc($my_array)
{
    $keys = array_keys($my_array);
    shuffle($keys);
    foreach($keys as $key) {
        $new[$key] = $my_array[$key];
    }
    $my_array = $new;
    return $my_array;
}

function getCombinations($allOptionsArray, $final) {
    if(count($allOptionsArray)) {
        for($i=0; $i < count($allOptionsArray[0]); $i++) {
            $tmp = $allOptionsArray;
            $final->codes[$final->pos] = $allOptionsArray[0][$i];
            array_shift($tmp);
            $final->pos++;
            getCombinations($tmp, $final);
        }
    } else {
        $final->result[] = $final->codes;
    }
    $final->pos--;
}

function mergeArrayElement($elements,  $prob_count){
    $rev_array = array_reverse($elements);
    $new_elements = array_merge($elements,$rev_array);

    if(count($new_elements) <  $prob_count){
        while (count($new_elements) <  $prob_count) {
            $new_elements = mergeArrayElement($new_elements, $prob_count);  
        }
           
    } 
    return $new_elements;
       
}