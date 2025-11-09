<?php
class Jogo {
    private $conn;
    private $table_name = "jogos";

    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $console_id;
    public $console_nome;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT
                    c.nome as console_nome, p.id, p.nome, p.descricao, p.preco, p.console_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        consoles c
                            ON p.console_id = c.id
                ORDER BY
                    p.nome DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

public function create() {
    $query = "INSERT INTO jogos 
              (nome, descricao, preco, console_id, ano_lancamento, genero, classificacao) 
              VALUES 
              (:nome, :descricao, :preco, :console_id, :ano_lancamento, :genero, :classificacao)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':descricao', $this->descricao);
    $stmt->bindParam(':preco', $this->preco);
    $stmt->bindParam(':console_id', $this->console_id);
    $stmt->bindParam(':ano_lancamento', $this->ano_lancamento);
    $stmt->bindParam(':genero', $this->genero);
    $stmt->bindParam(':classificacao', $this->classificacao);

    return $stmt->execute();
}


    function readOne(){
        $query = "SELECT
                    c.nome as console_nome, p.id, p.nome, p.descricao, p.preco, p.console_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        consoles c
                            ON p.console_id = c.id
                WHERE
                    p.id = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nome = $row["nome"];
        $this->descricao = $row["descricao"];
        $this->preco = $row["preco"];
        $this->console_id = $row["console_id"];
        $this->console_nome = $row["console_nome"];
    }

    function update(){
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nome = :nome,
                    preco = :preco,
                    descricao = :descricao,
                    console_id = :console_id
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->preco=htmlspecialchars(strip_tags($this->preco));
        $this->descricao=htmlspecialchars(strip_tags($this->descricao));
        $this->console_id=htmlspecialchars(strip_tags($this->console_id));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":console_id", $this->console_id);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>