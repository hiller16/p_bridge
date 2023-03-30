<?php
require("dbtools1.php");

$conn = create_connect();

$sql="SELECT * FROM sales ORDER BY food_no DESC";

$result = execute_sql($conn,"id19728260_maindb",$sql);

$result=mysqli_query($conn,$sql); 

if(mysqli_num_rows($result)>0){ 
    $mydata=array(); 
    while($row=mysqli_fetch_assoc($result)){ 
        $mydata[]=$row;
    }
    echo'{"state":true,"message":"資料讀取成功!","data":'.json_encode($mydata).'}';
}else{
    echo'{"state":false,"message":"讀取資料失敗或查無資料!"}';
}
mysqli_close($conn);

?>