<?php
    require 'db.php';
$seat_id = db::getInstance()->real_escape_string($_GET['seat_id']);
$user_id = db::getInstance()->real_escape_string($_GET['user_id']);

    $query="SELECT COUNT(*) as count FROM rental_seat_history WHERE rental_finish > now() and user_id = ".$user_id;
    $result = db::getInstance()->get_result($query);
    if($result['count'] > 0){
        echo "[Fail] Already Rental seat";
    }else{
        $query="INSERT INTO `rental_seat_history` (`user_id`,`rental_start`, `rental_finish`, `seat_id`) VALUES ('"
            .$user_id."',"
            ."now(),"
            ."ADDTIME(now(),\"3:00:0.000000\"),'"
            .$seat_id."'"
            .")";

        $result = db::getInstance()->dbquery($query);
        if (!$result) {
            echo db::getInstance()->error;
            echo $query;
            echo "[Fail] Rental Fail";
        }else{
            $query="UPDATE `seat` SET `status` = '0' WHERE `seat`.`id` = ".$seat_id;

            $result = db::getInstance()->dbquery($query);

            echo "[Success] Rental OK";
        }
    }
?>


