<?php

namespace App\Repositories;

interface LeaseStatusRepository
{
    function getAllLeaseStatus();
    function getLeaseStatusById($leaseStatusId);
    function createLeaseStatus($data);
    function updateLeaseStatus($data);
    function deleteLeaseStatus($leaseStatusId);
}
