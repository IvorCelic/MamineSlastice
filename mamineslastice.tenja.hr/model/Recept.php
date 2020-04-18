<?php 

class Recept
{
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select 
        * from recept');
        $izraz->execute();
        return $izraz->fetchAll();
    }
}