<?php
// {"food_no_amount":"1","food_no":35,"food_gb5":"香腸","food_price":20,"food_total":20}

require_once("dbtools1.php"); 
$data = file_get_contents("php://input", "r"); //接受外部參數
$mydata = array();
$mydata = json_decode($data, true); //以json decode方式

if (isset($mydata["food_gb5"]) && isset($mydata["food_no"]) && isset($mydata["food_no_amount"]) && isset($mydata["food_price"]) && isset($mydata["food_total"])) {
    if($mydata["food_gb5"] != "" && $mydata["food_no"] != "" && $mydata["food_no_amount"] != "" && $mydata["food_price"] != "" && $mydata["food_total"] != "" ){

            
            $food_gb5 = $mydata["food_gb5"];
            $food_no = $mydata["food_no"];
            $food_no_amount = $mydata["food_no_amount"];
            $food_price = $mydata["food_price"];
            $food_total = $mydata["food_total"];

            $conn = create_connect();


            $sql="INSERT INTO kart(food_gb5, food_no,food_no_amount,food_price,food_total) VALUES ('$food_gb5','$food_no','$food_no_amount','$food_price','$food_total')";

//呼叫dbtools的$result
$result = execute_sql($conn,"id19728260_maindb",$sql);

// if (mysqli_query($conn,$sql)){

//直接帶入$result= (mysqli_query($conn,$sql))
if ($result){
    echo'{"state":true,"message":"新增購物車成功!"}';
}else{
     echo'{"state":false,"message":"新增購物車失敗:'.$sql.mysqli_error($conn).'"}';
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