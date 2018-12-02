<?php
require 'db.php';
$q_title = db::getInstance()->real_escape_string($_POST['title']);
$q_author = db::getInstance()->real_escape_string($_POST['author']);
$q_publisher = db::getInstance()->real_escape_string($_POST['publisher']);
$q_publish_year = db::getInstance()->real_escape_string($_POST['publish_year']);
$q_isbn = db::getInstance()->real_escape_string($_POST['isbn']);


$query="INSERT INTO `book` (`title`, `author`, `publisher`, `publisher_year`,`isbn`, `created_at`) VALUES ('".
    $q_title."',
         '".$q_author."',
          '".$q_publisher."',
          '".$q_publish_year."',
          '".$q_isbn."',
           now())";

$result = db::getInstance()->dbquery($query);
if (!$result) {
    echo db::getInstance()->error;
}else{ //정상 등록
    echo "<script>alert(\"New Book Added\"); location.replace('./add_book.php');</script>";
}
?>