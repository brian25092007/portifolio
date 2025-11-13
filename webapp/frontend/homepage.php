<?php
include '../backend/config/conexao_db.php';

$total_eventos = $conexao->query("SELECT COUNT(*) as count FROM eventos")->fetch_assoc()['count'];
$proximos_eventos = $conexao->query("SELECT * FROM eventos WHERE data >= CURDATE() ORDER BY data, hora LIMIT 3")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gerenciador de Eventos - São José dos Campos</title>
  <!-- Added external CSS link -->
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header>
    <div class="header-content">
      <div class="logo">EventoHub</div>
      <nav>
        <a href="#eventos">Ver Eventos</a>
        <a href="evento_anuncio.php">Eventos Cadastrados</a>
        <a href="criar_eventos.php" class="btn-primary">+ Criar Evento</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="hero">
      <h1>Descubra Eventos Incríveis</h1>
      <p>Encontre e crie os melhores eventos em São José dos Campos</p>
      
      <div class="stats">
        <div class="stat-card">
          <div class="stat-number"><?php echo $total_eventos; ?></div>
          <div class="stat-label">Eventos Cadastrados</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo count($proximos_eventos); ?></div>
          <div class="stat-label">Próximos Eventos</div>
        </div>
        <div class="stat-card">
          <div class="stat-number">📍</div>
          <div class="stat-label">Com Localização no Mapa</div>
        </div>
      </div>
    </section>

    <?php if (!empty($proximos_eventos)): ?>
    <section id="eventos">
      <h2 class="section-title">Próximos Eventos</h2>
      <div class="events-grid">
        <?php foreach ($proximos_eventos as $evento): ?>
        <div class="event-preview">
          <?php if (!empty($evento['imagem'])): ?>
            <img src="<?php echo htmlspecialchars($evento['imagem']); ?>" alt="<?php echo htmlspecialchars($evento['nome_evento']); ?>" class="event-preview-image">
          <?php endif; ?>
          <div class="event-preview-content">
            <h3 class="event-preview-title"><?php echo htmlspecialchars($evento['nome_evento']); ?></h3>
            <p class="event-preview-date">📅 <?php echo date("d/m/Y \à\s H:i", strtotime($evento['data'] . ' ' . $evento['hora'])); ?></p>
            <p class="event-preview-location">📍 <?php echo htmlspecialchars($evento['local']); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <div class="cta-section">
      <h2>Pronto para organizar seu evento?</h2>
      <p>Crie um novo evento e compartilhe com a comunidade</p>
      <a href="criar_eventos.php" class="cta-button">Criar Evento Agora</a>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 EventoHub - Gerenciador de Eventos | São José dos Campos, SP</p>
  </footer>
</body>
</html>
