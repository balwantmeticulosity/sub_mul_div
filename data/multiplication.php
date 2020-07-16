<?php
    if($_SESSION['data'] && ($_SESSION['data']['count'] == 0)){
        
        $first = $_SESSION['data']['first'];
        $second = $_SESSION['data']['second'];
        if((!empty($first)) && (!empty($second))){

            $allOptionsArray = array($first, $second);
            $final = new stdClass();
            $final->result = array();
            $final->codes  = array();
            $final->pos    = 0;
            getCombinations($allOptionsArray, $final);

            $addents = $final->result;
            //$final->result is an array containing all possible combinations
             
            $prob_count = (int) $_SESSION['data']['probs'];
            if(count($addents) < $prob_count){
                $new_addents = mergeArrayElement($addents, $prob_count);
                $_SESSION['data']['addents'] = $new_addents;
            } else {
                $_SESSION['data']['addents'] = $addents;
            }
        }
        $_SESSION['data']['count'] = 1;
    }
    

