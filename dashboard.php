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
                            <a href="<?php echo $site['url']; ?>/dashboard?c=profile">Edit Profile</a>
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
                            <div id="status_message"></div>

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
                            <div id="status_message"></div>

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
                            <div id="status_message"></div>

                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <!-- <i class="fa fa-user"></i> -->
                                        Edit Profile
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <ul class="tabs tabs-inline tabs-top">
                                    <li class='active'>
                                        <a href="#profile" data-toggle='tab'>
                                            <i class="fa fa-user"></i>Profile</a>
                                    </li>
                                    <li>
                                        <a href="#notifications" data-toggle='tab'>
                                            <i class="fa fa-bullhorn"></i>Notifications</a>
                                    </li>
                                    <li>
                                        <a href="#security" data-toggle='tab'>
                                            <i class="fa fa-lock"></i>Security</a>
                                    </li>
                                </ul>
                                <div class="tab-content padding tab-content-inline tab-content-bottom">
                                    <div class="tab-pane active" id="profile">
                                        <form action="#" class="form-horizontal">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 84px; height: 84px;">
                                                            <img src="img/demo/user-1.jpg" alt="">
                                                        </div>
                                                        <div>
                                                            <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="...">
                                                            </span>
                                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label col-sm-2 right">Name:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" class='form-control' value="John Doe">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country" class="control-label col-sm-2 right">Country:</label>
                                                        <div class="col-sm-10">
                                                            <select name="s2" id="simg" class='select2-me' style="width:250px;">
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                                <option value="AQ">Antarctica</option>
                                                                <option value="AR">Argentina</option>
                                                                <option value="AM">Armenia</option>
                                                                <option value="AW">Aruba</option>
                                                                <option value="AU">Australia</option>
                                                                <option value="AT">Austria</option>
                                                                <option value="AZ">Azerbaijan</option>
                                                                <option value="BS">Bahamas</option>
                                                                <option value="BH">Bahrain</option>
                                                                <option value="BD">Bangladesh</option>
                                                                <option value="BB">Barbados</option>
                                                                <option value="BY">Belarus</option>
                                                                <option value="BE">Belgium</option>
                                                                <option value="BZ">Belize</option>
                                                                <option value="BJ">Benin</option>
                                                                <option value="BM">Bermuda</option>
                                                                <option value="BT">Bhutan</option>
                                                                <option value="BO">Bolivia</option>
                                                                <option value="BA">Bosnia and Herzegowina</option>
                                                                <option value="BW">Botswana</option>
                                                                <option value="BV">Bouvet Island</option>
                                                                <option value="BR">Brazil</option>
                                                                <option value="IO">British Indian Ocean Territory</option>
                                                                <option value="BN">Brunei Darussalam</option>
                                                                <option value="BG">Bulgaria</option>
                                                                <option value="BF">Burkina Faso</option>
                                                                <option value="BI">Burundi</option>
                                                                <option value="KH">Cambodia</option>
                                                                <option value="CM">Cameroon</option>
                                                                <option value="CA">Canada</option>
                                                                <option value="CV">Cape Verde</option>
                                                                <option value="KY">Cayman Islands</option>
                                                                <option value="CF">Central African Republic</option>
                                                                <option value="TD">Chad</option>
                                                                <option value="CL">Chile</option>
                                                                <option value="CN">China</option>
                                                                <option value="CX">Christmas Island</option>
                                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                                <option value="CO">Colombia</option>
                                                                <option value="KM">Comoros</option>
                                                                <option value="CG">Congo</option>
                                                                <option value="CD">Congo, the Democratic Republic of the</option>
                                                                <option value="CK">Cook Islands</option>
                                                                <option value="CR">Costa Rica</option>
                                                                <option value="CI">Cote d'Ivoire</option>
                                                                <option value="HR">Croatia (Hrvatska)</option>
                                                                <option value="CU">Cuba</option>
                                                                <option value="CY">Cyprus</option>
                                                                <option value="CZ">Czech Republic</option>
                                                                <option value="DK">Denmark</option>
                                                                <option value="DJ">Djibouti</option>
                                                                <option value="DM">Dominica</option>
                                                                <option value="DO">Dominican Republic</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="EG">Egypt</option>
                                                                <option value="SV">El Salvador</option>
                                                                <option value="GQ">Equatorial Guinea</option>
                                                                <option value="ER">Eritrea</option>
                                                                <option value="EE">Estonia</option>
                                                                <option value="ET">Ethiopia</option>
                                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                                <option value="FO">Faroe Islands</option>
                                                                <option value="FJ">Fiji</option>
                                                                <option value="FI">Finland</option>
                                                                <option value="FR">France</option>
                                                                <option value="GF">French Guiana</option>
                                                                <option value="PF">French Polynesia</option>
                                                                <option value="TF">French Southern Territories</option>
                                                                <option value="GA">Gabon</option>
                                                                <option value="GM">Gambia</option>
                                                                <option value="GE">Georgia</option>
                                                                <option value="DE" selected="selected">Germany</option>
                                                                <option value="GH">Ghana</option>
                                                                <option value="GI">Gibraltar</option>
                                                                <option value="GR">Greece</option>
                                                                <option value="GL">Greenland</option>
                                                                <option value="GD">Grenada</option>
                                                                <option value="GP">Guadeloupe</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="GT">Guatemala</option>
                                                                <option value="GN">Guinea</option>
                                                                <option value="GW">Guinea-Bissau</option>
                                                                <option value="GY">Guyana</option>
                                                                <option value="HT">Haiti</option>
                                                                <option value="HM">Heard and Mc Donald Islands</option>
                                                                <option value="VA">Holy See (Vatican City State)</option>
                                                                <option value="HN">Honduras</option>
                                                                <option value="HK">Hong Kong</option>
                                                                <option value="HU">Hungary</option>
                                                                <option value="IS">Iceland</option>
                                                                <option value="IN">India</option>
                                                                <option value="ID">Indonesia</option>
                                                                <option value="IR">Iran (Islamic Republic of)</option>
                                                                <option value="IQ">Iraq</option>
                                                                <option value="IE">Ireland</option>
                                                                <option value="IL">Israel</option>
                                                                <option value="IT">Italy</option>
                                                                <option value="JM">Jamaica</option>
                                                                <option value="JP">Japan</option>
                                                                <option value="JO">Jordan</option>
                                                                <option value="KZ">Kazakhstan</option>
                                                                <option value="KE">Kenya</option>
                                                                <option value="KI">Kiribati</option>
                                                                <option value="KP">Korea, Democratic People's Republic of</option>
                                                                <option value="KR">Korea, Republic of</option>
                                                                <option value="KW">Kuwait</option>
                                                                <option value="KG">Kyrgyzstan</option>
                                                                <option value="LA">Lao People's Democratic Republic</option>
                                                                <option value="LV">Latvia</option>
                                                                <option value="LB">Lebanon</option>
                                                                <option value="LS">Lesotho</option>
                                                                <option value="LR">Liberia</option>
                                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lithuania</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MO">Macau</option>
                                                                <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                                                <option value="MG">Madagascar</option>
                                                                <option value="MW">Malawi</option>
                                                                <option value="MY">Malaysia</option>
                                                                <option value="MV">Maldives</option>
                                                                <option value="ML">Mali</option>
                                                                <option value="MT">Malta</option>
                                                                <option value="MH">Marshall Islands</option>
                                                                <option value="MQ">Martinique</option>
                                                                <option value="MR">Mauritania</option>
                                                                <option value="MU">Mauritius</option>
                                                                <option value="YT">Mayotte</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="FM">Micronesia, Federated States of</option>
                                                                <option value="MD">Moldova, Republic of</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="MN">Mongolia</option>
                                                                <option value="MS">Montserrat</option>
                                                                <option value="MA">Morocco</option>
                                                                <option value="MZ">Mozambique</option>
                                                                <option value="MM">Myanmar</option>
                                                                <option value="NA">Namibia</option>
                                                                <option value="NR">Nauru</option>
                                                                <option value="NP">Nepal</option>
                                                                <option value="NL">Netherlands</option>
                                                                <option value="AN">Netherlands Antilles</option>
                                                                <option value="NC">New Caledonia</option>
                                                                <option value="NZ">New Zealand</option>
                                                                <option value="NI">Nicaragua</option>
                                                                <option value="NE">Niger</option>
                                                                <option value="NG">Nigeria</option>
                                                                <option value="NU">Niue</option>
                                                                <option value="NF">Norfolk Island</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="NO">Norway</option>
                                                                <option value="OM">Oman</option>
                                                                <option value="PK">Pakistan</option>
                                                                <option value="PW">Palau</option>
                                                                <option value="PA">Panama</option>
                                                                <option value="PG">Papua New Guinea</option>
                                                                <option value="PY">Paraguay</option>
                                                                <option value="PE">Peru</option>
                                                                <option value="PH">Philippines</option>
                                                                <option value="PN">Pitcairn</option>
                                                                <option value="PL">Poland</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="QA">Qatar</option>
                                                                <option value="RE">Reunion</option>
                                                                <option value="RO">Romania</option>
                                                                <option value="RU">Russian Federation</option>
                                                                <option value="RW">Rwanda</option>
                                                                <option value="KN">Saint Kitts and Nevis</option>
                                                                <option value="LC">Saint LUCIA</option>
                                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                                <option value="WS">Samoa</option>
                                                                <option value="SM">San Marino</option>
                                                                <option value="ST">Sao Tome and Principe</option>
                                                                <option value="SA">Saudi Arabia</option>
                                                                <option value="SN">Senegal</option>
                                                                <option value="SC">Seychelles</option>
                                                                <option value="SL">Sierra Leone</option>
                                                                <option value="SG">Singapore</option>
                                                                <option value="SK">Slovakia (Slovak Republic)</option>
                                                                <option value="SI">Slovenia</option>
                                                                <option value="SB">Solomon Islands</option>
                                                                <option value="SO">Somalia</option>
                                                                <option value="ZA">South Africa</option>
                                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                                <option value="ES">Spain</option>
                                                                <option value="LK">Sri Lanka</option>
                                                                <option value="SH">St. Helena</option>
                                                                <option value="PM">St. Pierre and Miquelon</option>
                                                                <option value="SD">Sudan</option>
                                                                <option value="SR">Suriname</option>
                                                                <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                                                <option value="SZ">Swaziland</option>
                                                                <option value="SE">Sweden</option>
                                                                <option value="CH">Switzerland</option>
                                                                <option value="SY">Syrian Arab Republic</option>
                                                                <option value="TW">Taiwan, Province of China</option>
                                                                <option value="TJ">Tajikistan</option>
                                                                <option value="TZ">Tanzania, United Republic of</option>
                                                                <option value="TH">Thailand</option>
                                                                <option value="TG">Togo</option>
                                                                <option value="TK">Tokelau</option>
                                                                <option value="TO">Tonga</option>
                                                                <option value="TT">Trinidad and Tobago</option>
                                                                <option value="TN">Tunisia</option>
                                                                <option value="TR">Turkey</option>
                                                                <option value="TM">Turkmenistan</option>
                                                                <option value="TC">Turks and Caicos Islands</option>
                                                                <option value="TV">Tuvalu</option>
                                                                <option value="UG">Uganda</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="AE">United Arab Emirates</option>
                                                                <option value="GB">United Kingdom</option>
                                                                <option value="US">United States</option>
                                                                <option value="UM">United States Minor Outlying Islands</option>
                                                                <option value="UY">Uruguay</option>
                                                                <option value="UZ">Uzbekistan</option>
                                                                <option value="VU">Vanuatu</option>
                                                                <option value="VE">Venezuela</option>
                                                                <option value="VN">Viet Nam</option>
                                                                <option value="VG">Virgin Islands (British)</option>
                                                                <option value="VI">Virgin Islands (U.S.)</option>
                                                                <option value="WF">Wallis and Futuna Islands</option>
                                                                <option value="EH">Western Sahara</option>
                                                                <option value="YE">Yemen</option>
                                                                <option value="ZM">Zambia</option>
                                                                <option value="ZW">Zimbabwe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="control-label col-sm-2 right">Skills:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="textfield" id="textfield" class="tagsinput" value="PHP,Laravel,Java">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="control-label col-sm-2 right">Email:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="email" class='form-control' value="j.doe@johndoeemail.com">
                                                            <div class="form-button">
                                                                <a href="#" class="btn btn-grey-4 change-input">Change</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pw" class="control-label col-sm-2 right">Password:</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" name="pw" class='form-control' value="********">
                                                            <div class="form-button">
                                                                <a href="#" class="btn btn-grey-4 change-input">Change</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <input type="submit" class='btn btn-primary' value="Save">
                                                        <input type="reset" class='btn' value="Discard changes">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="notifications">
                                        <form action="#" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="asdf" class="control-label col-sm-2">Email notifications</label>
                                                <div class="col-sm-10">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="asdf">Send me security emails</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="asdf">Send system emails</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="asdf">Lorem ipsum dolor</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="asdf">Minim veli</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asdf" class="control-label col-sm-2">Email for notifications</label>
                                                <div class="col-sm-10">
                                                    <select name="email" id="email">
                                                        <option value="1">asdf@blasdas.com</option>
                                                        <option value="2">johnDoe@asdasf.de</option>
                                                        <option value="3">janeDoe@janejanejane.net</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <input type="submit" class='btn btn-primary' value="Save">
                                                <input type="reset" class='btn' value="Discard changes">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="security">
                                        <form action="#" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="asdf" class="control-label col-sm-2">Disable account for</label>
                                                <div class="col-sm-10">
                                                    <select name="email" id="email">
                                                        <option value="1">1 week</option>
                                                        <option value="2">2 weeks</option>
                                                        <option value="3">3 weeks</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asdf" class="control-label col-sm-2">Lock account?</label>
                                                <div class="col-sm-10">
                                                    <a href="more-locked.html" class="btn btn-danger">Lock account now</a>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <input type="submit" class='btn btn-primary' value="Save">
                                                <input type="reset" class='btn' value="Discard changes">
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                            <div id="status_message"></div>

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
                                                <th>Number</th>
                                                <th>Name</th>
                                                <th class='hidden-350'>Status</th>
                                                <th class='hidden-350'>Engine version</th>
                                                <th class='hidden-350'>CSS grade</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1-384-555-0382</td>
                                                <td>US Number</td>
                                                <td class='hidden-350'>Win 95+</td>
                                                <td class='hidden-350'>4</td>
                                                <td class='hidden-350'>X</td>
                                                <td>Edit</td>
                                            </tr>
                                            <tr>
                                                <td>07399973949</td>
                                                <td>UK Number</td>
                                                <td class='hidden-350'>N800</td>
                                                <td class='hidden-350'>-</td>
                                                <td class='hidden-350'>A</td>
                                                <td>Edit</td>
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

        <?php function campaigns(){ ?>
            <?php global $account_details; ?>
            <div id="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="status_message"></div>

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

    <?php if(!empty($_SESSION['alert']['status'])){ ?>
        <script>
            document.getElementById('status_message').innerHTML = '<div class="col-sm-12"><div class="alert alert-<?php echo $_SESSION['alert']['status']; ?> alert-nomargin"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_SESSION['alert']['message']; ?></div></div>';
            setTimeout(function() {
                $('#status_message').fadeOut('fast');
            }, 5000);
        </script>
        <?php unset($_SESSION['alert']); ?>
    <?php } ?>
</body>

</html>
