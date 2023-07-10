<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laratrust\LaratrustFacade;

use function Ramsey\Uuid\v1;

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
    protected $redirectTo = '/employee';

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
        // return Validator::make($data, [
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'mi' => ['required', 'string', 'max:255'],
        //     'position' => ['required', 'string', 'max:255'],
        //     'office' => ['required', 'string', 'max:25'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mi' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'office' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->passes()) {
            User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'mi' => $data['mi'],
                'position' => $data['position'],
                'office' => $data['office'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            return response()->json(["success" => true, "message" => "Successfully created an account!"]);
        } else {
            return response()->json(["success" => false, "message" => "Error making an account!"]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        dd("create");
        // // Perform the user registration process
        // $user = User::create([
        //     'first_name' => $data['first_name'],
        //     'last_name' => $data['last_name'],
        //     'mi' => $data['mi'],
        //     'position' => $data['position'],
        //     'office' => $data['office'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        // // Return success response
        // return response()->json(["success" => true, "message" => "Successfully created an account!"]);
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mi' => $data['mi'],
            'position' => $data['position'],
            'office' => $data['office'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
