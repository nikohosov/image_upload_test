<?php
namespace controllers\validators;

use base\core\Component;
use base\core\RequestValidatorInterface;

class ImageSearchValidator extends Component implements RequestValidatorInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function validate(array $data)
    {
        $errors = [];

        if (!array_key_exists('search', $data) ) {
            $errors[] = "Request must contain search string";
            return $errors;
        }
    }


}