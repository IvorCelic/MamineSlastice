<?php

class Korisnik
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select * from operater');
        $izraz->execute();
        return $izraz->fetchAll();
    }
    public static function read($operater_ID)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select email,ime,prezime,operater_ID from operater where operater_ID=:operater_ID');
        $izraz->execute(['operater_ID'=>$operater_ID]);
        return $izraz->fetch();
    }

    public static function delete()
    {
        try{
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('delete from operater where operater_ID=:operater_ID');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }

    public static function update(){
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('update operater 
        set ime=:ime,prezime=:prezime, email=:email
        where operater_ID=:operater_ID');
        $izraz->execute($_POST);
    }
}