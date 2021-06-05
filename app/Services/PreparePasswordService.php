<?php
namespace App\Services;

class PreparePasswordService{
    public function checkPassword($data)
    {
        if(!empty($data["password"])){
            $data["password"] = Hash::make($data["password"]);
        } else {
            unset($data["password"]);
        }
        return $data;
    }
}