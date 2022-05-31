<?php

namespace App\Validation;

class NewScreenshotValidation
{
    private const NAME_FIELD = 'name';

    private $name;
    private $screenshot;

    private $errors = [];

    public function __construct($request, $file)
    {
        $this->name = $request['name'];
        $this->screenshot = $file;
    }

    public function isValid(): bool
    {
        return $this->validateName() && $this->validateScreenshot();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function validateName(): bool
    {

        if (!empty($this->name)) {
            return true;
        } else {
            array_push($this->errors, $this->getEmptyFieldMessage(self::NAME_FIELD));
            return false;
        }
    }

    private function validateScreenshot(): bool
    {

        $extension = strtolower(pathinfo($this->screenshot['name'])['extension']) ?? "";
        $type = $this->screenshot['type'];

        if (!($type == "image/jpeg" && ($extension == 'jpg' || $extension == 'jpeg'))) {
            array_push($this->errors, 'Ошибка! Заданный формат файла не поддерживается');
            return false;
        }

        if ($this->screenshot['size'] > 3 * pow(2, 20)) {
            array_push($this->errors, 'Ошибка! Заданный файл слишком большой!');
            return false;
        }
        return true;
    }

    private function getEmptyFieldMessage($fieldName): string
    {
        return "Поле " . $fieldName . " обязательное для заполнения!";
    }

}