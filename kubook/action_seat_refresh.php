<?php
    require 'db.php';

    $query = "SELECT * FROM seat WHERE status = 0";
    $results = db::getInstance()->get_raw($query);
    foreach ($results as $result){
        $tmp_query = "SELECT * FROM rental_seat_history WHERE seat_id = ".$result['id']." AND rental_finish < now()";
        if(db::getInstance()->get_row_count($tmp_query) > 0){
            $query="UPDATE `seat` SET `status` = '1' WHERE `seat`.`id` = ".$result['id'];
            $result = db::getInstance()->dbquery($query);
        }

    }

?>


