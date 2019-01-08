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
                        <!--
                            <li>
                                <a href="<?php echo $site['url']; ?>/dashboard?c=settings">Account settings</a>
                            </li>
                        -->
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
                    <?php if(empty($_GET['c']) || $_GET['c'] == '' || $_GET['c'] == 'home'){ ?>
                        <li class="active">
                    <?php }else{ ?>
                        <li>
                    <?php } ?>
                        <a href="<?php echo $site['url']; ?>/dashboard">Dashboard</a>
                    </li>
                    
                    <?php if($_GET['c'] == 'sender_numbers'){ ?>
                        <li class="active">
                    <?php }else{ ?>
                        <li>
                    <?php } ?>
                        <a href="<?php echo $site['url']; ?>/dashboard?c=sender_numbers">Sender Numbers</a>
                    </li>

                    <?php if($_GET['c'] == 'campaigns'){ ?>
                        <li class="active">
                    <?php }else{ ?>
                        <li>
                    <?php } ?>
                        <a href="<?php echo $site['url']; ?>/dashboard?c=campaigns">Campaigns</a>
                    </li>
                </ul>
            </div>
        </div>

        <?php
            $c = $_GET['c'];
            switch ($c){
                // test
                case "test":
                    test();
                    break;

                // profile
                case "profile":
                    profile();
                    break;

                // sender_numbers
                case "sender_numbers":
                    sender_numbers();
                    break;

                // campaigns
                case "campaigns":
                    campaigns();
                    break;
                    
                // home
                default:
                    home();
                    break;
            }
        ?>

        <?php function home(){ ?>
            <?php global $account_details; ?>
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <!-- <i class="fa fa-user"></i> -->
                                        Sample Title
                                    </h3>
                                </div>
                                <div class="box-content">
                                    Sample Content
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php function test(){ ?>
            <?php global $account_details; ?>
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <!-- <i class="fa fa-user"></i> -->
                                        Test Title
                                    </h3>
                                </div>
                                <div class="box-content">
                                    Test Content
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php function profile(){ ?>
            <?php global $account_details; ?>
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <!-- <i class="fa fa-user"></i> -->
                                        Edit Profile
                                    </h3>
                                </div>
                                <div class="box-content">
                                    Profile Content
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php function campaigns(){ ?>
            <?php global $account_details; ?>
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <!-- <i class="fa fa-user"></i> -->
                                        Campaigns
                                    </h3>
                                </div>
                                <div class="box-content">
                                    Campaign Content
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php function sender_numbers(){ ?>
            <?php global $account_details; ?>
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <!-- <i class="fa fa-user"></i> -->
                                        Sender Numbers
                                    </h3>
                                </div>
                                <div class="box-content">
                                    <table class="table table-hover table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Rendering engine</th>
                                                <th>Browser</th>
                                                <th class='hidden-350'>Platform(s)</th>
                                                <th class='hidden-1024'>Engine version</th>
                                                <th class='hidden-480'>CSS grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Trident</td>
                                                <td>
                                                    Internet Explorer 4.0
                                                </td>
                                                <td class='hidden-350'>Win 95+</td>
                                                <td class='hidden-1024'>4</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Presto</td>
                                                <td>Nokia N800</td>
                                                <td class='hidden-350'>N800</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>A</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>NetFront 3.4</td>
                                                <td class='hidden-350'>Embedded devices</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>A</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>Dillo 0.8</td>
                                                <td class='hidden-350'>Embedded devices</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>Links</td>
                                                <td class='hidden-350'>Text only</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>Lynx</td>
                                                <td class='hidden-350'>Text only</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>IE Mobile</td>
                                                <td class='hidden-350'>Windows Mobile 6</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>C</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>PSP browser</td>
                                                <td class='hidden-350'>PSP</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>C</td>
                                            </tr>
                                            <tr>
                                                <td>Other browsers</td>
                                                <td>All others</td>
                                                <td class='hidden-350'>-</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>U</td>
                                            </tr>
                                            <tr>
                                                <td>Trident</td>
                                                <td>
                                                    Internet Explorer 4.0
                                                </td>
                                                <td class='hidden-350'>Win 95+</td>
                                                <td class='hidden-1024'>4</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Presto</td>
                                                <td>Nokia N800</td>
                                                <td class='hidden-350'>N800</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>A</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>NetFront 3.4</td>
                                                <td class='hidden-350'>Embedded devices</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>A</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>Dillo 0.8</td>
                                                <td class='hidden-350'>Embedded devices</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>Links</td>
                                                <td class='hidden-350'>Text only</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>Lynx</td>
                                                <td class='hidden-350'>Text only</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>X</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>IE Mobile</td>
                                                <td class='hidden-350'>Windows Mobile 6</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>C</td>
                                            </tr>
                                            <tr>
                                                <td>Misc</td>
                                                <td>PSP browser</td>
                                                <td class='hidden-350'>PSP</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>C</td>
                                            </tr>
                                            <tr>
                                                <td>Other browsers</td>
                                                <td>All others</td>
                                                <td class='hidden-350'>-</td>
                                                <td class='hidden-1024'>-</td>
                                                <td class='hidden-480'>U</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

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

    <!-- dataTables -->
    <script src="js/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="js/plugins/datatable/TableTools.min.js"></script>
    <script src="js/plugins/datatable/ColReorder.min.js"></script>
    <script src="js/plugins/datatable/ColVis.min.js"></script>
    <script src="js/plugins/datatable/FixedColumns.min.js"></script>
    <script src="js/plugins/datatable/dataTables.scroller.min.js"></script>

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
