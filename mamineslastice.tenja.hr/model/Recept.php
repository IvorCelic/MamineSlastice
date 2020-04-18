<?php 

class Recept
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        select
        a.recept_ID, a.naziv, b.naziv as kategorija
        from recept a left join kategorija b
        on a.kategorija=b.kategorija_ID
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        select
        a.recept_ID, a.naziv, b.naziv as kategorija
        from recept a left join kategorija b
        on a.kategorija=b.kategorija_ID
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($kategorija)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('insert into recept
        (kategorija, naziv) values
        (:kategorija, :naziv)');
        $izraz->execute(['kategorija' => $kategorija]);
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
}