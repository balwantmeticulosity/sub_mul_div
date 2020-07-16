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

    if(isset($_POST['firstaddent']) && isset($_POST['secondaddent'])){
        
        $_SESSION['data']['first'] = $_POST['firstaddent'];
        $_SESSION['data']['second'] = $_POST['secondaddent']; 
        $_SESSION['data']['probs'] = $_POST['probs'];
        $_SESSION['data']['title'] = $_POST['title'];
        $_SESSION['data']['fcredit'] = $_POST['fcredit'];


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
        //unset($_POST);
        echo  json_encode(array('success' => 'YES','data'=>$_SESSION));
        return;
    }
    if(!empty($_SESSION['data']['addents'])){
     $_SESSION['data']['addents'] = shuffle_assoc($_SESSION['data']['addents']); 
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="cache-control" content="no-cache" />
    <title>Dynamically Created Math Worksheets</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/form-validation.css" rel="stylesheet">
    <style>
        iframe {width: 100%;height: 800px;}
    </style>
</head>
<body class="bg-light">
    <div class="container">
       <br></br>
       <a class="btn btn-primary btn-lg btn-block"  href="/pdf">Back to home</a>
       <br></br>
    <?php if(!empty($_SESSION['data']['addents'])){  ?>   
        <iframe src="problems.php"></iframe>
    <?php  }  ?>   
    </div>
<footer class="my-5 pt-5 text-muted text-center text-small"></footer>
</body></html>

