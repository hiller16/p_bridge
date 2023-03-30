<?php
//INPUT: {"id":"XXX"}
//Output:
// {"state": true, "message":"讀取成功!", "data" : 單筆會員資料}
// {"state": false, "message":"讀取失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

    $data = file_get_contents("php://input", "r");
    $jsonData = array();
    $jsonData = json_decode($data, true);

    if (isset($jsonData["id"])) {
        if ($jsonData["id"] != "") {
            $p_id = $jsonData["id"];

            require("dbtools.php");
            $link = create_connect();

            $sql = "SELECT ID,Username,Email,Created_at FROM member WHERE ID = '$p_id'";

            $result = execute_sql($link, "testdb", $sql);

            if (mysqli_num_rows($result) == 1) {
                //若找到ID對應資料
                $row = mysqli_fetch_assoc($result); //取出一筆資料
                echo '{"state": true, "message":"讀取資料成功!", "data":' . json_encode($row) . '}';
                }else{
                    //未找到ID對應資料
                    echo '{"state": false, "message": "讀取資料失敗" '.mysqli_error($link).'"}';
            }
            mysqli_close($link);
        } else {
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    } else {
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
    ?>