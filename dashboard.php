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

// check is account->id is set, if not then assume user is not logged in correctly and redirect to login page
if(empty($_SESSION['account']['id'])){
  status_message('danger', 'Login Session Timeout');
  go($site['url'].'/index?c=session_timeout');
}

// get account details for logged in user
$account_details = account_details($_SESSION['account']['id']);

if($_GET['dev'] == 'yes'){
    debug($account_details);
}

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

    <title><?php echo $site['title']; ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Color CSS -->
    <link rel="stylesheet" href="css/themes.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/whatsapp-icon.png?v=1" />

    <!-- Apple devices Homescreen icon -->
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
</head>

<body>
    <div id="navigation">
        <div class="container-fluid">
            <a href="#" id="brand"><?php echo $site['name_long']; ?></a>
            <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
                <i class="fa fa-bars"></i>
            </a>
            <ul class='main-nav'>
                <li>
                    <a href="index.html">
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
            <div class="user">
                <div class="dropdown">
                    <a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $account_details['firstname'].' '.$account_details['lastname']; ?>
                        <img src="img/default-avatar.png" height="27px" alt="User Avatar">
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?php echo $site['url']; ?>/dashboard?c=profile">Edit profile</a>
                        </li>
                        <li>
                            <a href="<?php echo $site['url']; ?>/dashboard?c=settings">Account settings</a>
                        </li>
                        <li>
                            <a href="<?php echo $site['url']; ?>/logout">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="content">
        <div id="left">
            <div class="subnav">
                <ul class="subnav-menu">
                    <li class="active">
                        <a href="<?php echo $site['url']; ?>/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo $site['url']; ?>/dashboard">Sender Numbers</a>
                    </li>
                    <li>
                        <a href="<?php echo $site['url']; ?>/dashboard">Campaigns</a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="main">
            <div class="container-fluid">
                <div class="page-header">
                    
                </div>

                <div class="breadcrumbs">
                    <ul>
                        <li>
                            <a href="<?php echo $site['url']; ?>/dashboard">Dashboard</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo $site['url']; ?>/dashboard?c=dev">Dev Section</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo $site['url']; ?>/dashboard?c=template">Master Template</a>
                        </li>
                    </ul>
                    <div class="close-bread">
                        <a href="#">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-title">
                                <h3>
                                    <i class="fa fa-bars"></i>
                                    Sample Header
                                </h3>
                            </div>
                            <div class="box-content">
                                <div class="box-content nopadding">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-content">
                                                <div class="left">
                                                    <div class="icon">
                                                        <i class="fa fa-picture-o"></i>
                                                    </div>
                                                    <div class="date">25. Apr</div>
                                                </div>
                                                <div class="activity">
                                                    <div class="user">
                                                        <a href="#">John Doe</a>
                                                        <span>uploaded 12 new photos</span>
                                                    </div>
                                                    <ul class="timeline-images">
                                                        <li>
                                                            <a href="#">
                                                                <img src="img/demo/1.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="img/demo/2.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="img/demo/3.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="img/demo/4.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="img/demo/5.jpg" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                        </li>
                                        <li>
                                            <div class="timeline-content">
                                                <div class="left">
                                                    <div class="icon green">
                                                        <i class="fa fa-comment"></i>
                                                    </div>
                                                    <div class="date">18. Apr</div>
                                                </div>
                                                <div class="activity">
                                                    <div class="user">
                                                        <a href="#">John Doe</a>
                                                        <span>added a new comment</span>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum Fugiat magna velit consectetur qui in veniam cillum exercitation Ut occaecat Duis mollit. Lorem ipsum Dolore dolor Excepteur sunt amet officia officia sunt aliquip id occaecat officia.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                        </li>
                                        <li>
                                            <div class="timeline-content">
                                                <div class="left">
                                                    <div class="icon lightred">
                                                        <i class="fa fa-camera"></i>
                                                    </div>
                                                    <div class="date">17. Apr</div>
                                                </div>
                                                <div class="activity">
                                                    <div class="user">
                                                        <a href="#">Jane Doe</a>
                                                        <span>shared a video</span>
                                                    </div>
                                                    <p>
                                                        <iframe width="640" height="390" src="http://www.youtube.com/embed/cvHxdn9OoX0" frameborder="0" allowfullscreen style="max-width:100%;"></iframe>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                        </li>
                                        <li>
                                            <div class="timeline-content">
                                                <div class="left">
                                                    <div class="icon orange">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                    <div class="date">15. Apr</div>
                                                </div>
                                                <div class="activity">
                                                    <div class="user">
                                                        <a href="#">Jane Doe</a>
                                                        <span>added a new article</span>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum Ad ullamco elit reprehenderit veniam aute minim dolore ullamco incididunt ea do. Lorem ipsum Reprehenderit do consectetur dolore do fugiat proident incididunt consequat minim ullamco. Lorem ipsum Proident laboris dolore in aliqua ut magna
                                                        minim irure ut proident. Lorem ipsum Anim dolore incididunt aliquip do irure aute reprehenderit reprehenderit enim ut. Lorem ipsum Reprehenderit commodo anim laboris ex cupidatat dolor deserunt dolore exercitation Ut et culpa.
                                                    </p>
                                                    <p>Lorem ipsum Sit aliqua eu dolore laboris non consectetur sit qui laboris adipisicing nisi exercitation. Lorem ipsum Incididunt minim irure sit cillum in consequat voluptate est labore enim ut. Lorem ipsum Duis officia proident Ut cillum occaecat
                                                        magna ad ad incididunt. Lorem ipsum Ullamco eiusmod aute sed id eiusmod in est id do deserunt quis. Lorem ipsum Quis proident Excepteur tempor commodo consectetur dolor ex cillum proident id. Lorem ipsum Veniam esse laborum ut in id officia
                                                        velit voluptate aliquip deserunt.</p>
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <p>
            <?php echo $site['title']; ?> &copy;
            <span class="font-grey-4">|</span>
            <a href="https://genexnetworks.net/">Written by Genex Networks LLC</a>
        </p>
        <a href="#" class="gototop">
            <i class="fa fa-arrow-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Nice Scroll -->
    <script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>

    <!-- imagesLoaded -->
    <script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>

    <!-- slimScroll -->
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootbox -->
    <script src="js/plugins/bootbox/jquery.bootbox.js"></script>

    <!-- Bootbox -->
    <script src="js/plugins/form/jquery.form.min.js"></script>

    <!-- Validation -->
    <script src="js/plugins/validation/jquery.validate.min.js"></script>
    <script src="js/plugins/validation/additional-methods.min.js"></script>

    <!-- Theme framework -->
    <script src="js/eakroko.min.js"></script>

    <!-- Theme scripts -->
    <script src="js/application.min.js"></script>

    <!-- Just for demonstration -->
    <script src="js/demonstration.min.js"></script>

    <!--[if lte IE 9]>
        <script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input, textarea').placeholder();
            });
        </script>
    <![endif]-->
</body>

</html>
