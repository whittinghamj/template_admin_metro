<?php

if($_GET['dev'] == 'yes'){
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL);
}

include("inc/db.php");
include("inc/global_vars.php");
include("inc/sessions.php");

$sess = new SessionManager();
session_start();

include("inc/functions.php");

// start timer for page loaded var
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <!--
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Shamcey">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/shamcey/img/shamcey-social.png">
    -->

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/shamcey">
    <meta property="og:title" content="Shamcey">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="<?php echo $site['url'].'/img/whatsapp-icon.png'; ?>">
    <meta property="og:image:secure_url" content="<?php echo $site['url'].'/img/whatsapp-icon.png'; ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Reach 1.5B Potential Customers Today!">
    <meta name="author" content="Genex Networks LLC">

    <title>
        <?php echo $site['title']; ?>
    </title>

    <!-- Vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Shamcey CSS -->
    <link rel="stylesheet" href="css/shamcey.css">
</head>

<body class="bg-gray-900">
    <div class="signpanel-wrapper">
        <div class="signbox">
            <div class="signbox-header">
                <h2><?php echo $site['title']; ?></h2>
                <p class="mg-b-0">Reaching 1.5B Potential Customers</p>
            </div>
            <!-- signbox-header -->
            <div class="signbox-body">
                <form name="login" action="login.php" method="post">
                    <?php if(isset($_SESSION['alert']['status'])){ ?>
                        <center>
                            <strong>
                                <font color="red">
                                    <?php echo $_SESSION['alert']['message']; ?>
                                </font>
                            </strong>
                        </center>
                        <hr>
                    <?php } ?>
                    <div class="form-group">
                        <label class="form-control-label">Email:</label>
                        <input type="email" name="email" placeholder="Enter your email" class="form-control">
                    </div>
                    <!-- form-group -->
                    <div class="form-group">
                        <label class="form-control-label">Password:</label>
                        <input type="password" name="password" placeholder="Enter your password" class="form-control">
                    </div>
                    <!-- form-group -->
                    <div class="form-group">
                        <!-- <a href="">Forgot password?</a> -->
                    </div>
                    <!-- form-group -->
                    <button class="btn btn-success btn-block">Sign In</button>
                    <div class="tx-center bg-white bd pd-10 mg-t-40">Not yet a member? <a href="page-signup.html">Create an account</a></div>
                </form>
            </div>
            <!-- signbox-body -->
        </div>
        <!-- signbox -->
    </div>
    <!-- signpanel-wrapper -->

    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>

    <script src="js/shamcey.js"></script>
</body>

</html>
