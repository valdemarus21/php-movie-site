<?php

namespace App\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $data = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;
        foreach ($rules as $key => $rule) {
            $rules = $rule;

            foreach ($rules as $rule) {
                $rule = explode(':', $rule);

                $ruleName = $rule[0];

                $ruleValue = $rule[1] ?? null;


                $error = $this->validateRule($key, $ruleName, $ruleValue);

                if ($error) {
                    $this->errors[$key][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    private function validateRule(int|string $key, mixed $ruleName, mixed $ruleValue)
    {
        $value = $this->data[$key];
        switch ($ruleName) {
            case 'required' :
                if (empty($value)) {
                    return "Field $key is required";
                }
                break;
            case 'min' :
                if (strlen($value) < $ruleValue) {
                    return "Field $key must be at least {$ruleValue} characters long";
                }
                break;
            case 'max' :
                if (strlen($value) > $ruleValue) {
                    return "Field $key must be at most {$ruleValue} characters long";
                }

                break;
            case 'confirmed' :
                if ($value !== $this->data[$key."_confirmation"]) {
                    return "Field $key must be confirmed";
                }

                break;
            default :
                return false;

        }
    }

}