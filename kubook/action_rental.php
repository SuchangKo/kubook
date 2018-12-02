<?php
    require 'db.php';
$book_id = db::getInstance()->real_escape_string($_GET['book_id']);
$user_id = db::getInstance()->real_escape_string($_GET['user_id']);
    $query="INSERT INTO `rental_book_history` (`user_id`, `book_id`, `rental_start`, `rental_finish`, `return_status`) VALUES ('"
        .$user_id."','"
        .$book_id."',"
        ."now(),"
        ."DATE_ADD(now(), INTERVAL 14 DAY),'"
        ."0'"
        .")";

    $result = db::getInstance()->dbquery($query);
    if (!$result) {
        echo db::getInstance()->error;
        echo $query;
        echo "[Fail] Rental Fail";
    }else{
        echo "[Success] Rental OK";
    }
?>


