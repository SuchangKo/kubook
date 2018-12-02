<?php
    require 'db.php';
    $book_id = db::getInstance()->real_escape_string($_GET['book_id']);
    $query="DELETE FROM book WHERE id = ".$book_id;


    $result = db::getInstance()->dbquery($query);
    if (!$result) {
        echo db::getInstance()->error;
        echo "[Fail] Remove Book";
    }else{ //정상 가입
        echo "[Success] Remove Book";
    }

?>


