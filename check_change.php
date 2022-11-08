<!--PHP-->

<?php

    session_start();

    function check_change() {

        if (isset($_GET["oldpassword"]) && (isset($_GET["newpassword"]))) {

            $conn = new mysqli("127.0.0.1", "root", "root", "store",3306);
            if($conn->connect_error) {
                echo "Ошибка: ".$conn->connect_error;
            }

            $my_name = '';
            if(isset($_COOKIE['name'])) {

                $my_name = $conn->real_escape_string($_COOKIE['name']);
            } else {
                $conn->close();
                return 0; 
            }

            $old_pass = crypt($conn->real_escape_string($_GET["oldpassword"]), 'my_lab');

            //1-й запрос
            $sql = "SELECT * FROM users where name = '$my_name' and password = '$old_pass'";


            $result = $conn->query($sql);
            if($result) {
                //echo "Запрос выполнен";
            } else {

                echo "Ошибка: " . $conn->error;
            }
            /*
            while($row = mysqli_fetch_array($result)) {

                $_SESSION['id'] = $row['id'];
            }
            //*/
            $row_cnt = $result->num_rows;
            if ($row_cnt == 1) {
                
                $new_pass = crypt($conn->real_escape_string($_GET["newpassword"]), 'my_lab');
                
                //$user_id = $_SESSION['id'];

                //2-ой запрос
                $sql = "UPDATE users SET password = '$new_pass' WHERE name ='$my_name'";
                if($conn->query($sql)) {
                    //echo "Данные успешно добавлены";
                } else {
                    echo "Ошибка: " . $conn->error;
                }
                
                return 1;

            } else {
                
                return 2;
            }
            $conn->close();
        }
    }
    $check_pass = check_change();

    if ($check_pass == 0) {

        http_response_code(303);
        setcookie('timeisover', 'true', time() + 1);
        header("Location: changepass.php");

    } else if ($check_pass == 1){

        http_response_code(200);        
        setcookie('passwordchangedcorrectly', 'true', time() + 1);
        header("Location: changepass.php");
    } else if($check_pass == 2){

        http_response_code(404);
        setcookie('incorrectpassword', 'true', time() + 1);
        header("Location: changepass.php");
    }

?>