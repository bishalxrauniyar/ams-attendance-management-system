<?php
session_start();
$conn=require_once('database.php'); 
require_once('authentication.php');

//location=where to send
//key=
function forward($location,$svariable=[]){ 
    $i=1;
     $message='';
    foreach($svariable as $key => $value){
        if($i==1){
        
            $message.="?".$key."=".$value;
        }else{

            $message.="&".$key."=".$value;
        }
        $i++;
        
    }

    header("location: ".$location.$message);
}

function test_input($index,$location,$method =  'POST', $extradata =[] ) {


    if($location=='SAME'){
                die('');
    }

    switch($method){
        case 'POST':
            $method = &$_POST;
            break;
        
        case 'GET':
            $method = &$_GET;
            break;

        case 'REQUEST':
            $method = &$_REQUEST;
        break;

        default :

        die('ERROR CASE IN TEST INPUT');
    }

    if(!isset($method[$index])){
        forward($location,array_merge($extradata,['error'=>$index.' not set']));
    }
    if(empty($method[$index])){
        forward($location,array_merge($extradata,['error'=>$index.' not set']));
    }
    $method[$index] = trim($method[$index]);
    $method[$index] = stripslashes($method[$index]);
    $method[$index] = htmlspecialchars($method[$index]);
    return $method[$index];
  }
?>