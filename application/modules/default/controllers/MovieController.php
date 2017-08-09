<?php

class MovieController extends Saffron_AbstractController
{

    public function indexAction()
    {
        $this->view->headTitle('Movies');

        $model = new Application_Model_DbTable_Movie();
        //$movies = $model->fetchAll();
        $movies = $model->listMovies();

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($movies));
        $paginator->setItemCountPerPage(1)
            ->setCurrentPageNumber($this->_getParam('page', 1));

        $this->view->paginator = $paginator;

        $this->view->assign([
            'movies' => $movies,
        ]);
    }

    public function addAction()
    {
        $this->view->headTitle('Add New Movie');

        $request = $this->getRequest();
        $form = new Application_Form_Add();

        if ($this->getRequest()->isPost() && $form->isValid($request->getPost())) {
            $movie = $form->getValues();
            $mapper = new Application_Model_MovieMapper();
            $mapper->save($movie);

            //die(var_dump($form->getValues()));
            return $this->_helper->redirector('movie/index');
        }

        $this->view->form = $form;

    }

    public function viewAction()
    {
        $id = $this->_getParam('id');

//        $model = new Application_Model_DbTable_Movie();
//        //$movie = $model->find($id);
//        $movie = $model->select()->where('id = ?', (int) $id);
//
//        //$select = $this->getDbTable()->select()->where('token = ?', (string) $token);
//        $row = $model->fetchRow($movie);

        //$this->view->movie = $movie;

        //$movie = Application_Model_Movie::findOne($id);
        //$movie = new Application_Model_Movie();
        $model = Application_Model_Movie::findOne($id);

//        //$a = $movie->findOne($id);
//
//        die(var_dump($a->id));

        $this->view->assign([
            'movie' => $model,
        ]);
    }

    public function editAction($id)
    {

    }

    public function deleteAction($id)
    {

    }

}