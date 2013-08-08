<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="author" content="Kyle Leslie, Ryan Clark" />
    <meta name="description" content="" />
    <meta name="keywords" content="ActionScript, Development, Programming, Flash, Adobe, " />
    <meta charset="utf-8" />
    <title><?php echo $title; ?> :: SwiftIDE :: Online ActionScript Development Environment</title>
    <link href="css/base.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="wrapper">
        <header>
            <h1><a href="index.php"><img src="media/images/logo384.png" alt="" width="384" height="90" /></a></h1>

            <nav>
                <ul>
                    <li><a href="explore.html">Explore</a></li>
                    <li><a href="features.html">Features</a></li>
                    <li><a href="support.html">Support</a></li>
                    <?php
                        if( empty($_SESSION['member']) ) {
                            echo '<li class="button-nav"><a href="register.php">Sign Up</a></li>';
                        } else {
                            echo '<li class="button-nav"><a href="signout.php">Sign Out</a></li>';
                        }
                    ?>
                </ul>
            </nav>
        </header>

        <div id="content">