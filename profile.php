<?php
	session_start(); //session start

	//fetch records
    require_once "db.php";
    require_once "models/registerModel.php";
    require_once "views/registerView.php";

    $model = new registerModel(MY_DSN, MY_USER, MY_PASS); //model
    $view = new registerView(); //view

    $view->show('header', array(), 'Your Profile'); //show header
    
    $page = 'profile';
    $user = null;

	if ( !empty($_SESSION['userInfo']) ) {
        $user = $_SESSION['userInfo'];
        $page = 'profile';
    } //check for active session

    if ( isset( $_POST['submit']) ) {
    	$salt = MD5(date("h:m:s", time()));
        $username = $_POST['username'];//user data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //addUser
        $model->addUser($username, $first_name, $last_name, $email, $password, $salt);
    }
    
	$view->show($page, $user); //route to ACTIVE PAGE
    $view->show('footer'); //footer
?>