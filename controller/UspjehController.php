<?php

class UspjehController extends RegistracijaController
{
    public function index()
    {
        $this->view->render('privatno' . 
        DIRECTORY_SEPARATOR . 'uspjeh' .
        DIRECTORY_SEPARATOR . 'index');
    }
}