<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\PenaltyRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class PenaltyRepositoryImpl implements PenaltyRepository
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
    function getAllPenalties()
    {
        $response = $this->apiRequest->get("/penalty/get-all");
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getPenaltyById($authorId)
    {
        $response = $this->apiRequest->get('/penalty/get/'.$authorId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createPenalty($data)
    {
        $response = $this->apiRequest->post('/penalty/create',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updatePenalty($data)
    {
        $response = $this->apiRequest->post('/penalty/update',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
