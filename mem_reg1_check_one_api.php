<?php

//事前檢查:
// require_once("dbtools.php");
// $link = create_connect();
// $sql = "INSERT INTO member(Username, Password, Email) VALUES('owner01', '123456', 'owner01@gmail.com')";
// if(execute_sql($link, "testdb", $sql)){
//     echo '{"state": true, "message":"註冊會員成功!"}';
// }else{
//     echo '{"state": false, "message":"註冊會員失敗!"'.mysqli_error($link).'}';
// }
// mysqli_close($link);

// 確認{"state": true, "message":"註冊會員成功!"}成功



    // $data = file_get_contents("php://input", "r");
    // $mydata = array();
    // $mydata = json_decode($data, true);

    // if(isset($mydata["username"])){
    //     if($mydata["username"] != "" ){
    //         $p_username = $mydata["username"];

    //         require_once("dbtools.php");
    //         $link = create_connect();

    //         $sql = "SELECT Username FROM member WHERE Username = '$p_username'";
    //         //確認帳號是否存在

    //         $result= execute_sql($link, "testdb", $sql);

    //         if(mysqli_num_rows($result))==1{
    //             //帳號已存在
    //             echo '{"state": flase, "message":"帳號已存在"}';
    //         }else{
    //             //帳號不存在可使用
    //             echo '{"state": true, "message":"帳號不存在可使用"}';
    //         }
    //         mysqli_close($link);
    //     }else{
    //         echo '{"state": false, "message":"欄位不得為空白!"}';
    //     }
    // }else{
    //     echo '{"state": false, "message":"缺少規定欄位!"}';
    // }

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["username"])){
        if($mydata["username"] != ""){
            $p_username = $mydata["username"];

            require_once("dbtools1.php");
            $link = create_connect();
            $sql = "SELECT Username FROM member WHERE Username = '$p_username'";
            $result = execute_sql($link, "id19728260_maindb", $sql);
            if(mysqli_num_rows($result) == 1){
                //帳號已經存在
                echo '{"state": false, "message":"該帳號已存在, 帳號不可以使用!"}';
            }else{
                //帳號不存在
                echo '{"state": true, "message":"該帳號不存在, 帳號可以使用!"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
?>