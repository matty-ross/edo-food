<?php

function is_valid_string($value)
{
    $invalid_values =
    [
        null,
        '',
    ];
    
    return
        !in_array($value, $invalid_values, true) &&
        is_string($value);
}

function is_valid_number($value)
{
    $invalid_values =
    [
        null,
        '',
    ];
    
    return
        !in_array($value, $invalid_values, true) &&
        is_numeric($value);
}

function is_valid_bool($value)
{
    $valid_values =
    [
        false,
        true,
    ];
    
    return in_array($value, $valid_values);
}

function is_valid_date($value)
{
    if (!is_valid_string($value))
    {
        return false;
    }
    
    // https://www.codexworld.com/how-to/validate-date-input-string-in-php/
    $format = 'Y-m-d';
    $d = DateTime::createFromFormat($format, $value);
    return $d && $d->format($format) === $value;
}

function is_valid_numeric_array($values)
{
    if (!is_array($values))
    {
        return false;
    }
    
    foreach ($values as $value)
    {
        if (!is_valid_number($value))
        {
            return false;
        }
    }
    
    return true;
}

function is_valid_meal_type($value)
{
    $valid_values =
    [
        'soup',
        'main_dish',
    ];
    
    return
        is_valid_string($value) &&
        in_array($value, $valid_values, true);
}

?>