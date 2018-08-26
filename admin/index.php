<?php
include 'header.php';
include('../includes/config.php');
session_start();
$_SESSION['welcome']=0;
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];


    $sql8 = "SELECT * from employee where email=:uname";
    $query8 = $dbh->prepare($sql8);
    $query8->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query8->execute();
    $results8 = $query8->fetchAll(PDO::FETCH_OBJ);
    $cnt8 = 1;
    $sql9 = "SELECT * from employee where password=:password";
    $query9 = $dbh->prepare($sql9);
    $query9->bindParam(':password', $password, PDO::PARAM_STR);
    $query9->execute();
    $results9 = $query9->fetchAll(PDO::FETCH_OBJ);
    $cnt9 = 1;
    $error = "";
    if ($query8->rowCount() <= 0) {
        $_SESSION['loginerror'] = '<div class="alert alert-danger left-icon-alert"  role="alert">
                                                             Invalid Email Address, Please enter the correct Email Address
                                                        </div>
                                                        <div id="error"></div>';
    } else if ($query9->rowCount() <= 0) {
        $_SESSION['loginerror'] = '<div class="alert alert-danger left-icon-alert"  role="alert">
                                                             Invalid Password, Please enter the correct Password
                                                        </div>
                                                        <div id="error"></div>';
//        $error = 'Invalid Password, Please enter the correct Password';
    } else {

        $sql = "select Email,Password FROM Employee WHERE BINARY Email=:uname and BINARY Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
        } else {
            $error = '<div class="alert alert-danger left-icon-alert"  role="alert">
                                                            <strong>Oh snap!</strong> Invalid Details
                                                        </div>
                                                        <div id="error"></div>';
//            $error = 'Invalid Details';
        }
    }
}
?>
<style>
    body, html {
        height: 100%;
    }

    .bg { 
        /* The image used */
        background-image: url("img/construction.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body class = "bg"  >

    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <div class="row">
                <a style = "color:black; font-size: 50px;" href="../index.php">Khomanani</a>
            </div>
            <br>
            
            <div class="row">
                <a style = "color:black; font-size: 50px;" href="../index.php">Constructions</a></div>
        </div>
        <?php
        if (isset($_SESSION['loginerror'])) {
            echo $_SESSION['loginerror'];
            $_SESSION['loginerror'] = "";
        }
        ?>
        <!-- User name -->
        <div class="lockscreen-name " style = "font-size: 20px;">Login</div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="modal-content">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="../img/key.png" alt="User Image">
            </div>

            <form class="lockscreen-credentials" action = "login.php"method = "POST">
                <br><br>
                <div class="input-group">
                    <div class='row'>
                        <label class="control-label" for="username" style="font-size: 15px">Username</label>
                        <input name = "username" class="form-control" placeholder="Username" >
                    </div>
                    <div class='row'>
                        <label class="control-label" for="password" style="font-size: 15px">Password</label>
                        <input type="password" name = "password" class="form-control" placeholder="Password" autofocus>
                    </div>
                    &numsp;&numsp;
                    <div class='row'>
                        <div class=""  >
                            <button name="login" class="btn btn-success btn-labeled pull-left"><i class="fa fa-sign-in " style="font-size: 15px"> Sing In</i></button>&numsp;&numsp;&numsp;&numsp;<a href="#" data-toggle="modal" data-target="#mymodal" class=" pull-right" style="font-size: 15px">Forgot Password <span class=""><i class="fa fa-lock"></i></span></a>
                        </div> 
                    </div>

                </div>
                <br>

            </form>



            <!-- /.lockscreen credentials -->

        </div>
        <div class="modal" id="mymodal">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Please enter your employee email address to reset your password</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 padding-top-10">
                                <input type="text" class="form-control" id="modalempno" name="modalempno" placeholder="Employee Email" required="true" /><!-- InputBox to enter employee number -->	
                            </div>

                            <div class="col-md-5 padding-top-10">
                                <button type="button" name="submitemail" class="btn btn-info"   onclick="resetPassword('modalempno')" style="width: 268px;">Submit</button><!-- Button to submit email -->
                            </div>
                        </div>
                        <div id="screen3" align="center" ></div>
                        <br />
                        <h5 id="screen3"></h5>
                    </div>
                </div><!-- END modal-content -->
            </div><!-- END MODAL DIALOG -->

        </div>
        <!-- END OF MODAL POPUP -->




        <div class="modal" id="mymodal2">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Please enter your Employee Number</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 padding-top-8">
                                <input type="text" class="form-control" id="reset_answer" name="reset_answer" placeholder="Employee ID Number" required="true" /><!-- InputBox to enter employee number -->	
                            </div>

                            <div class="col-md-2 padding-top-8">
                                <button type="button" name="submitemail" class="btn btn-info" onclick="resetPassword2('reset_answer')" style="width: 268px;">Submit</button><!-- Button to submit email -->
                            </div>
                        </div>

                        <br /><div id="screen4" align="center" ></div>
                        <h5 id="screen3"></h5>
                    </div>
                </div><!-- END modal-content -->
            </div><!-- END MODAL DIALOG -->
        </div>

        <script>
            $(function () {
                if (<?php echo $_SESSION["Error"] ?> !== "") {
                    swal('Oops!', 'Invalid Email or Password!', 'error');
                }
<?php $_SESSION["Error"] = ""; ?>

            });
        </script>
        <script  language="JavaScript" type="text/javascript">
            function resetPassword(a1) {
                var a1 = document.getElementById(a1);

                //Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                //Create some variables we need to send to our PHP file
                var url = "process.php";
                var emp_num = a1.value;

                var vars = "reset_empnum=" + emp_num;

                hr.open("POST", url, true);
                //Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                //Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function () {
                    if (hr.readyState === 4 && hr.status === 200) {
                        var return_data = hr.responseText;
                        document.getElementById("screen3").innerHTML = return_data;
                    }
                };

                //Send the data to PHP now... and wait for response to update the status div
                hr.send(vars);//Actually execute the request
                document.getElementById("screen3").innerHTML = "processing...";
            }
        </script>
        <script language="JavaScript" type="text/javascript">
            function resetPassword2(a1) {
                var a1 = document.getElementById(a1);

                //Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                //Create some variables we need to send to our PHP file
                var url = "process.php";
                var emp_num = a1.value;

                var vars = "reset_answer=" + emp_num;

                hr.open("POST", url, true);
                //Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                //Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function () {
                    if (hr.readyState === 4 && hr.status === 200) {
                        var return_data = hr.responseText;
                        document.getElementById("screen4").innerHTML = return_data;
                    }
                };

                //Send the data to PHP now... and wait for response to update the status div
                hr.send(vars);//Actually execute the request
                document.getElementById("screen4").innerHTML = "processing...";
            }
        </script>
        <!-- JS -->
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="js/sweet-alert/sweetalert.min.js"></script> 
</body>
</html>