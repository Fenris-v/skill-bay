<?php
namespace App\Services;
use Illuminate\Support\Facades\Hash;

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