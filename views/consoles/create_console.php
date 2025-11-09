<?php
include_once __DIR__ . '/../../controllers/consoleController.php';

$controller = new ConsoleController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    if ($controller->create($nome)) {
        header('Location: /crud_php/public/index.php?page=consoles');
        exit();
    } else {
        echo "<p class='error'>Não foi possível criar esse console.</p>";
    }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-head">
  <h2>Criar Console</h2>
  <div class="actions">
    <a href="/crud_php/public/index.php?page=consoles" class="button ghost">Voltar</a>
  </div>
</div>

<form class="form-card" action="/crud_php/public/index.php?page=consoles&action=create" method="POST">
  <div class="form-row">
    <div class="col">
      <label for="nome">Nome do Console</label>
      <input type="text" id="nome" name="nome" required />
    </div>
  </div>

  <div class="row-between">
    <div class="note">Preencha o nome do console.</div>
    <div>
      <button type="submit" class="button">Salvar</button>
      <a href="/crud_php/public/index.php?page=consoles" class="button ghost">Cancelar</a>
    </div>
  </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
