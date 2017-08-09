<?php

class Application_Model_MovieMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Movie');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Movie $movie)
    {
        $data = array(
            'title'   => $movie->getTitle(),
            'description' => $movie->getDescription(),
            'poster' => $movie->getPoster(),
            'director' => $movie->getDirector(),
            'grade' => $movie->getGrade(),
        );

        if (null === ($id = $movie->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function findOne($id)
    {

        $movie = new Application_Model_Movie();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $movie->setId($row->id);
//            ->setEmail($row->email)
//            ->setComment($row->comment)
//            ->setCreated($row->created);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Guestbook();
            $entry->setId($row->id)
                ->setEmail($row->email)
                ->setComment($row->comment)
                ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }
}