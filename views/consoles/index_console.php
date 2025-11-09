<?php
include_once __DIR__ . '/../../controllers/consoleController.php';

$controller = new ConsoleController();
$data = $controller->index();
$stmt = $data['stmt'];
$num = $data['num'];

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-head">
  <h2>Consoles</h2>
  <div class="actions">
    <a href="/crud_php/public/index.php?page=consoles&action=create" class="button">Adicionar console</a>
  </div>
</div>

<?php if ($num > 0): ?>
  <div class="grid">
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      <div class="card" aria-labelledby="console-<?php echo $row['id']; ?>">
        <div class="card-top">
          <div>
            <div class="meta">
              <div class="tag">Console</div>
            </div>
            <h3 id="console-<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nome'], ENT_QUOTES); ?></h3>
            <div class="note">ID: <?php echo $row['id']; ?></div>
          </div>
          <div class="tag">#<?php echo $row['id']; ?></div>
        </div>

        <div class="card-actions">
  <a class="btn-edit" href="/crud_php/public/index.php?page=consoles&action=edit&id=<?php echo $row['id']; ?>">Editar</a>

  <a class="btn-delete" href="/crud_php/public/index.php?page=consoles&action=delete&id=<?php echo $row['id']; ?>"
     onclick="return confirm('Deseja realmente excluir este console?');">
     Deletar
  </a>
</div>


      </div>
    <?php endwhile; ?>
  </div>

<?php else: ?>
  <div class="form-card">
    <p>Nenhum console encontrado.</p>
    <a class="button" href="/crud_php/public/index.php?page=consoles&action=create">Criar primeiro console</a>
  </div>
<?php endif; ?>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
