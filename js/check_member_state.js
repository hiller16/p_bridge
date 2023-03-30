//確認會員登入
//登出按鈕設定為 #logout_btn，登入前隱藏狀態
//會員名稱設定為 #login_member
//uid01,02皆為臨時亂取的uid名


//利用cookie uid 確認登入狀態
function check_member_state() {
    if (getCookie("UID01") != "" && getCookie("UID02") != "") {
        //傳遞至後端驗證 UID 
        var jsonData = {};
        jsonData["uid01"] = getCookie("UID01");
        jsonData["uid02"] = getCookie("UID02");
        console.log(JSON.stringify(jsonData));
        console.log(JSON.stringify(jsonData));


        $.ajax({
            type: "POST",
            url: "mem_uid_check_api.php",
            data: JSON.stringify(jsonData),
            dataType: "json",
            success: showdata_uid_check,
            error: function () {
                alert("error:mem_uid_check_api.php")

            }
        });

    } else {
        alert("請先登錄或註冊會員!");
        location.href = "t1228.htm";
    }

    //登出按鈕監聽
    $("#logout_btn").bind("click", function () {
        setCookie("UID01", "", 7);
        setCookie("UID02", "", 7);
        location.href = "mem_control_panel.htm";
    });
}




function showdata_uid_check(data) {
    console.log(data);
    if (data.state) {
        //uid 驗證成功
        //顯示會員帳號相關訊息
        if (data.data[0].UserState == "1") {
            //此帳號為啟用狀態
            $("#login_member").text(data.data[0].Username + "會員您好!");
            $("#logout_btn").show();
        } else {
            //uid 驗證失敗
            alert("請先登錄或註冊會員!");
            location.href = "t1228.htm";
        }
    }
}
//form w3c set_cookie  
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//form w3c get_cookie
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}