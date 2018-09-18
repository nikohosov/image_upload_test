<?php
namespace controllers\validators;

use base\core\Component;
use base\core\RequestValidatorInterface;

class ImageUploadValidator extends Component implements RequestValidatorInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function validate(array $data)
    {
        $errors = [];

        if (!array_key_exists('images', $data) || !is_array($data['images'])) {
            $errors[] = "Request must contain images array";
            return $errors;
        }

        foreach ($data as $item) {

            if (!is_array($item)) {
                $errors[] = 'Invalid format';
                continue;
            }

            $validate_error = $this->validateRequestItem($item);

            if ($validate_error) {
                $errors[]  = $validate_error;
            }
        }
    }

    private function validateRequestItem(array $item)
    {
        if (!array_key_exists('base64', $item) && !array_key_exists('link', $item)) {
            return 'Item must contain base64 or link field';
        }
    }
}