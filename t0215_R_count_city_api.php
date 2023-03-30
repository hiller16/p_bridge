<?php
    require_once("dbtools1.php");
    $link = create_connect();
    $sql = "SELECT count(City) as num,City FROM member GROUP BY City";
    $result = execute_sql($link, "id19728260_maindb", $sql);
    if(mysqli_num_rows($result) > 0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        
        echo '{"state": true, "message":"會員居住地統計成功!", "data" : '.json_encode($mydata).'}';

        mysqli_close($link);
    }else{
        echo '{"state": false, "message":"會員居住地讀取失敗!'.mysqli_error($link).'"}';
    }
?>
