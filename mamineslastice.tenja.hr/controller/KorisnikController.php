<?php

class KorisnikController extends AdminController
{
    private $viewDir = 'privatno' . 
    DIRECTORY_SEPARATOR . 'korisnik' .
    DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
         'podaci' => Korisnik::read()
     ]);
    }

    public function obrisi()
    {
        Korisnik::delete();
        header('location: /korisnik/index');
    }

    public function promjena()
    {
        $korisnik = Korisnik::read($_GET['operater_ID']);
        if(!$korisnik){
            $this->index();
            exit;
        }

        $this->view->render($this->viewDir . 'promjena',[
            'korisnik'=>$korisnik,
            'poruka'=>'Promjenite željene podatke'
        ]);
    }

    public function promjeni()
    {
        Korisnik::update();
        header('location: /korisnik/index');
    }
}