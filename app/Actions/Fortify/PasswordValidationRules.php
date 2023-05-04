<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        $password = new Password;

        $password->length(8)->requireUppercase()->requireNumeric()->requireSpecialCharacter();

        return ['required', 'string', $password, 'confirmed'];
    }
}
