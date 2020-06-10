<?php
class Conexion
{
    public function conectar()
    {
        $link = new PDO("mysql:host=localhost;dbname=practica_01_2020", "root", "");
        return $link;
    }
}
