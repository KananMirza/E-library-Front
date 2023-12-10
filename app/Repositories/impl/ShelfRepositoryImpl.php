<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\ShelfRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class ShelfRepositoryImpl implements ShelfRepository
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
    function getAllShelf()
    {
        $response = $this->apiRequest->get('/shelf/get-all');
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getShelfById($shelfId)
    {
        $response = $this->apiRequest->get('/shelf/get/'.$shelfId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createShelf($data)
    {
        $response = $this->apiRequest->post('/shelf/create',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updateShelf($data)
    {
        $response = $this->apiRequest->post('/shelf/update',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function deleteShelf($shelfId)
    {
        $response = $this->apiRequest->delete("/shelf/delete/".$shelfId);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function changeStatus($data)
    {
        $response = $this->apiRequest->post("/shelf/change-status",$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
