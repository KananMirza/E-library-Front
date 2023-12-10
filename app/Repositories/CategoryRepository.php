<?php

namespace App\Repositories;

interface CategoryRepository
{
    function getAllCategory();
    function getCategoryById($categoryId);
    function createCategory($data);
    function updateCategory($data);
    function deleteCategory($categoryId);
    function changeStatus($data);
}
