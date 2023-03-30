<?php
//單次呼叫php
require_once("dbtools1.php"); 

    $data = file_get_contents("php://input", "r"); //接受外部參數
    $mydata = array();
    $mydata = json_decode($data, true); //以json decode方式

    if(isset($mydata["food_no"]) && isset($mydata["food_gb5"]) && isset($mydata["food_eng"]) && isset($mydata["food_describe"]) && isset($mydata["food_group"]) && isset($mydata["food_price"]) && isset($mydata["tag_promo"]) && isset($mydata["tag_recmn"]) && isset($mydata["food_pic"])){
        if($mydata["food_no"] != "" && $mydata["food_gb5"] != "" && $mydata["food_eng"] != "" && $mydata["food_describe"] != "" && $mydata["food_group"] != "" && $mydata["food_price"] != "" && $mydata["tag_promo"] != "" && $mydata["tag_recmn"] != "" && $mydata["food_pic"] != ""){
            
            $food_no = $mydata["food_no"];
            $food_gb5 = $mydata["food_gb5"];
            $food_eng = $mydata["food_eng"];
            $food_describe = $mydata["food_describe"];
            $food_group = $mydata["food_group"];
            $food_price = $mydata["food_price"];
            $tag_promo = $mydata["tag_promo"];
            $tag_recmn = $mydata["tag_recmn"];
            $food_pic = $mydata["food_pic"];

            // $servername = "localhost";
            // $username = "id19728260_hiller16";
            // $password = "Appleisshit123!";
            // $dbname = "id19728260_maindb";

            // $conn = mysqli_connect($servername, $username, $password, $dbname);
            // if(!$conn){
            //     die("連線失敗".mysqli_connect_error());
            // }

            //呼叫dbtools1的$conn
            $conn = create_connect();
            
            $sql = "UPDATE sales SET food_gb5 = '$food_gb5', food_eng = '$food_eng', food_describe = '$food_describe', food_group = '$food_group', food_price = '$food_price', tag_promo = '$tag_promo', tag_recmn = '$tag_recmn', food_pic = '$food_pic'WHERE food_no= '$food_no'";  
            // 注意 WHERE 之前不要加逗號!!

            //呼叫dbtools的$result
            $result = execute_sql($conn,"id19728260_maindb",$sql);

            if(mysqli_query($conn, $sql)){
                echo '{"state": true, "message":"更新資料成功!"}';
            }else{
                echo '{"state": false, "message":"更新資料失敗!"'.$sql.mysqli_error($conn).'}';
            }
            mysqli_close($conn);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }

    //mysqli_close($conn);


?>