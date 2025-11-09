<?php
// views/includes/footer.php
?>
    <footer class="site-footer" role="contentinfo">
      <div>Equipe Beta ESOFB - Todos os direitos reservados.</div>
      <div style="margin-top:6px; color:var(--muted);">CRUD feito para a matéria de Técnicas e Linguagens de Programação.</div>
    </footer>
  </div> 

  <!-- MODAL DE DETALHES -->
  <div id="game-modal" class="modal" style="
      position: fixed; inset: 0;
      display: none; justify-content: center; align-items: center; 
      background: rgba(0,0,0,0.65); backdrop-filter: blur(6px);
      z-index: 9999;">
    <div style="
        background: var(--panel);
        border-radius: var(--radius);
        padding: 24px;
        width: 420px;
        box-shadow: var(--shadow-strong);
        border:1px solid rgba(255,255,255,0.05);
        position: relative;">
      
      <h2 id="modal-title" style="margin-top:0; text-shadow:inherit;"></h2>
      <p id="modal-desc" style="font-size:14px; color:var(--subtle); line-height:1.3;"></p>

      <div style="margin-top:14px; font-size:14px;">
        <strong>Ano:</strong> <span id="modal-year"></span><br>
        <strong>Gênero(s):</strong> <span id="modal-genre"></span><br>
        <strong>Classificação:</strong> <span id="modal-rating"></span>
      </div>

      <button onclick="closeModal()" class="button ghost" style="margin-top:18px; width:100%;">Fechar</button>
    </div>
  </div>

  <script>
  function openModal(data) {
    document.getElementById("modal-title").innerText = data.title;
    document.getElementById("modal-desc").innerText = data.desc;
    document.getElementById("modal-year").innerText = data.year;
    document.getElementById("modal-genre").innerText = data.genre;
    document.getElementById("modal-rating").innerText = data.rating;
    document.getElementById("game-modal").style.display = "flex";
  }
  function closeModal() {
    document.getElementById("game-modal").style.display = "none";
  }
  </script>

</body>
</html>
