<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laratrust\LaratrustFacade;

use function Ramsey\Uuid\v1;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Get a validator for an incoming registration data.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createAccount(Request $request)
    {
        $role = Role::where('name', 'employee')->first();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required', 'string', 'max:255',
            'last_name' => 'required', 'string', 'max:255',
            'mi' => 'required', 'string', 'max:255',
            'position' => 'required', 'string', 'max:255',
            'office' => 'required', 'string', 'max:25',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);

        if ($validator->passes()) {
            // Registers User and assign the role to the user
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mi' => $request->mi,
                'position' => $request->position,
                'office' => $request->office,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])->roles()->attach($role);

            // LaratrustFacade::attachRole('employee', $user->id);

            return response()->json(["success" => true, "message" => "Successfully created an account!"]);
        } else {
            return response()->json(["success" => false, "message" => "Error making an account!"]);
        }
    }
}
