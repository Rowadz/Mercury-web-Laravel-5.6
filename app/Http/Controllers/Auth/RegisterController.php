<?php

namespace Mercury\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mercury\Http\Controllers\Controller;
use Mercury\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //  'image' => 'image|max:100000',
        return Validator::make($data, [
            'name' => 'required|string|max:255|min:3|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'dateOfBirth' => 'Date',
            'city' => 'required|string',
            'phone' => 'required|string|min:0|max:10,unique:users',
            'about' => 'string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Mercury\User
     */
    private $cities = ["Amman", "Zarqa", "Irbid", "Aqaba", "As-Salt",
        "Madaba", "Mafraq", "Jerash", "Ma'an", "Tafilah", "Karak"];
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'API_KEY' => $data['name'] . bcrypt(Carbon::now()->toDateTimeString()),
            'dateOfBirth' => $data['dateOfBirth'],
            'image' => "http://lorempixel.com/800/600/cats/",
            'city' => $this->cities[$data['city']],
            'phone' => $data['phone'],
            'about' => $data['about'],

        ]);
    }
}
