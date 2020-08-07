<?php

namespace Epiqworx\Database;

abstract class DBHandler {
  const KNOWN = array('sict-iis.nmmu.ac.za'=>'sict-mysql');   // ------------ hosts known to have web server ip address different to that of database
    
  private static $cs_path = "main/config/";   //  --------------------------- configuration directory
    private static $cs_file = "connection.ini"; //  --------------------------- file containg connection string parameters
    // hold an instance of the PDO class
    private static $conn;
    
    public static function get_c_string_file(){
        $cs_path = dirname(__FILE__, 4). '/'.self::$cs_path;
        return $cs_path.self::$cs_file;
    }

    private static function is_bad_connection(&$funnel,&$pdo) {
        $file = null;
        if(self::c_str_file_absent($funnel, $file)){
            return TRUE;
        }
        $conexion = parse_ini_file($file); //------------------retrieve connection string from INI file

        if(array_key_exists($_SERVER['HTTP_HOST'], self::KNOWN)){
            $DB_HOST = self::KNOWN[$_SERVER['HTTP_HOST']];
        }
        if (!empty($conexion['host'])) {
            $DB_HOST = $conexion['host'];
        }

        $DB_USER = $conexion['user'];
        $DB_PASS = $conexion['password'];
        $DB_NAME = $conexion['dbname'];

        // create database connection only if one does not already exists
        if (isset(self::$conn) || !empty(self::$conn)) {
            $pdo = self::$conn;
            self::Close();  //  -------------------------------  release memory
            return FALSE;
        }
        try {
            self::$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception
            $pdo = self::$conn;
            self::Close();  //  -------------------------------  release memory
        } catch (PDOException $e) {
            self::error($funnel,$e);
            return TRUE;
        }
    }

}