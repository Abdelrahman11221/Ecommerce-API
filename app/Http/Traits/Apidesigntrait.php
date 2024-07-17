<?php
namespace App\Http\Traits;

trait Apidesigntrait{

    public function apiresponse($status = 200 , $message = null , $error = null , $data = null)
    {
        $array = [
            'status' => $status,
            'message' => $message
        ];
        if (!is_null($error) && is_null($data))
        {
            $array['error']=$error;
        }
        elseif (is_null($error) && !is_null($data)){
            $array['data']=$data;
        }
        else{
            $array['error']=$error;
            $array['data']=$data;
        }
        return response($array , 200);
    }
}
?>