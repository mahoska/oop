<?php

//переделали на работу с БД
require ROOT . 'models'.DIRECTORY_SEPARATOR.'books_model.php';
require ROOT . 'controllers'.DIRECTORY_SEPARATOR.'book_search_controller.php';

$page_number = isset($_GET['page_number']) ? (int)$_GET['page_number'] : 1;

 $sortField = requestGet('sort', 'price');
 $sortOrder = requestGet('order', 'asc');
 //$author_id = requestGet('author_id');
 $sortAllField = getSortedFields();
 $sortAllOrder = ['asc','desc'];
 
 $serch_book_name = requestGet('search_book_name');
 //var_dump($all_authors);
 
 $itemsPerPage = 8;
 
 if($author_id){
     $itemsCount = count_parambook($link,"author.id", $author_id);
     $books = findBooksByParam($link, $sortField, $sortOrder,$page_number,$itemsPerPage, "author.id", $author_id); 
 }
 else if($style_id){
     $itemsCount = count_parambook($link,"book.style_id", $style_id);
     $books = findBooksByParam($link, $sortField, $sortOrder,$page_number,$itemsPerPage, "book.style_id", $style_id);
 }
 else if($serch_book_name){
     $itemsCount = count_allbook($link,$serch_book_name);
     $books = findAllBooks($link, $sortField, $sortOrder,$page_number,$itemsPerPage, $serch_book_name);
 }
 else{
    $itemsCount = count_allbook($link);
    $books = findAllBooks($link, $sortField, $sortOrder,$page_number,$itemsPerPage);
 }

    $p = new Pagination(array(
        'itemsCount' => $itemsCount,
        'itemsPerPage' => $itemsPerPage,
        'currentPage' => $page_number
        ));

    
    foreach ($books as $key => &$book) {
        $authors_name = explode(", ",$book['authors_name']);
        $authors_id = explode(", ", $book['authors_id']);
        $book['authors'] = array_combine($authors_id,$authors_name);
        //var_dump($authors);
    }
 
//echo count($books);
//echo"<pre>";
//var_dump($books);
//echo"</pre>";


