<?php
require 'db.php';
$q_title = db::getInstance()->real_escape_string($_POST['title']);
$q_author = db::getInstance()->real_escape_string($_POST['author']);
$q_publisher = db::getInstance()->real_escape_string($_POST['publisher']);
$q_publish_year = db::getInstance()->real_escape_string($_POST['publish_year']);
$q_isbn = db::getInstance()->real_escape_string($_POST['isbn']);
$q_book_id = db::getInstance()->real_escape_string($_POST['book_id']);

$query = "UPDATE `book` SET `title` = '".$q_title."', `author` = '".$q_author."', `publisher` = '".$q_publisher."', `publisher_year` = '".$q_publish_year."', `isbn` = '".$q_isbn."' WHERE `book`.`id` = ".$q_book_id;


$result = db::getInstance()->dbquery($query);
if (!$result) {
    echo db::getInstance()->error;
}else{ //정상 등록
    echo "<script>alert(\"Book Updated\"); location.replace('./manage_book.php');</script>";
}
?>