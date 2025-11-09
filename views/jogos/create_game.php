<?php
include_once __DIR__ . '/../../controllers/jogoController.php';

$controller = new JogoController();
$consoles_stmt = $controller->getConsoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $console_id = $_POST['console_id'];
   $ano = $_POST['ano_lancamento'];
   $genero = $_POST['genero'];
   $classificacao = $_POST['classificacao'];

  if ($controller->create($nome, $descricao, $preco, $console_id, $ano, $genero, $classificacao)) {

        header('Location: /crud_php/public/index.php?page=jogos');
        exit();
    } else {
        echo "<p class='error'>Não foi possível adicionar esse jogo.</p>";
  }
}

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-head">
  <h2>Adicionar Jogo</h2>
  <div class="actions">
    <a href="/crud_php/public/index.php?page=jogos" class="button ghost">Voltar</a>
  </div>
</div>

<form class="form-card" action="/crud_php/public/index.php?page=jogos&action=create" method="POST">
  <div class="form-row">
    <div class="col">
      <label for="nome">Nome do Jogo</label>
      <input type="text" id="nome" name="nome" required />
    </div>
    <div class="col">
      <label for="preco">Preço (ex: 199.90)</label>
      <input type="number" step="0.01" id="preco" name="preco" required />
    </div>
  </div>
  
  <div class="form-row">
    <div class="col">
      <label for="console_id">Console</label>
      <select id="console_id" name="console_id" required>
        <?php
              $nomes_exibidos = [];

            while ($console = $consoles_stmt->fetch(PDO::FETCH_ASSOC)) {
               if (!in_array($console['nome'], $nomes_exibidos)) {
                   echo "<option value=\"" . $console['id'] . "\">" . htmlspecialchars($console['nome']) . "</option>";
                     $nomes_exibidos[] = $console['nome'];
                 }
              }
          ?>

      </select>
    </div>
  </div>

  <div class="form-row">
    <div class="col">
      <label for="descricao">Descrição</label>
      <textarea id="descricao" name="descricao"></textarea>
    </div>
  </div>

 <div class="form-group">
  <label for="ano_lancamento">Ano de Lançamento:</label>
  <input type="number" name="ano_lancamento" min="1970" max="<?php echo date('Y'); ?>" required>
 </div>
 
 <div class="form-group">
  <label for="genero">Gênero:</label>
  <input type="text" name="genero" placeholder="Ex: RPG, Ação, Terror..." required>
 </div>

 <div class="form-group">
  <label for="classificacao">Classificação Indicativa:</label>
  <input type="text" name="classificacao" placeholder="Ex: Livre, 12+, 16+, 18+" required>
 </div>


  <div class="row-between">
    <div class="note">Campos obrigatórios: Nome, Preço, Console.</div>
    <div>
      <button type="submit" class="button">Salvar</button>
      <a href="/crud_php/public/index.php?page=jogos" class="button ghost">Cancelar</a>
    </div>
  </div>
</form>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
