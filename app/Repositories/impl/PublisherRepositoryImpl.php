<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\PublisherRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class PublisherRepositoryImpl implements PublisherRepository
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
    function getAllPublisher()
    {
        $response = $this->apiRequest->get('/publisher/get-all');
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getPublisherById($publisherId)
    {
        $response = $this->apiRequest->get('/publisher/get/'.$publisherId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createPublisher($data)
    {
        $response = $this->apiRequest->post('/publisher/create',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updatePublisher($data)
    {
        $response = $this->apiRequest->post('/publisher/update',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function deletePublisher($publisherId)
    {
        $response = $this->apiRequest->delete("/publisher/delete/".$publisherId);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function changeStatus($data)
    {
        $response = $this->apiRequest->post("/publisher/change-status",$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
