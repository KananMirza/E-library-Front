<?php

namespace App\Traits;

use App\Exceptions\AjaxException;
use App\Exceptions\DataNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

trait OperationTrait
{
    /**
     * @param $data
     * @param $isAjax
     * @return RedirectResponse|mixed
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function checkData($data,$isAjax): mixed
    {
        if(empty($data['status'])){
            session()->flush();
            return false;
        }
        if($data['status'] != 200 && $data['status'] != 201){
            if(!$isAjax){
                throw new DataNotFoundException(!empty($data['message']) ? $data['message'] : "Data not found!");
            }else{
                throw new AjaxException(!empty($data['message']) ? $data['message'] : "Data not found!");
            }
        }
        return $data['body'];
    }

    /**
     * @throws AjaxException
     * @throws DataNotFoundException
     */
    function checkDataCreateOrUpdate($data, $isAjax){
        if(empty($data['status'])){
            session()->flush();
            throw new AjaxException("Your session has expired. Please log in again.");
        }
        if($data['status'] !== 200 && $data['status'] != 201){
            if(!$isAjax){
                throw new DataNotFoundException(!empty($data['message']) ? $data['message'] : "Data not found!");
            }else{
                throw new AjaxException(!empty($data['message']) ? $data['message'] : "Data not found!");
            }
        }
        return $data['message'];
    }
    function dataForImage($data)
    {
        $imageFile = [
            "fileType"=>$data["imageType"],
            "fileBase64"=>$data["imageBase64"],
        ];
        unset($data["imageType"]);
        unset($data["imageBase64"]);
        $data["imageFile"] = $imageFile;
        return $data;
    }
}
