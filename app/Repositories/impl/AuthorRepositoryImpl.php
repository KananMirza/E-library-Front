<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\AuthorRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class AuthorRepositoryImpl implements AuthorRepository
{
    use OperationTrait;
    private $apiRequest;

    public function __construct(RequestApi $request)
    {
        $this->apiRequest = $request;
    }

    /**
     * @throws DataNotFoundException
     */
    function getAllAuthor()
    {
        $response = $this->apiRequest->get("/author/get-all");
        return $this->checkData($response,false);
    }

    /**
     * @throws DataNotFoundException
     */
    function getAuthorById($authorId)
    {
        $response = $this->apiRequest->get('/author/get/'.$authorId);
        return $this->checkData($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function createAuthor($data)
    {
        $requestData = $this->dataForImage($data,"author");
        $response = $this->apiRequest->post("/author/create",$requestData,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function updateAuthor($data)
    {
        $requestData = $data;
        if(!empty($data['imageType']) && !empty($data['imageBase64'])){
            $requestData = $this->dataForImage($data,"author");
        }
        $response = $this->apiRequest->post("/author/update",$requestData,true);
        return $this->checkDataCreateOrUpdate($response,true);

    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function deleteAuthor($authorId)
    {
        $response = $this->apiRequest->delete("/author/delete/".$authorId);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function changeStatus($data)
    {
        $response = $this->apiRequest->post("/author/change-status",$data,true);
        return $this->checkDataCreateOrUpdate($response,true);

    }
}
