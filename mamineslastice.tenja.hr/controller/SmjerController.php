<?php

class SmjerController extends AutorizacijaController
{
    public function index()
    {
        $this->view->render('privatno' . 
        DIRECTORY_SEPARATOR . 'smjer' .
        DIRECTORY_SEPARATOR . 'index');
    }
}