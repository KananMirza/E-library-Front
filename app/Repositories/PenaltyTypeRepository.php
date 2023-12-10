<?php

namespace App\Repositories;

interface PenaltyTypeRepository
{
    function getAllPenaltyType();
    function getPenaltyTypeById($penaltyTypeId);
    function createPenaltyType($data);
    function updatePenaltyType($data);
    function deletePenaltyType($penaltyTypeId);
}
