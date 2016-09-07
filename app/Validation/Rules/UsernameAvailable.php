<?php


namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class UsernameAvailable extends AbstractRule
{
    
    public function validate($input){
        //CHECK TO SEE IF THE USERNAME IS TAKEN USING THE USER MODEL {THIS WILL RETURN TRUE IF NO USERNAME EXISTS}
        return User::where('username', $input)->count() === 0;
    }
}