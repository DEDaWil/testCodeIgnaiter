<?php

namespace App\Validation;

class CustomRules
{
    public function validateNumber($value, string $fields, array $data, string &$error = null): bool
    {
        // Распаковываем параметры: totalDigits,fractionDigits
        [$totalDigits, $fractionDigits] = explode(',', $fields);

        // Проверяем общий формат числа
        if (!is_numeric($value)) {
            $error = 'The value must be a valid number.';
            return false;
        }

        // Разбиваем число на целую и дробную часть
        $parts = explode('.', (string) $value);
        $integerPart = $parts[0];
        $decimalPart = $parts[1] ?? '';

        // Проверяем общее количество цифр
        if (strlen($integerPart . $decimalPart) > (int) $totalDigits) {
            $error = "The total number of digits cannot exceed $totalDigits.";
            return false;
        }

        // Проверяем количество дробных цифр
        if (strlen($decimalPart) > (int) $fractionDigits) {
            $error = "The number of fractional digits cannot exceed $fractionDigits.";
            return false;
        }

        return true;
    }

}