<?php
    class ConnectionFactory {
        private static $dbType = "mysql";
        private static $host = "localhost";
        private static $user = "root";
        private static $senha = "";
        private static $db = "loja_cafe";

        private static $con = null;

        public static function getConnection(){
            if(self::$con === null){
                try{
                    $dsn = self::$dbType . ":host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8";
                    
                    self::$con = new PDO(
                        $dsn,
                        self::$user,
                        self::$senha,
                        array(
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        )
                    );
                }catch(PDOException $ex){
                    die("Erro ao conectar no banco: " . $ex->getMessage());
                }
            }
            return self::$con;
        }
        public static function close(){
            self::$con = null;
        }
    }
?>