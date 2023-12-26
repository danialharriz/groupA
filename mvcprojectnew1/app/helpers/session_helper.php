<?php
ob_start();
// sent a request to php
session_start();

function isLoggedIn(){
    if (isset($_SESSION['user_id'])){
        return true;
    }else {
        return false;
    }
}


function notLoggedIn(){

    if (empty($_SESSION['user_id'])){
        header('location:' . URLROOT . '/users/login');
    }
}


?>