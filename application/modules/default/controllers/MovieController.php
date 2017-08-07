<?php

class MovieController extends Saffron_AbstractController
{

    public function indexAction()
    {
        $this->view->headTitle('Movies');

        $model = new Application_Model_DbTable_Movie();
        $movies = $model->fetchAll();


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
            $movie = new Application_Model_DbTable_Movie($form->getValues());
            $mapper = new Application_Model_MovieMapper();
            $mapper->save($movie);

            //die(var_dump($movie));
            return $this->_helper->redirector('movie/index');
        }

        $this->view->form = $form;

    }

    public function viewAction($id)
    {

    }

    public function editAction($id)
    {

    }

    public function deleteAction($id)
    {

    }

}