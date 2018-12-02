<?php
    require 'db.php';
    $user_id = db::getInstance()->real_escape_string($_POST['student_number']);
    $user_pw = db::getInstance()->real_escape_string($_POST['password']);
    $check_query="SELECT * FROM member WHERE student_number = ".$user_id." and password LIKE '".$user_pw."'";
    $row_count = db::getInstance()->get_row_count($check_query);
    if($row_count == 1 ) { //로그인 성공
        session_start();
        $check_result= db::getInstance()->get_result($check_query);
        $_SESSION['user_id'] = $check_result['student_number'];
        $_SESSION['user_name'] = $check_result['name'];
        $_SESSION['user_level']= $check_result['admin'];
        $_SESSION['user_pk']= $check_result['id'];
        echo "<script>alert('".$_SESSION['user_name']."님 환영합니다.');</script>";
    }else{
        echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
    }
?>
<meta http-equiv='refresh' content='0;url=index.php'>


