
<?php

    session_start();
    
    function check_login() {

        if (isset($_GET["username"]) && isset($_GET["password"])) {



            $conn = new mysqli("127.0.0.1", "root", "root", "store",3306);
            if($conn->connect_error) {
                echo "Ошибка: ".$conn->connect_error;
            }



            $my_name = $conn->real_escape_string($_GET["username"]);
            $pass = crypt($conn->real_escape_string($_GET["password"]), 'my_lab');
            $sql = "SELECT * FROM users where name = '$my_name' and password = '$pass'";
            //$sql = "INSERT INTO users (name, password) VALUES ('$my_name', '$pass')";



            setcookie('name', $my_name, time()+180);



            $result = $conn->query($sql);
            if($result) {
                //echo "Запрос выполнен";
            } else {
                echo "Ошибка: " . $conn->error;
            }


            
            $conn->close();   



            $row_cnt = $result->num_rows;
            if ($row_cnt == 1) {
                
                return(1);

            } else {
                
                return(0);
            }
        }

    }

    $check_signup = check_login();
    if ($check_signup == 1) {

        http_response_code(200);        
        //echo "User exist, open form index.php";
        setcookie('exist', 'true', time() + 1);
        header("Location: signup.php");

    } else if ($check_signup == 0) {

        http_response_code(404);
        //echo "User dont exist, open form register.php";        
        setcookie('notexist', 'true', time() + 1);
        header("Location: signup.php");
    }
    //*/

?>
