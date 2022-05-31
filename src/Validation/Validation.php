<?php

namespace App\Validation;

class Validation
{
    private const LOGIN_FIELD = 'login';
    private const EMAIL_FIELD = 'email';
    private const PHONE_FIELD = 'phone';
    private const PASSWORD_FIELD = 'password';

    private const LOGIN_PATTERN = "/^[А-Яа-яЁё][А-Яа-яЁё\s-]{3,18}[А-Яа-яЁё]$/u";
    private const PASSWORD_PATTERN = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,18}$/";
    private const EMAIL_PATTERN = "/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
    private const PHONE_PATTERN = "/[0-9]{11}/";

    public static function validateRegisterRequest($request): array
    {
        return self::validateRequest($request,
            [self::LOGIN_FIELD, self::PASSWORD_FIELD, self::EMAIL_FIELD, self::PHONE_FIELD],
            [self::LOGIN_FIELD => self::LOGIN_PATTERN,
                self::PASSWORD_FIELD => self::PASSWORD_PATTERN,
                self::EMAIL_FIELD => self::EMAIL_PATTERN,
                self::PHONE_FIELD => self::PHONE_PATTERN]);
    }

    public static function validateAuthRequest($request): array
    {
        return self::validateRequest($request,
            [self::LOGIN_FIELD, self::PASSWORD_FIELD],
            [self::LOGIN_FIELD => self::LOGIN_PATTERN,
                self::PASSWORD_FIELD => self::PASSWORD_PATTERN]);
    }

    private static function validateRequest($request, $fields, $patterns): array
    {
        foreach ($request as $field => $value) {
            unset($fields[array_search($field, $fields)]);
        }

        $errors = [];

        if (!empty($fields)) {
            foreach ($fields as $field) {
                array_push($errors, self::getEmptyFieldMessage($field));
            }
            return $errors;
        }

        foreach ($request as $field => $value) {
            if ($value == null || $value == '') {
                array_push($errors, self::getEmptyFieldMessage($field));
                continue;
            }
            if (!isset($patterns[$field])) {
                continue;
            }
            $pattern = $patterns[$field];

            if (!preg_match($pattern, $value)) {
                array_push($errors, self::getBadFieldMessage($field));
            }
        }
        return $errors;
    }

    private static function getEmptyFieldMessage($fieldName): array
    {
        return ['Поле ' . $fieldName . ' обязательное для заполнения!'];
    }

    private static function getBadFieldMessage($fieldName): array
    {
        return ['Поле ' . $fieldName . ' некорректное!'];
    }
}