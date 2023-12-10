<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\LeaseStatusRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class LeaseStatusRepositoryImpl implements LeaseStatusRepository
{
    use OperationTrait;
    private RequestApi $apiRequest;

    public function __construct(RequestApi $request)
    {
        $this->apiRequest = $request;
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getAllLeaseStatus()
    {
        $response = $this->apiRequest->get('/lease-status/get-all');
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getLeaseStatusById($leaseStatusId)
    {
        $response = $this->apiRequest->get('/lease-status/get/'.$leaseStatusId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createLeaseStatus($data)
    {
        $response = $this->apiRequest->post('/lease-status/create',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updateLeaseStatus($data)
    {
        $response = $this->apiRequest->post('/lease-status/update',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function deleteLeaseStatus($leaseStatusId)
    {
        $response = $this->apiRequest->delete("/lease-status/delete/".$leaseStatusId);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
