<!-- {"state": true, "message":"會員總數統計成功!", "data" : [{"num":"7","UserState":"1"},{"num":"1","UserState":"0"}]} -->

<?php
    require_once("dbtools1.php");
    $link = create_connect();
    $sql = "SELECT count(UserState) as num,UserState FROM member GROUP BY UserState";
    $result = execute_sql($link, "id19728260_maindb", $sql);
    if(mysqli_num_rows($result) > 0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        
        echo '{"state": true, "message":"會員總數統計成功!", "data" : '.json_encode($mydata).'}';

        mysqli_close($link);
    }else{
        echo '{"state": false, "message":"會員讀取失敗!'.mysqli_error($link).'"}';
    }
?>
