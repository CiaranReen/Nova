<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 17/06/14
 * Time: 14:33
 */

/**
 * Class NovaBaseForm
 */
class Forms_Base
{
    /**
     * Contains the element properties in an array
     * @var array
     */
    protected $_element = array();

    /**
     * Set the element properties
     * @param $element
     * @return $this
     */
    public function setElement($element = array())
    {
        $this->_element[] = $element;
        return $this;
    }

    /**
     * @return $this
     */
    public function getElement()
    {
        return $this->_element;
    }

    /**
     * @param array $formSchema
     * @return array
     */
    public function addToForm($formSchema = array())
    {
        $formElements = array();
        foreach ($formSchema as $schema)
        {
            $formElements[] = '<label class="' . $schema['label-class'] . '">'. $schema['label'] .'</label><input class="' . $schema['class'] . '" type="' . $schema['type'] . '"
            name="' . $schema['name'] . '">';
        }
        return $formElements;
    }
}