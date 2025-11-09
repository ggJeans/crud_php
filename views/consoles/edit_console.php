<?php
include_once __DIR__ . '/../../controllers/consoleController.php';

$controller = new ConsoleController();

$id = isset($_GET['id']) ? $_GET['id'] : die('ID do console não fornecido.');

$console = $controller->readOne($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    if ($controller->update($id, $nome)) {
        header('Location: /crud_php/public/index.php?page=consoles');
        exit();
    } else {
        echo "<p class='error'>Não foi possível atualizar esse console.</p>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-head">
  <h2>Editar Console</h2>
  <div class="actions">
    <a href="/crud_php/public/index.php?page=consoles" class="button ghost">Voltar</a>
  </div>
</div>

<form class="form-card" action="/crud_php/public/index.php?page=consoles&action=edit&id=<?php echo $id; ?>" method="POST">
  <div class="form-row">
    <div class="col">
      <label for="nome">Nome do Console</label>
      <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($console->nome, ENT_QUOTES); ?>" required />
    </div>
  </div>

  <div class="row-between">
    <div class="note">Editar informações do console.</div>
    <div>
      <button type="submit" class="button">Salvar</button>
      <a href="/crud_php/public/index.php?page=consoles" class="button ghost">Cancelar</a>
    </div>
  </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
