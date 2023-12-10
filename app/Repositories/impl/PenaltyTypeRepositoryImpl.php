<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\PenaltyTypeRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class PenaltyTypeRepositoryImpl implements PenaltyTypeRepository
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
    function getAllPenaltyType()
    {
        $response = $this->apiRequest->get('/penalty-type/get-all');
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getPenaltyTypeById($penaltyTypeId)
    {
        $response = $this->apiRequest->get('/penalty-type/get/'.$penaltyTypeId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createPenaltyType($data)
    {
        $response = $this->apiRequest->post('/penalty-type/create',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updatePenaltyType($data)
    {
        $response = $this->apiRequest->post('/penalty-type/update',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function deletePenaltyType($penaltyTypeId)
    {
        $response = $this->apiRequest->delete("/penalty-type/delete/".$penaltyTypeId);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
