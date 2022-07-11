<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Auth;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'email' => ['required','string','email','max:255',
             Rule::unique(User::class),],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'company_id' => Auth::user()->company_id,
            'role_id' => $input['role_id'],
            'employee_id' => $input['employee_id'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
