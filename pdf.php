<?php
session_start();
include 'data/util.php';
 //print_r($_SESSION);
if(!empty($_SESSION['data'])){
    
    $action =  $_SESSION['data']['action'];  
    switch( $action){
        case 'add':
            include 'data/addition.php';
            break;
            
        case 'sub':
             include 'data/subtraction.php';
            break; 
            
         case 'div':
             include 'data/division.php';
            break;
            
        case 'mul':
            include 'data/multiplication.php';
            break;
            
        case 'fefault':
           break;  
        
    }
   
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
       <a class="btn btn-primary btn-lg btn-block"  href="index.html">Back to home</a>
       <br></br>
    <?php if(!empty($_SESSION['data']['addents'])){  ?>   
       <iframe src="viewpdf.php"></iframe>
    <?php  }  
    if(!empty($_SESSION['data']['addents'])){
     $_SESSION['data']['addents'] = shuffle_assoc($_SESSION['data']['addents']);
    }
    ?>   
    </div>
<footer class="my-5 pt-5 text-muted text-center text-small"></footer>
</body></html>

