<!--PHP-->

<?php

    session_start();

    if (!isset($_SESSION["session"])){

        $session = session_create_id(); // создал сессию нужно передавать ее во все файлы и проверять на каждом файле, есть ли она.

    } else {

        $session = $_SESSION["session"];
    }

    $_SESSION['time'] = time();
    
    if(isset($_COOKIE['name'])){

        if(isset($_COOKIE['change_password'])){

            echo "<h2>Dear ".$_COOKIE['name'].", your password is changed succesfuly! </h2>";
        } else {

            echo '<h1>'.'Hello '.$_COOKIE['name'].', you login in account!'.'</h1>';
        }
    } else {

        header("Location: signup.php"); //перенаправление
    }

?>


<!--HTML-->


<form >
  
  <button class="btn btn-primary" formaction="signup.php">Exit</button>
  <button class="btn btn-primary" formaction="changepass.php">Change password</button>

</form>

<!--
<table>
<form action="signup.php?session=$session" method="GET">
<input type="submit" value="Exit" />
</form>

<form action="changepass.php?session=$session" method="GET">
<input type="submit" value="Change password" />
</form>
-->