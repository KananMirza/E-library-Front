<?php

namespace App\Repositories;

interface LeaseRepository
{
    function getAllLease();
    function createLease($data);
    function getLeaseById($id);
    function updateLease($data);
}
