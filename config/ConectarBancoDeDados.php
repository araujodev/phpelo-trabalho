<?php 
class ConectarBancoDeDados { 
    
    /**
     * Variaveis de configuracao da conexao e banco.
     */
    private $driver = "mysql";
    private $servidor = '127.0.0.1';
    private $porta = 3306; 
    private $usuario = "root";
    private $senha = "123456789m";
    private $banco = "web2";
    private $dsn;
    public $pdo;

    /**
     * Construtor da Classe Conectar Banco de Dados
     */
    public function __construct()
    {
        if(empty($this->pdo))
        {
            $this->montarDsn();
            $this->instanciarPDO();
        }
    }
    
    /**
     * Metodo que monta o DSN
     */
    private function montarDsn()
    { 
        $this->dsn = "$this->driver:host=$this->servidor;dbname=$this->banco";
    }

    /**
     * Instancia o PDO e deixa ele disponivel na variavel
     */
    private function instanciarPDO()
    {
        $this->pdo = new PDO($this->dsn, $this->usuario, $this->senha);
    }
}
?> 