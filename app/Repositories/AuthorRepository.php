<?php

namespace App\Repositories;

interface AuthorRepository
{
    function getAllAuthor();
    function getAuthorById($authorId);
    function createAuthor($data);
    function updateAuthor($data);
    function deleteAuthor($authorId);
    function changeStatus($data);
}
