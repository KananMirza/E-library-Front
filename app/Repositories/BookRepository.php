<?php

namespace App\Repositories;

interface BookRepository
{
    function getAllBook();
    function getBookById($bookId);
    function createBook($data);
    function updateBook($data);
    function deleteBook($bookId);
    function changeStatus($data);
}
