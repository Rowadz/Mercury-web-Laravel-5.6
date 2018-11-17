<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Mercury\User;

class RealTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getUser(int $id )
    {
        return User::find($id);
    }
}
