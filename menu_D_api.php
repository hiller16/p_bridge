<?php
    require("dbtools1.php");
    $data = file_get_contents("php://input", "r"); //接受外部參數
    $mydata = array(); //新增一個陣列接收
    $mydata = json_decode($data, true); //以json decode方式

    if(isset($mydata["food_no"])){
        if($mydata["food_no"] != ""){

            $food_no = $mydata["food_no"];

            // $servername = "localhost";
            // $username = "owner";
            // $password = "123456";
            // $dbname = "testdb";

            // $conn = mysqli_connect($servername, $username, $password, $dbname);
            // if(!$conn){
            //     die("連線失敗".mysqli_connect_error());
            // }
            $conn=create_connect();

            $sql = "DELETE FROM sales WHERE food_no= '$food_no'";

            $result=execute_sql($conn,"id19728260_maindb",$sql);

            //必須有一個row被影響
            // if(mysqli_query($conn, $sql) && mysqli_affected_rows($conn)== 1){

            if($result && mysqli_affected_rows($conn)== 1){
                echo '{"state": true, "message":"刪除資料成功!"}';
            }else{
                echo '{"state": false, "message":"刪除資料失敗!"'.$sql.mysqli_error($conn).'}';
            }
            mysqli_close($conn);
                }else{
                    echo '{"state": false, "message":"欄位不得為空白!"}';
                }
        }else{
            echo '{"state": false, "message":"缺少規定欄位!"}';
        }




    //$conn->close();


?>