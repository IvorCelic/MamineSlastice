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
                'alertPoruka'=>'Morate odabrati kategoriju'
            ]);
            return;
        }

        $sifraNovogRecepta=Recept::create($_POST['kategorija']);
        $recept = Recept::read($sifraNovogRecepta);
        $this->detalji($recept);
    }

    public function opis()
    {
        $this->view->render($this->viewDir . 'opis',[
            'podaci' => Recept::readAll(),
        ]);
    }

    public function promjena()
    {
        $recept = Recept::read($_GET['recept_ID']);
        if(!$recept){
            $this->index();
            exit;
        }
        $this->detalji($recept);     
    }

    public function promjeni()
    {
        Recept::update();
        $this->index();
    }

    private function detalji($recept)
    {
        $this->view->render($this->viewDir . 'detalji',[
            'recept'=>$recept,
            'kategorije' => Kategorija::readAll()
            ]);  
    }

    public function obrisi()
    {
        if(Recept::delete()){
            header('location: /recept/index');
        }
        
    }

}

