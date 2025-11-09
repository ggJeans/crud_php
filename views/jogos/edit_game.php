<?php
include_once __DIR__ . '/../../controllers/jogoController.php';

$controller = new JogoController();

$id = isset($_GET['id']) ? $_GET['id'] : die('ID do jogo não fornecido.');

$jogo = $controller->readOne($id);
$consoles_stmt = $controller->getConsoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $console_id = $_POST['console_id'];

    if ($controller->update($id, $nome, $descricao, $preco, $console_id)) {
        header('Location: /crud_php/public/index.php?page=jogos');
        exit();
    } else {
        echo "<p class='error'>Não foi possível atualizar esse jogo.</p>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-head">
  <h2>Editar Jogo</h2>
  <div class="actions">
    <a href="/crud_php/public/index.php?page=jogos" class="button ghost">Voltar</a>
  </div>
</div>

<form class="form-card" action="/crud_php/public/index.php?page=jogos&action=edit&id=<?php echo $id; ?>" method="POST">
  <div class="form-row">
    <div class="col">
      <label for="nome">Nome do Jogo</label>
      <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($jogo->nome, ENT_QUOTES); ?>" required />
    </div>
    <div class="col">
      <label for="preco">Preço</label>
      <input type="number" step="0.01" id="preco" name="preco" value="<?php echo htmlspecialchars($jogo->preco, ENT_QUOTES); ?>" required />
    </div>
  </div>

  <div class="form-row">
    <div class="col">
      <label for="console_id">Console</label>
      <select id="console_id" name="console_id" required>
        <?php
        while ($console = $consoles_stmt->fetch(PDO::FETCH_ASSOC)) {
            $selected = ($console['id'] == $jogo->console_id) ? 'selected' : '';
            echo "<option value=\"" . $console['id'] . "\" {$selected}>" . $console['nome'] . "</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-row">
    <div class="col">
      <label for="descricao">Descrição</label>
      <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($jogo->descricao, ENT_QUOTES); ?></textarea>
    </div>
  </div>

  <div class="row-between">
    <div class="note">Edite os dados do jogo e clique em salvar.</div>
    <div>
      <button type="submit" class="button">Salvar</button>
      <a href="/crud_php/public/index.php?page=jogos" class="button ghost">Cancelar</a>
    </div>
  </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
