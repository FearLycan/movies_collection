<?php

class Application_Form_Add extends Zend_Form
{
    public function init()
    {
        $this->addAttribs(['action' => 'add']);

        $this->setMethod('post');

        $this->addElement('text', 'title', [
            'label' => 'Title',
            'required' => true,
        ]);

        $this->addElement('text', 'description', [
            'label' => 'Description',
            'required' => true,
        ]);

        $this->addElement('text', 'poster', [
            'label' => 'Poster URL',
            'required' => true,
        ]);

        $this->addElement('text', 'director', [
            'label' => 'Director',
            'required' => true,
        ]);

        $this->addElement('text', 'grade', [
            'label' => 'Grade',
            'required' => true,
        ]);

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Save',
        ));
    }
}