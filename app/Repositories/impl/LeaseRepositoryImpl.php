<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\LeaseRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class LeaseRepositoryImpl implements LeaseRepository
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
    function getAllLease()
    {
        $response = $this->apiRequest->get("/lease/get-all");
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createLease($data)
    {
        $response = $this->apiRequest->post('/lease/create',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getLeaseById($id)
    {
        $response = $this->apiRequest->get('/lease/get/'.$id);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updateLease($data)
    {
        $response = $this->apiRequest->post('/lease/update',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
