<?php
session_start();
 if(isset($_POST['firstnumbers']) && isset($_POST['secondnumbers'])){
       
        $_SESSION['data']['first'] = $_POST['firstnumbers'];
        $_SESSION['data']['second'] = $_POST['secondnumbers']; 
        
        $_SESSION['data']['probs'] = $_POST['probs'];
        $_SESSION['data']['title'] = $_POST['title'];
        $_SESSION['data']['fcredit'] = $_POST['fcredit'];
        $_SESSION['data']['action'] = $_POST['action'];
        $_SESSION['data']['count'] = 0;
        echo  json_encode(array('success' => 'YES','data'=>$_SESSION));
} 

?>