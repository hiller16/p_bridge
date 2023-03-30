<?php

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if(isset($mydata["username"]) && isset($mydata["password"])){
    if($mydata["username"] != "" && $mydata["password"] != ""){
        
        $p_username = $mydata["username"]; 
        $p_password = $mydata["password"];

        require_once("dbtools1.php");
        $link = create_connect();

        $sql = "SELECT Username, Password, UserState FROM member WHERE Username = '$p_username'";
        //找出相同帳號的那一筆
        $result= execute_sql($link,"id19728260_maindb",$sql);

        if(mysqli_num_rows($result)==1){
            //該筆帳號存在，使用password_verify()驗證
            //password_verify('123456',$hash)
            $row= mysqli_fetch_assoc($result);
            $password_hash= $row["Password"];
            if(password_verify($p_password,$password_hash)){
                //密碼驗證成功
                //產生UID並更新於DB
                $uid01= substr(md5(hash('sha256',uniqid())),0,6);
                $uid02= substr(md5(hash('sha256',uniqid())),0,7);
                $sql="UPDATE member SET UID01 = '$uid01',UID02 = '$uid02' WHERE Username='$p_username'";
                execute_sql($link,"id19728260_maindb",$sql);

                //撈取除了密碼以外的資訊
                $sql="SELECT ID,Username,UserState, UID01,UID02 FROM member WHERE Username= '$p_username'";
                $result= execute_sql($link,"id19728260_maindb",$sql);
                $row=mysqli_fetch_assoc($result);
                $userData=array();
                $userData[]=$row;


                echo '{"state": true, "message":"登入會員成功!", "data": '.json_encode($userData).'}';
        }else{
            //密碼驗證失敗
            echo '{"state": false, "message":"登入會員失敗!"'.mysqli_error($link).'"}';
        }
        mysqli_close($link);
    }else{
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
}else{
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
}
?>