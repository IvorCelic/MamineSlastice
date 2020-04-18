<?php

class KategorijaController extends AutorizacijaController
{

    private $viewDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'kategorija' .
        DIRECTORY_SEPARATOR;

    public function index()
    {

        $this->view->render($this->viewDir . 'index',[
            'podaci'=>Kategorija::readAll(),
            'kategorije' => Kategorija::readAll()
        ]);

    }

    public function novi()
    {
        $this->view->render($this->viewDir . 'novi',[
            'podaci' => Kategorija::readAll(),
            'kategorije' => Kategorija::readAll(),
            'poruka' => 'Dodajte naziv kategorije i njenu nadređenu kategoriju'
        ]);
    }

    public function dodajnovi()
    {
        Kategorija::create();
        $this->index();
    }

    public function obrisi()
    {
        //prvo dođu silne kontrole
        Kategorija::delete();
        header('location: /kategorija/index');
    }

    public function promjena()
    {
        $kategorija = Kategorija::read($_GET['kategorija_ID']);
        if(!$kategorija){
            $this->index();
            exit;
        }

        $this->view->render($this->viewDir . 'promjena',
            ['kategorija'=>$kategorija,
                'poruka'=>'Promjenite željene podatke']
        );
    }

    public function promjeni()
    {
        // I OVDJE DOĐU SILNE KONTROLE
        Kategorija::update();
        header('location: /kategorija/index');
    }
    
}