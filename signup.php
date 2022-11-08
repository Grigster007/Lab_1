
<!--PHP-->

<?php

  session_start();
  
  if (!isset($_SESSION["session"])){

    $session = session_create_id(); // создал сессию нужно передавать ее во все файлы и проверять на каждом файле, есть ли она.

  } else {

    $session = $_SESSION["session"];
  }

  if(isset($_COOKIE['exist'])) {

    header("Location: index.php");

  } else if (isset($_COOKIE['notexist'])) {

    header("Location: register.php");
  }

?>

<!--HTML-->

<h1>User login</h1>

<form method="GET" action = "check_func.php">

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>

</form>


