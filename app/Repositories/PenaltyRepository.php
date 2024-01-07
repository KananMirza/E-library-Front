<?php

namespace App\Repositories;

interface PenaltyRepository
{
    function getAllPenalties();
    function getPenaltyById($authorId);
    function createPenalty($data);
    function updatePenalty($data);
}
