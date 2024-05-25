<?php

namespace App\Validators;

use Exception;

class Validator
{
    /**
     * @var array
     */
    private static array $filterTypes = [
        'domain' => FILTER_VALIDATE_DOMAIN,
        'email' => FILTER_VALIDATE_EMAIL,
        'float' => FILTER_VALIDATE_FLOAT,
        'int' => FILTER_VALIDATE_INT,
        'ip' => FILTER_VALIDATE_IP,
        'mac' => FILTER_VALIDATE_MAC,
        'url' => FILTER_VALIDATE_URL
    ];

    /**
     * 資料格式驗證
     * 
     * @param array $input
     * @param array $patterns
     * @param array $messages
     * 
     * @return array|null
     * 
     * @throws \Exception
     */
    public static function errors(array $input, array $patterns, array $messages = [])
    {
        $errors = [];

        foreach ($input as $key => $value) {
            if (!isset($patterns[$key])) {
                continue;
            }

            if (in_array($patterns[$key], array_keys(static::$filterTypes))) {
                $isValid = filter_var($value, static::$filterTypes[$patterns[$key]]);
            } else {
                $isValid = preg_match($patterns[$key], $value);
            }

            if (preg_last_error() !== PREG_NO_ERROR) {
                throw new Exception('Invalid regular expression');
            }

            if ($isValid === $value || ((bool) $isValid !== false)) {
                continue;
            }

            $errors[$key] = $messages[$key] ?? '';
        }

        return $errors ?: null;
    }
}
