<?php

class ReceptdetaljnoController extends AutorizacijaController
{

    private $viewDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'recept' .
        DIRECTORY_SEPARATOR . 'receptdetaljno' .
        DIRECTORY_SEPARATOR;

    public function index()
    {

        $this->view->render($this->viewDir . 'index',[
            'podaci' => ReceptDetaljno::readAll(),
        ]);
    }

    public function obrisi()
    {
        //prvo dođu silne kontrole
        if(ReceptDetaljno::delete()){
            header('location: /recept/receptdetaljno/index');
        }
        
    }

    public function promjena()
    {
        $recept = ReceptDetaljno::read($_GET['recept_ID']);
        if(!$recept){
            $this->index();
            exit;
        }

        $this->view->render($this->viewDir . 'promjena',
            ['recept'=>$recept,
                'poruka'=>'Promjenite željene podatke']
        );
     
    }

    public function promjeni()
    {
        // I OVDJE DOĐU SILNE KONTROLE
        ReceptDetaljno::update();
        header('location: /recept/receptdetaljno/index');
    }