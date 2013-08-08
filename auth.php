<?php
    session_start();

    //fetch records
    require_once "db.php";
    require_once "models/authModel.php";
    require_once "views/authView.php";

    $model = new authModel(MY_DSN, MY_USER, MY_PASS); //model
    $view = new authView(); //view

    $username = empty($_POST['username']) ? '' : strtolower(trim($_POST['username']));
    $password = empty($_POST['password']) ? '' : trim($_POST['password']);

    $view->show('header', array(), 'Sign In'); //header
    
    $page = 'auth';
    $user = null;

    if( !empty($_SESSION['member']) ) {
        $user = $_SESSION['member'];
        $page = 'settings';
    } //check for active session


    if( !empty($username) && !empty($password) ) {
        $user = $model->getUser($username, $password);

        if ( is_array($user) ) {
            $_SESSION['member'] = $user;
            $page = 'settings';
        }
    }

    $view->show($page, $user); //route to ACTIVE PAGE
    $view->show('footer'); //footer
?>