<?php

namespace App\Repositories;

interface ShelfRepository
{
    function getAllShelf();
    function getShelfById($shelfId);
    function createShelf($data);
    function updateShelf($data);
    function deleteShelf($shelfId);
    function changeStatus($data);
}
