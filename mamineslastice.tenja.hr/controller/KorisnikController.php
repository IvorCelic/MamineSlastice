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
        //prvo dođu silne kontrole
        Korisnik::delete();
        header('location: /korisnik/index');
    }
}