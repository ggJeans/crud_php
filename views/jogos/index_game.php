<?php
include_once __DIR__ . '/../../controllers/jogoController.php';

$controller = new JogoController();
$data = $controller->index();
$stmt = $data['stmt'];
$num = $data['num'];

include __DIR__ . '/../../views/includes/header.php';
?>

<div class="page-head">
  <h2>Jogos</h2>
  <div class="actions">
    <a href="/crud_php/public/index.php?page=jogos&action=create" class="button">Adicionar novo jogo</a>
  </div>
</div>

<?php if ($num > 0): ?>
  <div class="grid">
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      
      <!-- CARD AGORA TEM data-id PARA O MODAL -->
      <div class="card game-card" data-id="<?php echo $row['id']; ?>" aria-labelledby="jogo-<?php echo $row['id']; ?>">

        <div class="card-top">
          <div>
            <div class="meta">
              <div class="tag">Jogo</div>
              <div class="tag"><?php echo htmlspecialchars($row['console_nome'] ?? $row['console_id'], ENT_QUOTES); ?></div>
            </div>

            <h3 id="jogo-<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nome'], ENT_QUOTES); ?></h3>
            <p class="note">
              <?php 
                echo strlen($row['descricao']) > 140 
                  ? substr(htmlspecialchars($row['descricao'], ENT_QUOTES),0,140) . '…' 
                  : htmlspecialchars($row['descricao'], ENT_QUOTES); 
              ?>
            </p>
          </div>

          <div style="text-align:right;">
            <div class="price">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></div>
            <div class="console-name"><?php echo htmlspecialchars($row['console_nome'] ?? '', ENT_QUOTES); ?></div>
          </div>
        </div>

         <div class="card-actions">
  <a class="btn-edit" href="/crud_php/public/index.php?page=jogos&action=edit&id=<?php echo $row['id']; ?>">Editar</a>

  <a class="btn-delete" href="/crud_php/public/index.php?page=jogos&action=delete&id=<?php echo $row['id']; ?>" 
     onclick="return confirm('Deseja realmente excluir este jogo?');">
     Deletar
  </a>
</div>

      </div>

    <?php endwhile; ?>
  </div>
<?php else: ?>
  <div class="form-card">
    <p>Nenhum jogo encontrado.</p>
    <a href="/crud_php/public/index.php?page=jogos&action=create" class="button">Adicionar primeiro jogo</a>
  </div>
<?php endif; ?>

<?php include __DIR__ . '/../../views/includes/footer.php'; ?>
