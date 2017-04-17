<?php

require ROOT . 'models'.DIRECTORY_SEPARATOR.'book_search_model.php';

$all_authors_db = getRecords($link, "author");
 foreach ($all_authors_db as $author_item) {
    $all_authors[$author_item['id']] = $author_item['name'];
 }
 $all_styles_db = getRecords($link, "style");
 foreach ($all_styles_db as $style_item) {
    $all_styles[$style_item['id']] = $style_item['title'];
 } 
 
 $author_id = requestGet('author_id');
 $style_id = requestGet('style_id');
 
