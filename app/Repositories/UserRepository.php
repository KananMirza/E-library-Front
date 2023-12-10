<?php

namespace App\Repositories;

interface UserRepository
{
    function getAllUser();
    function getUserById($userId);
    function changeStatus($data);
}
