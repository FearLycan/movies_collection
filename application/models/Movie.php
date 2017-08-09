<?php

class  Application_Model_Movie
{

    protected $_id;
    protected $_title;
    protected $_poster;
    protected $_description;
    protected $_grade;
    protected $_director;

//    private $_dbTable;
//
//    public function __construct()
//    {
//        $this->_dbTable = new Application_Model_DbTable_Movie();
//    }
//
//    public function createMovie($array)
//    {
//
//        $this->_dbTable->insert($array);
//    }
//
//    public function updateMovie($array, $id)
//    {
//        $this->_dbTable->update($array, "id = $id");
//    }
//
//    //public function fetchAll();

//    public function __construct(array $options = null)
//    {
//        if (is_array($options)) {
//            $this->setOptions($options);
//        }
//    }
//
//    public function __set($name, $value)
//    {
//        $method = 'set' . $name;
//        if (('mapper' == $name) || !method_exists($this, $method)) {
//            throw new Exception('Invalid movie property');
//        }
//        $this->$method($value);
//    }
//
//    public function __get($name)
//    {
//        $method = 'get' . $name;
//        if (('mapper' == $name) || !method_exists($this, $method)) {
//            throw new Exception('Invalid movie property');
//        }
//        return $this->$method();
//    }
//
//    public function setOptions(array $options)
//    {
//        $methods = get_class_methods($this);
//        foreach ($options as $key => $value) {
//            $method = 'set' . ucfirst($key);
//            if (in_array($method, $methods)) {
//                $this->$method($value);
//            }
//        }
//        return $this;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->_id;
//    }
//
//    /**
//     * @param mixed $id
//     */
//    public function setId($id)
//    {
//        $this->_id = $id;
//    }
//
//
//    /**
//     * @return mixed
//     */
//    public function getTitle()
//    {
//        return $this->_title;
//    }
//
//    /**
//     * @param mixed $title
//     */
//    public function setTitle($title)
//    {
//        $this->_title = $title;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getPoster()
//    {
//        return $this->_poster;
//    }
//
//    /**
//     * @param mixed $poster
//     */
//    public function setPoster($poster)
//    {
//        $this->_poster = $poster;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getDescription()
//    {
//        return $this->_description;
//    }
//
//    /**
//     * @param mixed $description
//     */
//    public function setDescription($description)
//    {
//        $this->_description = $description;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getGrade()
//    {
//        return $this->_grade;
//    }
//
//    /**
//     * @param mixed $grade
//     */
//    public function setGrade($grade)
//    {
//        $this->_grade = $grade;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getDirector()
//    {
//        return $this->_director;
//    }
//
//    /**
//     * @param mixed $director
//     */
//    public function setDirector($director)
//    {
//        $this->_director = $director;
//    }

    /**
     * @param $id
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public static function findOne($id)
    {
        $model = new Application_Model_DbTable_Movie();
        $select = $model->select()->where('id = ?', (int)$id);

        $row = $model->fetchRow($select);

        return $row;

    }
}
