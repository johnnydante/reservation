<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'date' => 'Pole :attribute nie jest datą.',
    'date_format' => 'Pole :attribute nie pasuje do formatu :format.',
    'after' => 'Pole :attribute musi być datą po :date.',
    'email' => 'Pole :attribute zawiera nie prawidłowy e-mail.',
    'numeric' => 'Pole :attribute musi być liczbą.',
    'required' => 'Pole :attribute jest wymagane.',
    'unique' => 'Wartość pola :attribute już jest zajęta.',
    'exists' => 'W bazie danych brak wskazanego :attribute.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'Nazwa pojazdu',
        'type' => 'Typ pojazdu',
        'key' => 'Klucz pojazdu',
        'vehicleId' => 'Id pojazdu',
        'email' => 'Adres e-mail',
        'fromDate' => 'Początek rezerwacji',
        'toDate' => 'Koniec rezerwacji',
    ],

];
