<?php


class Connexion {

    private static  $url = ('mysql:host=localhost;dbname=randomnumber;charset=utf8');
    private static  $root = 'root';
    private static $passwordBd = '';

    public static function getPdo(): PDO{
        try{
            //j'instancie un objet de type PDO,
              $pdo = new PDO(Connexion::$url,Connexion::$root,Connexion::$passwordBd);

            } catch(PDOException $e) {

                echo 'Error: '. $e->getMessage();
        }

        return $pdo;
    }

}


