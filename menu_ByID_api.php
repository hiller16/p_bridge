<?php
     require("dbtools1.php");
// 另開新頁以{"food_no":"9"}
// {"state": true, "message":"讀取資料成功!", "data":輸出的json資料}
// {"state": false, "message":"讀取資料失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

//利用input ID去執行撈取該筆資料
$data = file_get_contents("php://input", "r");
$jsonData = array();
$jsonData = json_decode($data, true);

if(isset($jsonData["food_no"])){
    if($jsonData["food_no"] != ""){
        $food_no = $jsonData["food_no"];

        // $servername = "localhost";
        // $username = "owner";
        // $password = "123456";
        // $dbname = "testdb";

        // $conn = mysqli_connect($servername, $username, $password, $dbname);
        // if(!$conn){
        //     die("連線失敗".mysqli_connect_error());
        // }
        $conn=create_connect();

        $sql = "SELECT * FROM sales WHERE food_no = '$food_no'";

        $result = execute_sql($conn,"id19728260_maindb",$sql);
        
       
        if(mysqli_num_rows($result) == 1){
            $mydata = array();
            while($row = mysqli_fetch_assoc($result)){
                $mydata[] = $row;
            }
            echo '{"state": true, "message":"讀取資料成功!", "data":'.json_encode($mydata).'}';
        }else{
            echo '{"state": false, "message":"讀取資料失敗!錯誤代碼或相關訊息"}';
        }
        mysqli_close($conn);
    }else{
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
}else{
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
?>