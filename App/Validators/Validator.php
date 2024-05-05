<?php

namespace App\Validators;

use Exception;

class Validator
{
    /**
     * 資料格式驗證
     * 
     * @param array $input
     * @param array $patterns
     * 
     * @return array|null
     * 
     * @throws \Exception
     */
    public static function errors(array $input, array $patterns)
    {
        $errors = [];

        foreach ($input as $key => $value) {
            if (!isset($patterns[$key])) {
                continue;
            }

            if (($isValid = preg_match($patterns[$key], $value)) === false) {
                throw new Exception('Invalid regular expression');
            }

            if ($isValid) {
                continue;
            }

            $errors[] = $key;
        }

        return $errors ?: null;
    }
}
