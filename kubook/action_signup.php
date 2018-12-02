<?php
require 'db.php';
$q_name = db::getInstance()->real_escape_string($_POST['name']);
$q_student_number = db::getInstance()->real_escape_string($_POST['student_number']);
$q_password = db::getInstance()->real_escape_string(($_POST['password']));
$q_password2 = db::getInstance()->real_escape_string(($_POST['password2']));

if(strcmp($q_password,$q_password2) != 0){
    echo "<script>alert(\"Check Your Password\"); history.back(-2); </script>";
}else{
    $check_query="SELECT count(*) FROM member WHERE student_number = ".$q_student_number;
    $check_result= db::getInstance()->get_result($check_query);

    if($check_result['count(*)'] > 0 ){ //이미 가입된 학번
        echo "<script>alert(\"Already Joined Student Number\"); history.back(-2); </script>";
    }else{ //정상 회원가입 루틴
        $query="INSERT INTO `member` (`name`, `student_number`, `password`, `admin`, `created_at`) VALUES ('".
            $q_name."',
         '".$q_student_number."',
          '".$q_password."',
           '0', now())";

        $result = db::getInstance()->dbquery($query);
        if (!$result) {
            echo db::getInstance()->error;
        }else{ //정상 가입
            echo "<script>alert(\"Congratulations! Login New Account\"); location.replace('./index.php');</script>";
        }
    }
}
?>