<?php

namespace App\Repositories;

interface PublisherRepository
{
    function getAllPublisher();
    function getPublisherById($publisherId);
    function createPublisher($data);
    function updatePublisher($data);
    function deletePublisher($publisherId);
    function changeStatus($data);
}
