

<?php

    session_start();

    function check_register() {

        if (isset($_GET["username"]) && isset($_GET["password"])) {


            //парооль проверить на колво символов, например, больше 6, мб отдельная функция для его проверки?
            //


            $conn = new mysqli("127.0.0.1", "root", "root", "store",3306);
            if($conn->connect_error) {        
                die("Ошибка: " . $conn->connect_error);
            }



            $my_name = $conn->real_escape_string($_GET["username"]);
            $pass = crypt($conn->real_escape_string($_GET["password"]), 'my_lab');

            //1-й запрос
            $sql = "SELECT * FROM users where name = '$my_name'";



            setcookie('name', $my_name, time()+180);



            $result = $conn->query($sql);
            if($result) {
                //echo "Запрос выполнен";
            } else {
                echo "Ошибка: " . $conn->error;
            }



            $row_cnt = $result->num_rows;
            if ($row_cnt == 0) {

                //2-ой запрос
                $sql = "INSERT INTO users (name, password) VALUES ('$my_name', '$pass')";
                if($conn->query($sql)) {
                    //echo "Данные успешно добавлены";
                } else {
                    echo "Ошибка: " . $conn->error;
                }

                $conn->close();
                return 1;

            } else {

                $conn->close();
                return 0;            
            }

        }
    }
    
    $check_registration = check_register();
    if ($check_registration == 1) {

        http_response_code(200);        
        //echo "User created! Open form index.php";
        setcookie('notregister', 'true', time() + 1);
        header("Location: register.php");

    } else if ($check_registration == 0) {

        http_response_code(404);
        //echo "User already exists, open form register.php";        
        setcookie('alreadyregistered', 'true', time() + 1);
        header("Location: register.php");
    }

?>
