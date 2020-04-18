<?php 

class ReceptDetaljno
{

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from recept');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from recept
        where recept_ID=:recept_ID');
        $izraz->execute(['recept_ID'=>$sifra]);
        return $izraz->fetch();
    }

    public static function delete()
    {
        try{
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from recept where recept_ID=:recept_ID');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }

    public static function update(){
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update recept_ID 
        set naziv=:naziv,kategorija=:kategorija, priprema=:priprema, slika=:slika
        where recept_ID=:recept_ID');
        $izraz->execute($_POST);
    }
}