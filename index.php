<?php
session_start();

if (isset($_POST)) {


    if (isset($_POST['BUTSYS'])) {


        include_once('connection.php');


        $name = $_POST['UID'];
        $email = $_POST['UID'];
        $mobile = $_POST['UID'];
        $password = $_POST['PWD'];

        /* Select queries return a resultset */
        if ($result = mysqli_query($connect, 'SELECT * FROM log_in WHERE (LI_NAME="' . $name . '" OR LI_EMAIL="' . $email . '" OR MOBILE_NO="' . $mobile . '") AND PASSWORD="' . $password . '"')) {

//            printf("Select returned %d rows.\n", mysqli_num_rows($result));


            if (!mysqli_data_seek($result, 0)) {
                echo "Cannot seek to row 0: " . "\n";
            }


//            *fetch rows in reverse order */


        }

        for ($i = mysqli_num_rows($result) - 1; $i >= 0; $i--) {
            if (!mysqli_data_seek($result, $i)) {
                echo "Cannot seek to row $i: " . mysqli_error() . "\n";
                continue;
            }

            if (!($row = mysqli_fetch_assoc($result))) {
                continue;
            }


        }
        var_dump($row);


//        $query = 'SELECT * FROM log_in';
//        $result = mysqli_query($connect,$query);
//        var_dump($result);die;
//

//        $sql = mysqli_query($connect, 'SELECT * FROM log_in');
//        $sql = mysqli_query($connect, 'SELECT * FROM log_in WHERE (LI_NAME="' . $name . '" OR LI_EMAIL="' . $email . '" OR MOBILE_NO="' . $mobile . '") AND PASSWORD="' . $password . '"');


//        var_dump($sql);

//        $check_user = mysqli_num_rows($sql);
        if ( $row['LI_NAME']) {

            $_SESSION['UName'] = $row['LI_NAME'];
            $_SESSION['U_EMAIL'] = $row['LI_EMAIL'];
            $_SESSION['UID'] = $mobile;
            header('Location: pages/index.php');
        } else {
            echo "Invalid Username or Password";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Great Himalayan Trails</title>

    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <!-- <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">  -->

    <!-- Custom CSS -->
    <!-- <link href="../dist/css/sb-admin-2.css" rel="stylesheet">  -->

    <!-- Custom Fonts -->
    <!-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span>Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form class="form-inline" method="post" action="index.php">
                        <table class="table">
                            <tr>
                                <td>
                                    <input type="text" value="ghanendra.limbu.c1@gmail.com" class="form-control"
                                           id="UID" name="UID" placeholder="Email / Mobile No / User ID" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" value="ghanendra" class="form-control" id="PWD" name="PWD"
                                           placeholder="Password" required>
                                </td>
                            </tr>
                            <tr><!--
                                  <?php if ($MSG == '1') { ?><div style="color:red;height:30px">Invalid or wrong password !</div><?php } ?>
                                  <?php if ($MSG == '2') { ?><div style="color:red;height:30px">Invalid or wrong username !</div><?php } ?>
                                 



                               Change this to a button or input when using this as a form  -->
                                <td>
                                    <input type="submit" name='BUTSYS' class="btn btn-warning" style="width: 100px"
                                           value="login">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
