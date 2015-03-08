<?php

namespace Addressable\Bundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates longitude value
 *
 */
class LongitudeValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        $valid = true;

        // ensure its the right format
        if (!preg_match('/^[0-9\-\.]+$/', $value, $matches)) {
            $valid = false;
        }

        // ensure its in the range -180 and 180
        if ($value['longitude'] > 180 || $value['longitude'] < -180) {
            $valid = false;
        }

        if (!$valid) {
            $this->context->addViolation(
                $constraint->message,
                array('%value%' => $value)
            );
        }        
    }
}
