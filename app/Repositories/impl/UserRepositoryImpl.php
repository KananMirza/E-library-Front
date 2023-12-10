<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\UserRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class UserRepositoryImpl implements  UserRepository
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
    function getAllUser()
    {
        $response = $this->apiRequest->get('/user/get-all');
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getUserById($userId)
    {
        $response = $this->apiRequest->get('/user/get/'.$userId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function changeStatus($data)
    {
        $response = $this->apiRequest->post("/user/change-status",$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
