<?php

namespace App\Core\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];

    public function validate(array $data): bool
    {
        foreach ($data as $key => $value) {

            $error = $this->validateRule($value, $key);

            if ($error) {
                $this->errors[] = $error;
            }
        }
        return empty($this->errors);
    }

    public function errors(): array|string
    {
        return $this->errors;
    }


    private function validateRule(mixed $value, string $key): string|false
    {
        $patterns = [
            'name' => "/^.+$/",
            'lastname' => "/^.+$/",
            'nickname' => "/[a-zA-Z_0-9]{1,16}$/",
            'email' => "/(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/",
            'password' => '/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/',
            'type' => '/^image\/(jpeg|jpg|gif|png|bmp|webp|svg|ico)$/i',
            'comment' => '/^.{1,255}/',
        ];

        $errors = [
            'name' => "Ошибка при обработке данных на сервере: поле имя не может быть пустым",
            'lastname' => "Ошибка при обработке данных на сервере: поле фамилия не может быть пустым",
            'login' => "Ошибка при обработке данных на сервере: Никнейм может содержать только: буквы латинского алфавита, цифры и знаки
                    подчеркивания",
            'email' => "Ошибка при обработке данных на сервере: Некорректный имейл",
            'password' => "Ошибка при обработке данных на сервере: пароль: от 8-15 символов, с минимум одной цифрой, одной заглавной и
                одной строчной буквой.",
            'type' => "Недопустимый формат файла",
            'comment' => "Комментарий не может быть пустым",
        ];
        if (preg_match($patterns[$key], $value)) {
            return false;
        } else {
            return $errors[$key];
        }
    }
}