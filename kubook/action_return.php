<?php
    require 'db.php';
    $return_id = db::getInstance()->real_escape_string($_GET['return_id']);
    $query="UPDATE `rental_book_history` SET `return_status` = '1' WHERE `rental_book_history`.`id` = ".$return_id;

    $result = db::getInstance()->dbquery($query);

    $query="SELECT datediff((SELECT rental_finish FROM rental_book_history history WHERE history.id = ".$return_id."), now()) diff";
    $result = db::getInstance()->get_result($query);
    if($result['diff'] >= 0){
        echo "[Success] Return";
    }else{
        echo "[Success] Return, Late Fee : ".($result['diff']*100*(-1));
    }
    $query="UPDATE `rental_book_history` SET `rental_finish` = now() WHERE `rental_book_history`.`id` = ".$return_id;

    $result = db::getInstance()->dbquery($query);

?>


