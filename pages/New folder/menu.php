<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

                    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           
              <ul class="nav navbar-top-links navbar-right">
              <li >
                    <div class="input-group custom-search-form">
                        <img src="../../GHT/image/logo.png"  style="width:120px;height:100%;">

                    </div>
                            <!-- /input-group -->
                </li>
                         <li style="width:20%">
                            
                            <!-- /input-group -->
                        </li>

               <li class="sidebar-search" style="width:20%">
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

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Definition <span class="fa fa-caret-down"></span></a>
                  <ul class="dropdown-menu">
                    <li>
                        <a>
                        <form action='definition.php' method='post'>
                            <input class=hidden name='o' value='notifications'>
            
                            <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Notifications 
                            </button>            
                        </form>
                        </a>
                    </li>

                     <li>
                                <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='alert'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Alert
                                        </button>            
                                    </form>
                                </a>
                                </li>

                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                        <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-wrench fa-fw"></i> Setup <span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='location'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Location
                                        </button>            
                                    </form>
                                    </a>
                                </li>
                                 <li>
                                <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='user_registration'>
            
                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">User Registration
                                        </button>            
                                    </form>
                                    </a>
                                </li>
                                <li>
                                <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='route'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Route Entry
                                        </button>            
                                    </form>
                                    </a>
                                </li>
                                 <li>
                                 <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='route_point'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Route Point
                                        </button>            
                                    </form>
                                    </a>
                                </li>
                                 <li>
                                 <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='preference'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Preference Setup
                                        </button>            
                                    </form>
                                    </a>
                                </li>
                                 <li>
                                 <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='route_setup'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Route Setup
                                        </button>            
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                <a>
                                    <form action='definition.php' method='post'>
                                        <input class=hidden name='o' value='country_setup'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Country Setup
                                        </button>            
                                    </form>
                                </a>
                                </li>
                                
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sitemap fa-fw"></i> Transaction<span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu">

                                 <li>
                                 <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='area'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Daily Weather
                                        </button>            
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                 <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='area'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Daily Notification
                                        </button>            
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='types_places'>
            
                                        <button type="submit" class="btn btn-outline btn-primary btn-xs" style="border:none;width:100%;text-align:left">Types Of Places
                                        </button>            
                                    </form>
                                    </a>
                                </li>

                                <li>
                                <a>
                                    <form action='incident_rador.php' method='post'>
                                        <input class=hidden name='o' value=''>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Indicator Rador
                                        </button>            
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                    <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='area'>
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Ethnicity and Culture
                                        </button> 
                                    </form>
                                    </a>           
                                </li>

                                 <li>
                                 <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='area'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Alert and Notification
                                        </button>            
                                    </form>
                                </a>
                                </li>                             
                                
                                 <li>
                                 <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='registration_list'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Registration List
                                        </button>            
                                    </form>
                                </a>
                                </li>
                                
                                 <li>
                                 <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='route_maker'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Route Maker
                                        </button>            
                                    </form>
                                    </a>
                                </li>

                                 <li>
                                 <a>
                                    <form action='transaction.php' method='post'>
                                        <input class=hidden name='o' value='setup_route'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:100%;text-align:left">Setup Route
                                        </button>            
                                    </form>
                                    </a>
                                </li>
                                
                                 <li>
                                 <a>
                                    <form action='track_log.php' method='post'>
                                        <input class=hidden name='o' value='area'>
            
                                        <button type="submit" class="btn btn-default" style="border:none;width:200px;text-align:left">Tracker Log
                                        </button>            
                                    </form>
                                </a>
                                </li>

          </ul>
        </li>

         


       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user fa-fw"></i> Kavin <i class="fa fa-caret-down"></i>
                    </a>

                    
                        

                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->

                 </ul>
        </li>

         
    
                  
                 
            
            

            
        </nav>
