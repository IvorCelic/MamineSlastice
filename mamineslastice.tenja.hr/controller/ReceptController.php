<?php

class ReceptController extends AutorizacijaController
{

    private $viewDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'recept' .
        DIRECTORY_SEPARATOR;

    public function index()
    {

        $this->view->render($this->viewDir . 'index',[
            'podaci' => Recept::readAll(),
            'kategorije' => Kategorija::readAll() 
        ]);
    }

    public function novi()
    {
        if(!isset($_POST['kategorija']) || 
        $_POST['kategorija']=='0'){
            $this->view->render($this->viewDir . 'index',[
                'podaci'=>Recept::readAll(),
                'kategorije' => Kategorija::readAll(),
                'poruka'=>'Dodajte naziv recepta i kategoriju kojoj pripada. <br />
                           Nakon toga će te biti preusmjereni na stranicu gdje će te dodati sastojke, način pripreme i sliku'
            ]);
            return;
        }

        $this->view->render($this->viewDir . 'detalji',[
            'sifra' => Recept::create($_POST['smjer'])
        ]);
    }

    public function dodajnovi()
    {
        Recept::create();
        $this->index();
    }

    public function obrisi()
    {
        //prvo dođu silne kontrole
        Recept::delete();
        header('location: /recept/index');
    }
}

