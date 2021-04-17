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

    'accepted' => ':attribute musí byť prijatý.',
    'active_url' => ':attribute nie je platná adresa URL.',
    'after' => ':attribute musí byť dátum po :date.',
    'after_or_equal' => ':attribute dátum musí byť nasledujúci alebo rovnaký ako :date.',
    'alpha' => ':attribute môže obahovať iba písmená.',
    'alpha_dash' => ':attribute môže obsahovať iba písmená, čísla, pomlčky a podčiarknutia.',
    'alpha_num' => ':attribute môže obsahovať iba písmená a čísla.',
    'array' => ':attribute musí byť pole.',
    'before' => ':attribute musí byť dátum pred :date.',
    'before_or_equal' => ':attribute musí byť dátum pred alebo rovnaký ako :date.',
    'between' => [
        'numeric' => ':attribute musí byť medzi :min a :max.',
        'file' => ':attribute musí byť medzi :min a :max kilobytes.',
        'string' => ':attribute musí byť medzi :min a :max znakmi.',
        'array' => ':attribute musí byť medzi :min a :max prvkami.',
    ],
    'boolean' => ':attribute pole musí byť true alebo false.',
    'confirmed' => 'Potvrdenie :attribute nezodpovedá.',
    'date' => ':attribute nie je platný dátum.',
    'date_equals' => ':attribute musí byť dátum rovný :date.',
    'date_format' => ':attribute nezodpovedá formátu :format.',
    'different' => ':attribute a :other sa musia líšiť.',
    'digits' => ':attribute musí byť :digits číslica.',
    'digits_between' => ':attribute musí byť medzi :min a :max číslicami.',
    'dimensions' => ':attribute má neplatné rozmery obrázka.',
    'distinct' => ':attribute pole má duplicitnú hodnotu.',
    'email' => ':attribute musí byť platná e-mailová adresa.',
    'ends_with' => ':attribute musí končiť s jedným z nasledujúcich: :values.',
    'exists' => 'Vybraný :attribute je neplatný.',
    'file' => ':attribute musí byť súbor.',
    'filled' => ':attribute pole musí mať hodnotu.',
    'gt' => [
        'numeric' => ':attribute musí byť väčší ako :value.',
        'file' => ':attribute musí byť väčší ako :value kilobytes.',
        'string' => ':attribute musí byť väčší ako :value znak.',
        'array' => ':attribute musí obsahovať viac ako :value prvok.',
    ],
    'gte' => [
        'numeric' => ':attribute musí byť väčší alebo rovnaký :value.',
        'file' => ':attribute musí byť väčší alebo rovný :value kilobytes.',
        'string' => ':attribute musí byť väčší alebo rovný :value znak.',
        'array' => ':attribute musí mať :value prvok alebo viac.',
    ],
    'image' => ':attribute musí byť obrázok.',
    'in' => 'Vybraný :attribute je neplatný.',
    'in_array' => ':attribute pole neexistuje v :other.',
    'integer' => ':attribute musí byť celé číslo.',
    'ip' => ':attribute musí byť platná IP adresa.',
    'ipv4' => ':attribute musí byť platná IPv4 addresa.',
    'ipv6' => ':attribute musí byť platná IPv6 addresa.',
    'json' => ':attribute musí byť platný reťazec JSON.',
    'lt' => [
        'numeric' => ':attribute musí byť menší ako :value.',
        'file' => ':attribute musí byť menší ako :value kilobytes.',
        'string' => ':attribute musí byť menší ako :value znaky.',
        'array' => ':attribute musí byť menší ako :value prvok.',
    ],
    'lte' => [
        'numeric' => ':attribute musí byť menší alebo rovný ako :value.',
        'file' => ':attribute musí byť menší alebo rovný :value kilobytes.',
        'string' => ':attribute musí byť menší alebo rovný :value znaky.',
        'array' => ':attribute nesmie obsahovať viac ako :value prvok',
    ],
    'max' => [
        'numeric' => ':attribute nesmie byť väčší ako :max.',
        'file' => ':attribute nesmie byť väčší ako :max kilobytes.',
        'string' => ':attribute nesmie byť väčší ako :max znakov.',
        'array' => ':attribute nesmie obsahovať viac ako :max prvok.',
    ],
    'mimes' => ':attribute musí byť súbor type: :values.',
    'mimetypes' => ':attribute musí byť súbor type: :values.',
    'min' => [
        'numeric' => ':attribute musí byť aspoň :min.',
        'file' => ':attribute musí byť aspoň :min kilobytes.',
        'string' => ':attribute musí obsahovať aspoň :min znakov.',
        'array' => ':attribute musí obsahovať aspoň :min prvkov.',
    ],
    'not_in' => 'Vybraný :attribute je neplatný.',
    'not_regex' => 'Formát :attribute je neplatný.',
    'numeric' => ':attribute musí byť číslo.',
    'password' => 'Heslo je nesprávne.',
    'present' => ':attribute musí mať uvedené pole',
    'regex' => 'Formát :attribute je neplatný.',
    'required' => 'Vyžaduje sa pole :attribute.',
    'required_if' => 'Pole :attribute je povinné, keď :other je :value.',
    'required_unless' => 'Pole :attribute je povinné, ak :other je v :values.',
    'required_with' => 'Pole :attribute je vyžiadané, ak :values sú prítomné.',
    'required_with_all' => 'Pole :attribute je potrebné, ak :values sú prítomné.',
    'required_without' => 'Pole :attribute je vyžiadané, keď :values nie sú prítomné.',
    'required_without_all' => 'Pole :attribute je povinný, ak nie je prítomná žiadna z :values.',
    'same' => ':attribute a :other sa musia zhodovať.',
    'size' => [
        'numeric' => ':attribute musí byť :size.',
        'file' => ':attribute musí byť :size kilobytes.',
        'string' => ':attribute musí byť :size znakov.',
        'array' => ':attribute musí obsahovať :size prvkov.',
    ],
    'starts_with' => ':attribute musí začínať jedným z following: :values.',
    'string' => ':attribute musí byť platný reťazec.',
    'timezone' => ':attribute musí byť platná zóna',
    'unique' => ':attribute už bol prijatý.',
    'uploaded' => ':attribute sa nepodarilo nahrať.',
    'url' => 'Formát :attribute je neplatný.',
    'uuid' => ':attribute musí byť platný UUID.',

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
            'rule-name' => 'vlastná správa',
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

    'attributes' => [],

];
