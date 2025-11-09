<?php
include_once '../config/database.php';
include_once '../models/jogo.php';
include_once '../models/console.php';

class JogoController {
    private $conn;
    private $jogo;
    private $console;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->jogo = new Jogo($this->conn);
        $this->console = new Console($this->conn);
    }

    public function index() {
        $stmt = $this->jogo->read();
        $num = $stmt->rowCount();
        return ['stmt' => $stmt, 'num' => $num];
    }

    public function create($nome, $descricao, $preco, $console_id) {
        $this->jogo->nome = $nome;
        $this->jogo->descricao = $descricao;
        $this->jogo->preco = $preco;
        $this->jogo->console_id = $console_id;
        if($this->jogo->create()) {
            return true;
        }
        return false;
    }

    public function readOne($id) {
        $this->jogo->id = $id;
        $this->jogo->readOne();
        return $this->jogo;
    }

    public function update($id, $nome, $descricao, $preco, $console_id) {
        $this->jogo->id = $id;
        $this->jogo->nome = $nome;
        $this->jogo->descricao = $descricao;
        $this->jogo->preco = $preco;
        $this->jogo->console_id = $console_id;
        if($this->jogo->update()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $this->jogo->id = $id;
        if($this->jogo->delete()) {
            return true;
        }
        return false;
    }

    public function getConsoles() {
        $stmt = $this->console->read();
        return $stmt;
    }
}
?>