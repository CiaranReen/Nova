<?php

class CoursesForm extends Forms_Base
{
    /**
     * @return array
     */
    public function addForm()
    {
        $name = array (
            'label' => 'Course Name',
            'label-class' => 'control-label',
            'element' => 'input',
            'type' => 'text',
            'name' => 'name',
            'class' => 'form-control'
        );
        $this->setElement($name);

        $description = array (
            'label' => 'Description',
            'label-class' => 'control-label',
            'element' => 'input',
            'type' => 'text',
            'name' => 'description',
            'class' => 'form-control'
        );
        $this->setElement($description);

        return $this->addToForm($this->_element);
    }
}