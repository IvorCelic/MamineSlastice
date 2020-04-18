<?php

class ReceptController extends AutorizacijaController
{

    private $viewDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'recept' .
        DIRECTORY_SEPARATOR;

    public function index()
    {

        $this->view->render($this->viewDir . 'index',[
            'podaci'=>Recept::read()
        ]);

    }
}

