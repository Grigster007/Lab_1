
<!--PHP-->

<?php

    session_start();

    if(isset($_COOKIE['name'])){
        
        if (!isset($_SESSION["session"])){

            $session = session_create_id();

        } else {

            $session = $_SESSION["session"];
        }

        if(isset($_COOKIE['timeisover'])) {

            echo "<h1><font color='blue'>Cookie's lifetime is over. You will be redirected to the login page in five seconds</font><h1>";
            sleep(3);
            header("Location: signup.php");

        } else if (isset($_COOKIE['passwordchangedcorrectly'])) {

            setcookie("change_password", 'true', time()+1);
            header("Location: index.php");

        } else if (isset($_COOKIE['incorrectpassword'])){

            echo "<h2><font color='red'>Old password is not correct!!! Please try again! </font></h2>";
        }

    } else {

        header("Location: signup.php");
    } 
?>



<!--HTML-->

<h1>User change password</h1>

<form method="GET" action="check_change.php"> 

    <div class="mb-3">
        <label for="oldpassword" class="form-label">Old password</label>
        <input type="password" class="form-control" id="oldpassword" name="oldpassword" required>
    </div>

    <div class="mb-3">
        <label for="newpassword" class="form-label">New password</label>
        <input type="password" class="form-control" id="newpassword" name="newpassword" required>
    </div>

    <button type="submit" class="btn btn-primary">Change password</button>

</form>
