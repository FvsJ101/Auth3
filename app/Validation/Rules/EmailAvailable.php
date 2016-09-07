<?php


namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class EmailAvailable extends AbstractRule
{
    public function validate($input)
    {
       
       //CHECK TO SEE IF THE EMAIL IS TAKEN USING THE USER MODEL {THIS WILL RETURN TRUE IF NO EMAIL EXISTS}
      return User::where('email', $input)->count() === 0;
       
    }
}