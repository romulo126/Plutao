<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RepositoryRule implements Rule
{
    private $result = true;
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
        $this->check($value,'.git');
        $this->check($value,'www.');
        $this->check($value,'https://github.com');
        $this->check($value,'github.com');

        return $this->result;
    }

    private function check($value,$valueCheck)
    {
        if($this->result)
        {
            $this->result = !str_contains($value,'.git');
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Just inform the example repository: romulo126/BotInstagramGetPosts';
    }
}
