<?php
	session_start(); //session start

	//fetch records
    require_once "db.php";
    require_once "models/registerModel.php";
    require_once "views/registerView.php";

    $model = new registerModel(MY_DSN, MY_USER, MY_PASS); //model
    $view = new registerView(); //view

    $view->show('header', array(), 'Sign Up'); //header

    $page = 'register';
    $user = null;
    
    if ( isset( $_POST['submit']) ) {
    	$salt = MD5(date("h:m:s", time()));
        $username = $_POST['username']; //user data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //addUser
        $model->addUser($username, $first_name, $last_name, $email, $password, $salt);
    }
    
	if ( !empty($_SESSION['member']) ) {
        $user = $_SESSION['member'];
        $page = 'settings';
    } //check for active session
    
	$view->show($page, $user); //route to ACTIVE PAGE
    $view->show('footer'); //footer
?>