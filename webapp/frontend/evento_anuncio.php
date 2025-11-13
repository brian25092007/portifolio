<?php
session_start();
include '../backend/config/conexao_db.php';

if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    $stmt = $conexao->prepare("DELETE FROM eventos WHERE id_evento = ?");
    $stmt->bind_param("i", $idExcluir);
    $stmt->execute();
    $stmt->close();

    header("Location: evento_anuncio.php");
    exit();
}

$result = $conexao->query("SELECT * FROM eventos ORDER BY data, hora");

$eventos = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $eventos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Eventos Anunciados</title>
<!-- Added external CSS link -->
<link rel="stylesheet" href="assets/style.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ymgJSOFD9yCS4hoC7hNeU8Km40bbQi0"></script>
</head>
<body>
<!-- Added navbar component -->
<?php include 'components/navbar.php'; ?>

<div class="container">
  <div class="header-section">
    <h1>Eventos Anunciados</h1>
    <a href="criar_eventos.php">+ Criar Novo Evento</a>
  </div>

  <?php if (empty($eventos)): ?>
      <p class="empty">Nenhum evento cadastrado ainda.</p>
  <?php else: ?>
      <div class="event-container">
          <?php foreach ($eventos as $evento): ?>
              <div class="event-card">
                  <?php if (!empty($evento['imagem'])): ?>
                      <img src="<?php echo htmlspecialchars($evento['imagem']); ?>" alt="Imagem do evento" class="event-image">
                  <?php endif; ?>

                  <div class="event-content">
                      <h2 class="event-title"><?php echo htmlspecialchars($evento['nome_evento']); ?></h2>
                      
                      <div class="event-meta">
                          <div class="event-detail">
                              <strong>Data:</strong>
                              <span><?php echo htmlspecialchars(date("d/m/Y", strtotime($evento['data']))); ?></span>
                          </div>
                          <div class="event-detail">
                              <strong>Hora:</strong>
                              <span><?php echo htmlspecialchars(substr($evento['hora'], 0, 5)); ?></span>
                          </div>
                          <div class="event-detail">
                              <strong>Local:</strong>
                              <span><?php echo htmlspecialchars($evento['local']); ?></span>
                          </div>
                          <div class="event-detail">
                              <strong>Capacidade:</strong>
                              <span><?php echo (int)$evento['capacidade']; ?> pessoas</span>
                          </div>
                      </div>

                      <p class="event-description"><?php echo nl2br(htmlspecialchars($evento['descricao'])); ?></p>

                      <?php if (!empty($evento['latitude']) && !empty($evento['longitude'])): ?>
                          <div class="map-container" id="map-<?php echo $evento['id_evento']; ?>"></div>
                          <script>
                              document.addEventListener('DOMContentLoaded', function() {
                                  const mapElement = document.getElementById('map-<?php echo $evento['id_evento']; ?>');
                                  if (mapElement) {
                                      const eventLocation = {
                                          lat: <?php echo floatval($evento['latitude']); ?>,
                                          lng: <?php echo floatval($evento['longitude']); ?>
                                      };
                                      
                                      const eventMap = new google.maps.Map(mapElement, {
                                          zoom: 15,
                                          center: eventLocation,
                                          mapTypeControl: false,
                                          fullscreenControl: false,
                                          zoomControl: true,
                                      });
                                      
                                      new google.maps.Marker({
                                          position: eventLocation,
                                          map: eventMap,
                                          title: '<?php echo htmlspecialchars($evento['nome_evento']); ?>'
                                      });
                                  }
                              });
                          </script>
                      <?php endif; ?>

                      <div class="buttons-group">
                          <form method="GET" style="flex: 1;">
                              <input type="hidden" name="excluir" value="<?php echo $evento['id_evento']; ?>" />
                              <button class="btn btn-delete" type="submit" onclick="return confirm('Tem certeza que deseja excluir este evento?');">Excluir</button>
                          </form>
                      </div>
                  </div>
              </div>
          <?php endforeach; ?>
      </div>
  <?php endif; ?>
</div>

</body>
</html>
