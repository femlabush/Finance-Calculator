<?php

class Validator {

    // Validate a single field against a set of rules.
    public static function validate($field, $value, $rules = []) {
        $errors = [];

        // required
        if (in_array('required', $rules) && (!isset($value) || $value === '')) {
            $errors[] = "{$field} is required";
            return $errors; 
        }

        // number
        if (in_array('number', $rules) && !is_numeric($value)) {
            $errors[] = "{$field} must be a valid number";
        }

        // positive
        if (in_array('positive', $rules) && is_numeric($value) && $value <= 0) {
            $errors[] = "{$field} must be greater than zero";
        }

        return $errors;
    }

    // Validate multiple fields at once and merge all errors.
    public static function validateAll(array $fields, $params): array {
        $errors = [];
        foreach ($fields as [$field, $value, $rules]) {
            $errors = array_merge($errors, self::validate($field, $params[$field] ?? null, $rules));
        }
        return $errors;
    }
}
