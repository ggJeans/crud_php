<?php
include_once '../config/database.php';
include_once '../models/console.php';

class ConsoleController {
    private $conn;
    private $console;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->console = new Console($this->conn);
    }

    public function index() {
        $stmt = $this->console->read();
        $num = $stmt->rowCount();
        return ['stmt' => $stmt, 'num' => $num];
    }

    public function create($nome) {
        $this->console->nome = $nome;
        if($this->console->create()) {
            return true;
        }
        return false;
    }

    public function readOne($id) {
        $this->console->id = $id;
        $this->console->readOne();
        return $this->console;
    }

    public function update($id, $nome) {
        $this->console->id = $id;
        $this->console->nome = $nome;
        if($this->console->update()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $this->console->id = $id;
        if($this->console->delete()) {
            return true;
        }
        return false;
    }
}
?>