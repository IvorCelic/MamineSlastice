<?php 

class Kategorija
{

    public static function readAll()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select 
         a.kategorija_ID, a.naziv, b.naziv as nadredena_kategorija
        from kategorija a left join kategorija b
        on a.nadredena_kategorija=b.kategorija_ID
        group by a.kategorija_ID, a.naziv, b.naziv
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('select 
         a.kategorija_ID, a.naziv, b.naziv as nadredena_kategorija
        from kategorija a left join kategorija b
        on a.nadredena_kategorija=b.kategorija_ID');
        $izraz->execute(['kategorija_ID'=>$sifra]);
        return $izraz->fetch();
    }

    public static function create()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('insert into kategorija
        (nadredena_kategorija, naziv) values
        (:nadredena_kategorija, :naziv)');
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
        $veza->beginTransaction();

        $izraz=$veza->prepare('select kategorija  
        where kategorija_ID=:kategorija_ID');
            $izraz->execute([
                'sifra' => $_POST['sifra']
            ]);

            $sifrakategorija = $izraz->fetchColumn();

        $izraz=$veza->prepare('update kategorija 
        set naziv=:naziv, nadredena_kategorija=:nadredena_kategorija
        where kategorija_ID=:kategorija_ID');
        $izraz->execute([
            'naziv' => $_POST['naziv'],
            'nadredena_kategorija' => $_POST['nadredena_kategorija'],
            'kategorija_ID' => $sifrakategorija
        ]); 
    
        
        $veza->commit();
    }
}