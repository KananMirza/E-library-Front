<?php

namespace App\Repositories\impl;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use App\Repositories\BookRepository;
use App\Services\RequestApi;
use App\Traits\OperationTrait;

class BookRepositoryImpl implements BookRepository
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
    function getAllBook()
    {
        $response = $this->apiRequest->get("/book/get-all");
        return $this->checkData($response,false);
    }

    function getBookById($bookId)
    {
        // TODO: Implement getBookById() method.
    }

    function createBook($data)
    {
        unset($data['_token']);
        $file = $data->file('image');
        if(!$file){
            return redirect()->back()->with('imageError',true);
        }
        $encodedImage = base64_encode(file_get_contents($file->path()));
        $mimeType = explode('/',$file->getMimeType())[1];
        $imageFile = [
            'fileType'=>$mimeType,
            'fileBase64'=>$encodedImage
        ];
        $data['imageFile'] = $imageFile;
        $response = $this->apiRequest->post('/book/create',$data,true);
        if($response['status'] == 201){
            return $response['message'];
        }
        return false;
    }

    function updateBook($data)
    {
        // TODO: Implement updateBook() method.
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function deleteBook($bookId)
    {
        $response = $this->apiRequest->delete("/book/delete/".$bookId);
        return $this->checkDataCreateOrUpdate($response,true);
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function changeStatus($data)
    {
        $response = $this->apiRequest->post("/book/change-status",$data,true);
        return $this->checkDataCreateOrUpdate($response,true);
    }
}
