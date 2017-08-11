<?php

class MovieController extends Saffron_AbstractController
{
    /**
     * @var Zend_Controller_Action_Helper_FlashMessenger
     */
    protected $flashMessenger = null;


    /**
     * initalize flash messenger
     *
     * @return void
     */
    public function init()
    {
        $this->flashMessenger = $this->_helper->FlashMessenger;

        //var_dump(count($this->_helper->FlashMessenger));
    }


    public function indexAction()
    {
        $this->view->headTitle('Movies');

        $model = new Application_Model_DbTable_Movie();

        $movies = $model->listMovies();

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($movies));
        $paginator->setItemCountPerPage(10)
            ->setCurrentPageNumber($this->_getParam('page', 1));

        $this->view->paginator = $paginator;

        $this->view->assign([
            'movies' => $movies,
            'flashMessenger' => $this->flashMessenger,
        ]);
    }

    public function addAction()
    {
        $this->view->headTitle('Add New Movie');

        $request = $this->getRequest();
        $form = new Application_Form_Add();

        $form->setAttribs(['action' => 'edit']);

        if ($this->getRequest()->isPost() && $form->isValid($request->getPost())) {

            $movie = $form->getValues();

            $model = new Application_Model_Movie();

            $model->save($movie);

            $this->flashMessenger->addMessage(['success' => 'Wpis <strong>' . $movie['title'] . '</strong> został dodany']);

            return $this->_helper->redirector('index', 'movie');
        }

        $this->view->form = $form;

    }

    public function viewAction()
    {
        $id = $this->_getParam('id');

        $model = Application_Model_Movie::findOne($id);

        $this->view->assign([
            'movie' => $model,
        ]);
    }

    public function editAction()
    {
        $id = $this->_getParam('id');;

        $model = Application_Model_Movie::findOne($id);

        $this->view->headTitle('Edit Movie ' . $model->title);

        $request = $this->getRequest();
        $form = new Application_Form_Add();
        $form->setAttribs(['action' => $this->getHelper('url')->url(['controller' => 'movie', 'action' => 'edit', 'id' => $id])]);

        $form->populate($model->toArray());

        if ($this->getRequest()->isPost() && $form->isValid($request->getPost())) {

            $movie = $form->getValues();

            Application_Model_Movie::update($movie, $id);

            $this->flashMessenger->addMessage(['success' => 'Wpis <strong>' . $movie['title'] . '</strong> został zaktualizowany']);

            //return $this->_helper->redirector('view', 'movie', null, ['id' => $id]);
            return $this->_helper->redirector('index', 'movie');
        }

        $this->flashMessenger->addMessage(['success' => 'Wpis został zaktualizowany']);

        $this->view->assign([
            'model' => $model,
            'form' => $form,
        ]);
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {

            $id = $this->_getParam('id');

            $model = Application_Model_Movie::findOne($id);

            $model->delete();

            $this->flashMessenger->addMessage(['danger' => 'Wpis został usunięty']);

            return $this->_helper->redirector('index', 'movie');
        } else {
            throw new Exception('Invalid Post Data');
        }

    }

}