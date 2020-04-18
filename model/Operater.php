<?php

class Operater
{
    public static function registrirajnovi()
        {
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('insert into operater 
            (email,lozinka,ime,prezime,uloga,aktivan,sessionid) values 
            (:email,:lozinka,:ime,:prezime,:uloga,false,:sessionid)');
            unset($_POST['lozinkaponovo']);

            $_POST['lozinka'] = 
                 password_hash($_POST['lozinka'],PASSWORD_BCRYPT);
            $_POST['sessionid'] = session_id();
            $_POST['uloga'] = 'korisnik';
            //print_r($_POST);

            $izraz->execute($_POST);
            $headers = "From: Mamine slastice <mamineslastice@ms.tenja.hr>\r\n";
            $headers .= "Reply-To: Mamine slastice <mamineslastice@ms.tenja.hr>    \r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                    mail($_POST['email'],'Završi registraciju na Maminim slasticama',
                    '<a href="' . App::config('url') . 
                    'index/zavrsiregistraciju?id=' . $_POST['sessionid'] . '">Završite registraciju</a>', $headers);

        }

    public static function zavrsiregistraciju($id){
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update operater 
        set aktivan=true where sessionid=:sessionid');
        $izraz->execute(['sessionid'=>$id]);
    }
}
