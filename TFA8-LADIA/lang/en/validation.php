<?php

return [
    'accepted' => 'The :attribute field must be accepted.',
    'current_password' => 'The password is incorrect.',
    'confirmed' => 'The :attribute field confirmation does not match.',
    'email' => 'The :attribute field must be a valid email address.',
    'image' => 'The :attribute field must be an image.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'mimes' => 'The :attribute field must be a file of type: :values.',
    'required' => 'The :attribute field is required.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'string' => 'The :attribute field must be a string.',
    'max' => [
        'array' => 'The :attribute field must not have more than :max items.',
        'file' => 'The :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute field must not be greater than :max.',
        'string' => 'The :attribute field must not be greater than :max characters.',
    ],
    'min' => [
        'array' => 'The :attribute field must have at least :min items.',
        'file' => 'The :attribute field must be at least :min kilobytes.',
        'numeric' => 'The :attribute field must be at least :min.',
        'string' => 'The :attribute field must be at least :min characters.',
    ],
    'password' => [
        'letters' => 'The :attribute field must contain at least one letter.',
        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'custom' => [],
    'attributes' => [],
];
