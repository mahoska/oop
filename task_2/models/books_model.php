<?php

function getSortedFields()
{
    return ['title', 'price'];
}

function findAllBooks($link, $sortField, $sortOrder, $page_number, $itemsPerPage, $search="")
{
    if (!in_array(strtolower($sortField), getSortedFields())) {
        $sortField = 'price';
    }
    
    if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
        $sortOrder = 'asc';
    }
    $from = $page_number==1 ? 1 : ($page_number-1)*$itemsPerPage;
    //добавить авторов книг
    $sql = "SELECT book.id, book.title, book.price, GROUP_CONCAT(author.name SEPARATOR ', ') AS authors_name,
            GROUP_CONCAT(author.id SEPARATOR ', ') AS authors_id
            FROM book JOIN (book_author JOIN author ON book_author.author_id = author.id)ON book.id = book_author.book_id
            AND book.title like '%$search%'
            WHERE status = 1 
            GROUP BY book.id
            ORDER BY {$sortField} {$sortOrder} 
            LIMIT  $from, $itemsPerPage";
    //echo   $sql;      
    $res = mysqli_get_result($link, $sql);
    
    // todo: make with: while() + mysqli_fetch_assoc()
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function count_allbook($link, $search="")
{
    //добавить авторов книг
    $sql = "SELECT COUNT(*) as count
            FROM book JOIN (book_author JOIN author ON book_author.author_id = author.id)ON book.id = book_author.book_id
            AND book.title like '%$search%'
            WHERE status = 1 
            ";
    //echo   $sql;      
    $res = mysqli_get_result($link, $sql);
    $res =  mysqli_fetch_assoc($res);
    return (int)$res['count'];
}

function findBookById($link, $id)
{
    $id = (int) $id;
    $sql = "select * from book where id = ?";
    
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    
    $res = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_assoc($res);
}


function findBooksByParam($link,$sortField, $sortOrder, $page_number,$itemsPerPage,$pole, $param_id){
    $param_id = (int)$param_id;
    $from = $page_number==1 ? 1 : ($page_number-1)*$itemsPerPage;
    $sql = "SELECT book.id, book.title, book.price, GROUP_CONCAT(author.name SEPARATOR ', ') AS authors_name,
            GROUP_CONCAT(author.id SEPARATOR ', ') AS authors_id
            FROM book JOIN (book_author JOIN author ON book_author.author_id = author.id)ON book.id = book_author.book_id
            AND $pole = ?
            WHERE status = 1 
            GROUP BY book.id
            ORDER BY {$sortField} {$sortOrder}
            LIMIT  $from, $itemsPerPage";
    //echo $sql;        
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $param_id);
    mysqli_stmt_execute($stmt);
    
    $res = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function count_parambook($link, $pole, $param_id)
{
    $param_id = (int)$param_id;
    $sql = "SELECT COUNT(*)as count
            FROM book JOIN (book_author JOIN author ON book_author.author_id = author.id)ON book.id = book_author.book_id
            AND $pole = ?
            WHERE status = 1 
            ";
    //echo $sql;        
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $param_id);
    mysqli_stmt_execute($stmt);
    
    $res = mysqli_stmt_get_result($stmt);
    
    $res =  mysqli_fetch_assoc($res);
    return (int)$res['count'];
}