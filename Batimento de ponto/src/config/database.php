<?php

class Database {
    // Classe para a conexão com o banco de dados
    public static function getConnection(){
        $envPath = realpath(dirname(__FILE__, 2) . '/env.ini'); 
        
        $env = parse_ini_file($envPath); //parse_ini_file carrega o arquivo INI especificado em envPatch e retorna 
                                       //as configurações contidas nele em um array associativo.
        //$conn = new mysqli($env['host'], $env['username'],
            //$env['password'], $env['databse']); // Variavel que vai conter o conteudo para se conectar ao banco
        $host = "127.0.0.1:3307";
        $username = "root";
        $password = "root";
        $database = "innout";
        $conn = new mysqli($host, $username, $password, $database);    // mysqli() é a função que faz a conexão

        if($conn->connect_error){
            die("Error:" . $conn->connect_error);// tratamento de erro de conexão, connect_error mostra o erro gerado
        }                                           //die — Equivalente a exit()

        return $conn; // retorna a conexão caso não dê erro
    }

    public static function getResultFromQuery($sql){
        $conn = self::getConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public static function executeSQL($sql){
        $conn = self::getConnection();
        if(!mysqli_query($conn, $sql)) {
            throw new Exception(mysqli_error($conn));
        }
        $id = $conn->insert_id;
        $conn->close();
        return $id;
    }
}