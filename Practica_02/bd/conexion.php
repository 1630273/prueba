<?php
class Database
{
  //Varaiables para la conexion de la base de datos
  private static $dbName = 'poo_crud';
  private static $dbHost = 'localhost';
  private static $dbUsername = 'root';
  private static $dbUserPassword = '';

  private static $cont  = null;


  public function __construct()
  {
    die('Init function is not allowed');
  }

  //Funcion para la conexion de base de datos
  public static function connect()
  {
    //Primero se verifica que  la variable $cont esea null 
    if (null == self::$cont) {
      try {
        //Se crea un nuevo objeto utilizando PDO para realizar la conexion
        self::$cont =  new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }
    return self::$cont;
  }


  //Funcion para desconectar de la base datos
  public static function disconnect()
  {
    self::$cont = null;
  }
}
