<?php

namespace Validator;

class Validator
{

    private $dataReference;

    public function __construct($dataReference)
    {
        $this->dataReference = $dataReference;
    }

    public function validateData($request)
    {
        $errors = [];
        foreach($request as $key => $value) {
            switch ($key) {
                case 'email':
                    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = 'Email address is not valid';
                    }
                    break;
                case 'value':
                    if (!is_numeric($value)) {
                        $errors[] = 'The value used for comparison is not numeric';
                    }
                    break;
            }
        }

        if (!empty($errors)) {
            return $errors;
        }

        return true;
    }

    public function validateCondition($request)
    {
        $referenceValue = $this->dataReference[$request['currency']];
        $condition = $request['condition'];

        switch($condition) {
            case 'gt':
                if ($request['value'] < $referenceValue) {
                    return true;
                }
                break;
            case 'lt':
                if ($request['value'] > $referenceValue) {
                    return true;
                }
                break;
            case 'eq':
                if ($request['value'] = $referenceValue) {
                    return true;
                }
                break;
            default:
                return false;
        }

        return false;

    }
}