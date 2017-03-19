 <?php
  // require("libraries/function.php");
  // require("libraries/connect.php");

  // //header("Content-Type: text/html;charset=UTF-8");
  // mysqli_query("SET NAMES 'utf8'");

  // error_reporting(0);
  // if (session_status() == PHP_SESSION_NONE) {session_start(); }
  // $GLOBAL_UID   = $_SESSION['MY_UID'];
  // $GLOBAL_NAME  = $_SESSION['MY_NAME'];
  // $GLOBAL_EMAIL = $_SESSION['MY_EMAIL'];
  // $GLOBAL_PWD   = $_SESSION['MY_PWD'];
  // $GLOBAL_MOBILE= $_SESSION['MY_MOBILE'];

  // error_reporting(1);
?>

<?php //include("header.php"); ?>
<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                        <img src="../../GHT/image/goverment.png"  style="width:120px;height:100%;">

             </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">





                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <li class='active' style='float:right;'>
                            <?php 
                                if($_SESSION['UID']==true)
                                { 

//var_dump($_SESSION['UName']);die;

                                    echo $_SESSION['UName'];
                                    // echo '<a href="logout.php"><span>Logout</span></a></li>';
                                }
                                elseif($_SESSION['UID']==false)
                                {
                                  echo 'Not logged in';
                                }
                            ?> 
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <br>
            <br>


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="preference_setup.php"><i class="fa fa-bar-chart-o fa-fw"></i>Preference Setup</a>

                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> General Setup<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                 <li>
                                <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='country'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Country
                                        </button>
                                    </form>
                                </a>
                                </li>

                                 <li>
                                <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='embassy'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Embassy Contact
                                        </button>
                                    </form>
                                </a>
                                </li>

                                <li>
                                <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='location_type'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Place Type
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='location'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Location
                                        </button>
                                    </form>
                                    </a>
                                </li>



                                 <li>
                                 <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='route'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left; text-decoration: blink;">Route
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                 <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='weather_station'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left; text-decoration: blink;">Weather Station
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='incident_type'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Incident Type
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                <a>
                                    <form action='general_setup.php' method='post'>
                                        <input class=hidden name='o' value='notification_type'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Notification Type
                                        </button>
                                    </form>
                                    </a>
                                </li>


                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Transaction<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                 <li>
                                <a>
                                    <form action='transactions.php' method='post'>
                                        <input class=hidden name='o' value='user_registration'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">User Registration
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                 <a>
                                    <form action='transactions.php' method='post'>
                                        <input class=hidden name='o' value='daily_weather'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Daily Weather
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                 <a>
                                    <form action='transactions.php' method='post'>
                                        <input class=hidden name='o' value='disperse_notification'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Disperse Notification / Alert
                                        </button>
                                    </form>
                                    </a>
                                </li>




                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                         <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                 <li>
                                <a>
                                    <form action='reports.php' method='post'>
                                        <input class=hidden name='o' value='user_rador_embassy'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">User Rador for Embassy
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                <a>
                                    <form action='reports.php' method='post'>
                                        <input class=hidden name='o' value='user_rador_police'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">User Rador for Police
                                        </button>
                                    </form>
                                    </a>
                                </li>


                                 <li>
                                 <a>
                                    <form action='reports.php' method='post'>
                                        <input class=hidden name='o' value='incident_report'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Incident Report
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                 <a>
                                    <form action='reports.php' method='post'>
                                        <input class=hidden name='o' value='alert_map'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Alert Map
                                        </button>
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                 <a>
                                    <form action='reports.php' method='post'>
                                        <input class=hidden name='o' value='route_density'>

                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Route Density
                                        </button>
                                    </form>
                                    </a>
                                </li>


                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
