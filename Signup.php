<?php
        include 'partial/_dbconnect.php';
        $showAlert = false;
        $showError = false;
        $exists = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['uname'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
        
            $exitsSql="SELECT * FROM `users` WHERE username= '$username'";     // check wheter username exits
            $result = mysqli_query($conn, $exitsSql);
            $numExitsRows=mysqli_num_rows($result);

            if($numExitsRows > 0){
                $showError ="Username Already Exits";              
            }
            else{
                $exists=false;            
                if (($password == $cpassword)) {                    
                    $hash=password_hash($password,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $showAlert = true;
                    }
                }
                else{
                    $showError ="Password Do Not Match.";
                }
            }
        }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Sign Up</title>
</head>

<body>
    <?php require 'partial/_nav.php';   ?>

    <?php
        if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>Your account is created. Now you can log in.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
        }
        if($showError){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>'.$showError.'
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                      </div>';
        }   
        
    ?>

    <div class="container my-4" >
        <h1 class="text-center">Signup To Our Website</h1>
        <form action="/Programs/LoginSystem/Signup.php" method="post">
            <div class="form-group col-md-6">
                <label for="uname">User Name</label>
                <input type="text" maxlength="11" class="form-control" id="uname" name="uname" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Username should be less than 11 characters.</small>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name="password">
            </div>
            <div class="form-group col-md-6">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">Make sure to type same password.</small>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>