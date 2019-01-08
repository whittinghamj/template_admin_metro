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

    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">

    <link rel="stylesheet" href="css/shamcey.css">
</head>

<body>
    <div class="sh-logopanel">
        <a href="" class="sh-logo-text"><?php echo $site['name_long']; ?></a>
        <a id="navicon" href="" class="sh-navicon d-none d-xl-block"><i class="icon ion-navicon"></i></a>
        <a id="naviconMobile" href="" class="sh-navicon d-xl-none"><i class="icon ion-navicon"></i></a>
    </div>

    <div class="sh-sideleft-menu">
        <label class="sh-sidebar-label">Navigation</label>
        <ul class="nav">
            <li class="nav-item">
                <a href="index.html" class="nav-link">
                    <i class="icon ion-ios-home-outline"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub active">
                    <i class="icon ion-ios-bookmarks-outline"></i>
                    <span>Pages</span>
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a href="blank.html" class="nav-link active">Blank Page</a></li>
                    <li class="nav-item"><a href="page-mailbox.html" class="nav-link">Mailbox</a></li>
                    <li class="nav-item"><a href="page-chat.html" class="nav-link">Chat Page</a></li>
                    <li class="nav-item"><a href="page-calendar.html" class="nav-link">Calendar</a></li>
                    <li class="nav-item"><a href="page-edit-profile.html" class="nav-link">Edit Profile</a></li>
                    <li class="nav-item"><a href="page-file-manager.html" class="nav-link">File Manager</a></li>
                    <li class="nav-item"><a href="page-invoice.html" class="nav-link">Invoice Page</a></li>
                    <li class="nav-item"><a href="page-forum-list.html" class="nav-link">Forum List Page</a></li>
                    <li class="nav-item"><a href="page-forum-topic.html" class="nav-link">Forum Topic View</a></li>
                    <li class="nav-item"><a href="page-signin.html" class="nav-link">Signin Page</a></li>
                    <li class="nav-item"><a href="page-signup.html" class="nav-link">Signup Page</a></li>
                    <li class="nav-item"><a href="page-notfound.html" class="nav-link">404 Page Not Found</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    <i class="icon ion-ios-gear-outline"></i>
                    <span>Forms</span>
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a href="form-elements.html" class="nav-link">Form Elements</a></li>
                    <li class="nav-item"><a href="form-layouts.html" class="nav-link">Form Layouts</a></li>
                    <li class="nav-item"><a href="form-validation.html" class="nav-link">Form Validation</a></li>
                    <li class="nav-item"><a href="form-wizards.html" class="nav-link">Form Wizards</a></li>
                    <li class="nav-item"><a href="form-editor-text.html" class="nav-link">Text Editor</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    <i class="icon ion-ios-filing-outline"></i>
                    <span>UI Elements</span>
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a href="accordion.html" class="nav-link">Accordion</a></li>
                    <li class="nav-item"><a href="alerts.html" class="nav-link">Alerts</a></li>
                    <li class="nav-item"><a href="buttons.html" class="nav-link">Buttons</a></li>
                    <li class="nav-item"><a href="cards.html" class="nav-link">Cards</a></li>
                    <li class="nav-item"><a href="icons.html" class="nav-link">Icons</a></li>
                    <li class="nav-item"><a href="modal.html" class="nav-link">Modal</a></li>
                    <li class="nav-item"><a href="navigation.html" class="nav-link">Navigation</a></li>
                    <li class="nav-item"><a href="pagination.html" class="nav-link">Pagination</a></li>
                    <li class="nav-item"><a href="popups.html" class="nav-link">Tooltip &amp; Popover</a></li>
                    <li class="nav-item"><a href="progress.html" class="nav-link">Progress</a></li>
                    <li class="nav-item"><a href="spinners.html" class="nav-link">Spinners</a></li>
                    <li class="nav-item"><a href="typography.html" class="nav-link">Typography</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    <i class="icon ion-ios-analytics-outline"></i>
                    <span>Charts</span>
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a href="chart-morris.html" class="nav-link">Morris Charts</a></li>
                    <li class="nav-item"><a href="chart-flot.html" class="nav-link">Flot Charts</a></li>
                    <li class="nav-item"><a href="chart-chartjs.html" class="nav-link">Chart JS</a></li>
                    <li class="nav-item"><a href="chart-rickshaw.html" class="nav-link">Rickshaw</a></li>
                    <li class="nav-item"><a href="chart-sparkline.html" class="nav-link">Sparkline</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    <i class="icon ion-ios-navigate-outline"></i>
                    <span>Maps</span>
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a href="map-google.html" class="nav-link">Google Maps</a></li>
                    <li class="nav-item"><a href="map-vector.html" class="nav-link">Vector Maps</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link with-sub">
                    <i class="icon ion-ios-list-outline"></i>
                    <span>Tables</span>
                </a>
                <ul class="nav-sub">
                    <li class="nav-item"><a href="table-basic.html" class="nav-link">Basic Table</a></li>
                    <li class="nav-item"><a href="table-datatable.html" class="nav-link">Data Table</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="sh-headpanel">
        <div class="sh-headpanel-left">

            <!-- START: HIDDEN IN MOBILE -->
            <a href="" class="sh-icon-link">
                <div>
                    <i class="icon ion-ios-folder-outline"></i>
                    <span>Directory</span>
                </div>
            </a>
            <a href="" class="sh-icon-link">
                <div>
                    <i class="icon ion-ios-calendar-outline"></i>
                    <span>Events</span>
                </div>
            </a>
            <a href="" class="sh-icon-link">
                <div>
                    <i class="icon ion-ios-gear-outline"></i>
                    <span>Settings</span>
                </div>
            </a>
            <!-- END: HIDDEN IN MOBILE -->

            <!-- START: DISPLAYED IN MOBILE ONLY -->
            <div class="dropdown dropdown-app-list">
                <a href="" data-toggle="dropdown" class="dropdown-link">
                    <i class="icon ion-ios-keypad tx-18"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="row no-gutters">
                        <div class="col-4">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="icon ion-ios-folder-outline"></i>
                                    <span>Directory</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="icon ion-ios-calendar-outline"></i>
                                    <span>Events</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="" class="dropdown-menu-link">
                                <div>
                                    <i class="icon ion-ios-gear-outline"></i>
                                    <span>Settings</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sh-mainpanel">
        <div class="sh-breadcrumb">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="index.html">Shamcey</a>
                <a class="breadcrumb-item" href="index.html">Pages</a>
                <span class="breadcrumb-item active">Blank</span>
            </nav>
        </div>
        <!-- sh-breadcrumb -->
        <div class="sh-pagetitle">
            <div class="input-group">
                <input type="search" class="form-control" placeholder="Search">
                <span class="input-group-btn">
            <button class="btn"><i class="fa fa-search"></i></button>
          </span>
                <!-- input-group-btn -->
            </div>
            <!-- input-group -->
            <div class="sh-pagetitle-left">
                <div class="sh-pagetitle-icon"><i class="icon ion-ios-bookmarks mg-t-3"></i></div>
                <div class="sh-pagetitle-title">
                    <span>Hello World!</span>
                    <h2>Blank Page</h2>
                </div>
                <!-- sh-pagetitle-left-title -->
            </div>
            <!-- sh-pagetitle-left -->
        </div>
        <!-- sh-pagetitle -->

        <div class="sh-pagebody">
            <!-- content goes here -->
        </div>
        <!-- sh-pagebody -->
    </div>
    <!-- sh-mainpanel -->

    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <script src="js/shamcey.js"></script>
</body>

</html>