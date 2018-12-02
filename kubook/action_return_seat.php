<?php
    require 'db.php';
    $return_id = db::getInstance()->real_escape_string($_GET['return_id']);
    $seat_number = db::getInstance()->real_escape_string($_GET['seat_number']);
    $query="UPDATE `seat` SET `status` = '1' WHERE `seat`.`seat_number` LIKE ".$seat_number;

    $result = db::getInstance()->dbquery($query);

    $query="UPDATE `rental_seat_history` SET `rental_finish` = now() WHERE `rental_seat_history`.`id` = ".$return_id;

    $result = db::getInstance()->dbquery($query);
    echo "[Success] Return";
?>


