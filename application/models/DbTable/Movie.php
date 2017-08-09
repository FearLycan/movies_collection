<?php

class  Application_Model_DbTable_Movie extends Zend_Db_Table_Abstract
{
    protected $_name = 'movie';
    protected $_primary = 'id';


    public function listMovies()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $selectMovies = new Zend_Db_Select($db);

        $selectMovies->from('movie');

        return $selectMovies;
    }


    public function getShortDescription()
    {
        return substr($this->description, 0, 125) . '...';
    }
}