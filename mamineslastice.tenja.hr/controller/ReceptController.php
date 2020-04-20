<?php

class ReceptController extends AutorizacijaController
{

    private $viewDir = 'privatno' . 
        DIRECTORY_SEPARATOR . 'recept' .
        DIRECTORY_SEPARATOR;

    private function renderIndex($podaci,$stranica,$uvjet,$us){
        $this->view->render($this->viewDir . 'index',[
            'podaci'=>$podaci,
            'stranica' => $stranica,
            'uvjet' => $uvjet,
            'ukupnoStranica' => $us,
            'css' => '<link rel="stylesheet" href="' . APP::config('url') . 
            'public/css/cropper.css">',
            'jsLib' => '
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>',
            'javascript'=>'
            <script src="' . APP::config('url') . 
                'public/js/recept/index.js"></script>'
           ]);
    }

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
            'red' => Recept::read($_GET['recept_ID']),
            'kategorija' => Recept::readKategorija('kategorija')
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

    public function spremisliku(){

        $slika = $_POST['slika'];
        $slika=str_replace('data:image/png;base64,','',$slika);
        $slika=str_replace(' ','+',$slika);
        $data=base64_decode($slika);

        file_put_contents(BP . 'public' . DIRECTORY_SEPARATOR
        . 'images' . $_POST['id'] . '.png', $data);

        echo "OK";
    }

}

