<?php

class IndexController extends Controller
{

    public function prijava()
    {
        $this->view->render('prijava',[
            'poruka' => 'Unesite pristupne podatke',
            'email' => ''
        ]);
    }

    public function autorizacija()
    {
        if(!isset($_POST['email']) || 
        !isset($_POST['lozinka'])){
            $this->view->render('prijava',[
                'poruka' => 'Nisu postavljeni pristupni podaci',
                'email' => ''
            ]);
            return;
        }

        if(trim($_POST['email'])==='' || 
        trim($_POST['lozinka'])===''){
            $this->view->render('prijava',[
                'poruka' => 'Pristupni podaci obavezno',
                'email' => $_POST['email']
            ]);
            return;
        }

        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from operater 
                        where email=:email;');
        $izraz->execute(['email'=>$_POST['email']]);
        $rezultat=$izraz->fetch();
        if($rezultat==null){
            $this->view->render('prijava',[
                'poruka' => 'Ne postojeći korisnik',
                'email' => $_POST['email']
            ]);
            return;
        }

        if(!password_verify($_POST['lozinka'],$rezultat->lozinka)){
            $this->view->render('prijava',[
                'poruka' => 'Neispravna kombinacija email i lozinka',
                'email' => $_POST['email']
            ]);
            return;
        }
        unset($rezultat->lozinka);
        $_SESSION['operater']=$rezultat;
        $npc = new NadzornaplocaController();
        $npc->index();
    }

    public function odjava()
    {
        unset($_SESSION['operater']);
        session_destroy();
        $this->index();
    }

    public function index()
    {
        $poruka='hello iz kontrolera';
        $kod=22;

       
        $this->view->render('pocetna',[
            'p' => $poruka,
            'k' => $kod]
        );
    }

    public function registracija()
    {
        $this->view->render('registracija',[
            'poruka' => 'Svi podaci su obavezni za popuniti']);
    }

    public function registrirajnovi()
    {
        //prvo dođu sve silne kontrole
        Operater::registrirajnovi();
        $this->view->render('registracijagotova');
    }

    public function zavrsiregistraciju()
    {
        Operater::zavrsiregistraciju($_GET['id']);
        $this->view->render('prijava');
    }

    public function email()
    {
        $headers = "From: Mamine slastice <mamineslastice@ms.tenja.hr>\r\n";
        $headers .= "Reply-To: Mamine slastice <mamineslastice@ms.tenja.hr>\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail('ivorcelic@gmail.com','Test','Test poruka <a href="http://ms.tenja.hr/">Mamine slastice</a>', $headers);
        echo 'GOTOV';
    }

    public function onama()
    {
        $this->view->render('onama');
    }

    public function json()
    {
        $niz=[];
        $s=new stdClass();
        $s->naziv='PHP programiranje';
        $s->sifra=1;
        $niz[]=$s;
        //$this->view->render('onama',$niz);
        echo json_encode($niz);
    }

    public function test()
    {
     echo password_hash('nema',PASSWORD_BCRYPT);
      // echo md5('mojaMala'); NE KORISTITI
    } 
}