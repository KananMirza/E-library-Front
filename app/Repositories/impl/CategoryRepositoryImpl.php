<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\CategoryRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class CategoryRepositoryImpl implements CategoryRepository
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
    function getAllCategory()
    {
        $response = $this->apiRequest->get('/category/get-all');
        return $this->checkData($response,false);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function getCategoryById($categoryId)
    {
        $response = $this->apiRequest->get('/category/get/'.$categoryId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createCategory($data)
    {
        $response = $this->apiRequest->post('/category/create',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updateCategory($data)
    {
        $response = $this->apiRequest->post('/category/update',$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function deleteCategory($categoryId)
    {
        $response = $this->apiRequest->delete("/category/delete/".$categoryId);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function changeStatus($data)
    {
        $response = $this->apiRequest->post("/category/change-status",$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
