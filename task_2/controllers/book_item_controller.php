<?php

require ROOT . 'models'.DIRECTORY_SEPARATOR.'books_model.php';
require ROOT . 'controllers'.DIRECTORY_SEPARATOR.'book_search_controller.php';

$id = requestGet('id');
$book = findBookById($link, $id);


if (!$book) {
    die('Book not found');
}
