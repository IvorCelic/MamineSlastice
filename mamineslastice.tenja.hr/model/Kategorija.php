<?php 

class Kategorija
{

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from kategorija');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from kategorija
        where kategorija_ID=:kategorija_ID');
        $izraz->execute(['kategorija_ID'=>$sifra]);
        return $izraz->fetch();
    }

    public static function create($kategorija)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('insert into kategorija
        (kategorija, naziv) values
        (:kategorija, :naziv)');
        $izraz->execute($_POST);
    }

    public static function delete()
    {
        try{
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from kategorija where kategorija_ID=:kategorija_ID');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }

    public static function update(){
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update kategorija 
        set naziv=:naziv,nadredena_kategorija=:nadredena_kategorija
        where kategorija_ID=:kategorija_ID');
        $izraz->execute($_POST);
    }
}