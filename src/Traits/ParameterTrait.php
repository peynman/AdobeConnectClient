<?php

namespace AdobeConnectClient\Traits;

use \AdobeConnectClient\Helper\StringCaseTransform as SCT;
use \AdobeConnectClient\Helper\BooleanTransform as B;

/**
 * Converts the public properties into an array to use in the WS call
 *
 * Works only for the not empty properties. False and null are considered empty values.
 */
trait ParameterTrait
{
    /**
     * Convert the public properties into an array to use in the WS call
     *
     * @return array
     */
    public function toArray()
    {
        $parameters = [];

        foreach ($this as $field => $value) {
            if (empty($value)) {
                continue;
            }

            if (is_bool($value)) {
                $value = B::toString($value);
            } elseif ($value instanceof \DateTimeInterface) {
                $value = $value->format(\DateTime::W3C);
            }

            $parameters[SCT::toHyphen($field)] = $value;
        }

        return $parameters;
    }
}
