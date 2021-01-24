<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class PasswordHIBP implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //hash password with SHA-1
        $hashed=strtoupper(Http::get('https://api.hashify.net/hash/sha1/hex?value='.$value)['Digest']);

        $first5=substr($hashed,0,5);
        $rest=substr($hashed,5);

        $HIBPArray=explode("\r\n",file_get_contents('https://api.pwnedpasswords.com/range/'.$first5));

        foreach($HIBPArray as $hash){
            if(substr($hash,0,35) == $rest){
                $freq= substr($hash, strpos($hash,":")+1);
                if ($freq > 300){
                    return false;
                }else{
                    return true;
                }
            };

        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'According to HaveIBeenPwned.com, this pw has been found in data breaches more than 300 times! Please choose something else';
    }
}
