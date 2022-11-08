
<!--PHP-->

<?php

    session_start();

    if (!isset($_SESSION["session"])){

        $session = session_create_id(); // создал сессию нужно передавать ее во все файлы и проверять на каждом файле, есть ли она.

    } else {

        $session = $_SESSION["session"];
    }

    if(isset($_COOKIE['notregister'])) {

        header("Location: index.php");

    } else if (isset($_COOKIE['alreadyregistered'])) {
        
        echo "<h2><font color='red'> User already exist! Please try again! </font></h2>";
    }

?>

<!--HTML-->

<h4><font color='green'> You have been redirected to another form because you are not registered.</font></h4>
<h1>User register</h1>

<form method="GET" action = "chek_login.php"> 

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>

</form>
