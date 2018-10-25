<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mercury\User;

class registerValidation extends Controller
{
    /**
     * 
     *
     * @param string $name
     * @return string
     */
    public function chackName(string $name)
    {

        $validator = Validator::make(['name' => $name], [
            'name' => 'required|string|max:255|min:3|unique:users',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorsToBuildMessage = [];
            foreach ($errors->get('name') as $error) {
                array_push($errorsToBuildMessage, $error);
            }
            $message = implode(', ', $errorsToBuildMessage);
            return response()->json(['message' => "{$message} ❌"]);
        } else return response()->json(['message' => 'valid user name ✔️']); 
    }

    /**
     *
     * @param string $email
     * @return string
     */
    public function checkEmail(string $email){
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorsToBuildMessage = [];
            foreach ($errors->get('email') as $error) {
                array_push($errorsToBuildMessage, $error);
            }
            $message = implode(', ', $errorsToBuildMessage);
            return response()->json(['message' => "{$message} ❌"]);
        } else return response()->json(['message' => 'valid email ✔️']); 
    }

    
}
