<?php

namespace Mvaliolahi\Hydrate;

class Hydrate
{
    /**
     * @var mixed
     */
    protected $classVars;

    /**
     * @param $object
     * @param array $override
     * @return mixed
     */
    public function to($object, $data, $override = [])
    {
        $object = new $object;

        foreach (array_replace($data, $override) as $property => $value) {

            // exact version.
            if ($this->propertyExists($object, $property)) {
                $object->$property = $value;
                continue;
            }

            // camel case version.
            if ($this->propertyExists($object, $property = $this->toCamel($property))) {
                $object->$property = $value;
                continue;
            }

            // setter version.
            $methodName = "set{$this->toUcFirstCamel($property)}";
            if (method_exists($object, $methodName)) {
                $object->$methodName($value);
                continue;
            }
        }

        return $object;
    }

    /**
     * @param string $string
     * @return string
     */
    private function toCamel($string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

    /**
     * @param string $string
     * @return string
     */
    private function toUcFirstCamel($string)
    {
        return ucfirst($this->toCamel($string));
    }

    /**
     * @param mixed $object
     * @param string $property
     * @return boolean
     */
    private function isPublicProperty($object, $property)
    {
        /**
         * @var array
         */
        $classVars = $this->classVars($object);

        if (in_array($property, $classVars)) {
            return true;
        }

        return false;
    }

    /**
     * @param object $object
     * @return void
     */
    private function classVars($object)
    {
        if ($this->classVars) {
            return $this->classVars;
        }

        return $this->classVars = array_keys(get_class_vars(get_class($object)));
    }

    /**
     * @param object $object
     * @param string $property
     * @return bool
     */
    private function propertyExists($object, $property)
    {
        if (property_exists($object, $property) && $this->isPublicProperty($object, $property)) {
            return true;
        }

        return false;
    }
}
