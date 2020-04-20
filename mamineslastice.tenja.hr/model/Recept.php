<?php 

class Recept
{
    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('

        select
        a.recept_ID, a.naziv, b.naziv as kategorija
        from recept a
        left join kategorija b
        on a.kategorija=b.kategorija_ID

        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('

        select a.recept_ID, a.kategorija, a.naziv, a.priprema, a.sastojak, b.naziv as nazivKategorije
        from recept a
        inner join kategorija b on a.kategorija=b.kategorija_ID
        where a.recept_ID=:recept_ID

        ');
        $izraz->execute(['recept_ID' => $sifra]);
        return $izraz->fetch();
    }

    public static function readKategorija($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        select
        a.recept_ID, a.naziv, b.naziv as kategorija
        from recept a
        left join kategorija b
        on a.kategorija=b.kategorija_ID
        where a.recept_ID=:recept_ID
        ');
        $izraz->execute(['recept_ID' => $sifra]);
        return $izraz->fetch();
    }

    public static function create($kategorija)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        insert into recept
        (kategorija, naziv, priprema) values
        (:kategorija, \'\', \'\')

        ');
        $izraz->execute(['kategorija' => $kategorija]);
        return $veza->lastInsertId();
    }

    public static function delete()
    {
        try{
            $veza = DB::getInstanca();
            $izraz=$veza->prepare('

            delete from recept
            where recept_ID=:recept_ID
            
            ');
            $izraz->execute($_GET);
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public static function update()
    {
        $veza = DB::getInstanca();
        $izraz=$veza->prepare('

        update recept 
        set naziv=:naziv, kategorija=:kategorija, priprema=:priprema
         where recept_ID=:recept_ID
         
         ');
         $izraz->execute([
            'naziv' => $_POST['naziv'],
            'kategorija' => $_POST['kategorija'],
            'priprema' => $_POST['priprema'],
            'recept_ID' => $_POST['recept_ID']
        ]);
    }
}
