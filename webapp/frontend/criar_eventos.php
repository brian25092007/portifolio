<?php
session_start();
include '../backend/config/conexao_db.php';

$nome = $data = $local = $hora = $descricao = $capacidade = $imagem = $latitude = $longitude = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $local = $_POST['local'];
    $hora = $_POST['hora'];
    $descricao = $_POST['descricao'];
    $capacidade = $_POST['capacidade'];
    $imagem = $_POST['imagem'];
    $latitude = !empty($_POST['latitude']) ? floatval($_POST['latitude']) : null;
    $longitude = !empty($_POST['longitude']) ? floatval($_POST['longitude']) : null;

    $stmt = $conexao->prepare("INSERT INTO eventos (nome_evento, descricao, local, data, hora, capacidade, imagem, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisdd", $nome, $descricao, $local, $data, $hora, $capacidade, $imagem, $latitude, $longitude);

    if ($stmt->execute()) {
        header("Location: evento_anuncio.php");
        exit();
    } else {
        echo "Erro ao salvar evento: " . $stmt->error;
    }
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Criar Evento</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ymgJSOFD9yCS4hoC7hNeU8Km40bbQi0"></script>
</head>
<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container">
        <div class="header-section">
            <h1>Criar Novo Evento</h1>
            <a href="evento_anuncio.php">← Voltar para eventos</a>
        </div>
        
        <div class="form-wrapper">
            <form action="" method="POST" class="form-container">
                <label for="nome">Nome do Evento:</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

                <label for="data">Data do Evento:</label>
                <input type="date" name="data" id="data" value="<?php echo $data; ?>" required>

                <label for="local">Local do Evento:</label>
                <input type="text" name="local" id="local" value="<?php echo htmlspecialchars($local); ?>" required>

                <label for="hora">Hora do Evento:</label>
                <input type="time" name="hora" id="hora" value="<?php echo $hora; ?>" required>

                <label for="capacidade">Capacidade (pessoas):</label>
                <input type="number" name="capacidade" id="capacidade" value="<?php echo $capacidade; ?>" required min="1">

                <label for="imagem">URL da Imagem:</label>
                <input type="text" name="imagem" id="imagem" value="<?php echo htmlspecialchars($imagem); ?>" placeholder="https://...">

                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" required><?php echo htmlspecialchars($descricao); ?></textarea>

                <label>Coordenadas (clique no mapa):</label>
                <label for="latitude">Latitude:</label>
                <input type="hidden" name="latitude" id="latitude" value="<?php echo $latitude; ?>">
                <input type="text" id="latitude-display" readonly placeholder="Selecione no mapa">

                <label for="longitude">Longitude:</label>
                <input type="hidden" name="longitude" id="longitude" value="<?php echo $longitude; ?>">
                <input type="text" id="longitude-display" readonly placeholder="Selecione no mapa">

                <button type="submit">Criar Evento</button>
            </form>
            
            <div class="map-container">
                <div id="map"></div>
                <div class="map-info">
                    <strong>Dica:</strong> Clique no mapa para definir a localização do evento
                </div>
            </div>
        </div>
    </div>
    
    <script>
        let marker;
        let map;
        
        function initMap() {
            const defaultLocation = { lat: -23.1815, lng: -45.8877 };
            
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: defaultLocation,
                mapTypeControl: true,
                fullscreenControl: true,
            });
            
            map.addListener('click', function(event) {
                const lat = event.latLng.lat();
                const lng = event.latLng.lng();
                
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
                document.getElementById('latitude-display').value = lat.toFixed(6);
                document.getElementById('longitude-display').value = lng.toFixed(6);
                
                if (marker) {
                    marker.setPosition(event.latLng);
                } else {
                    marker = new google.maps.Marker({
                        position: event.latLng,
                        map: map,
                        title: 'Localização do Evento'
                    });
                }
            });
            
            <?php if (!empty($latitude) && !empty($longitude)): ?>
                const savedLocation = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };
                map.setCenter(savedLocation);
                marker = new google.maps.Marker({
                    position: savedLocation,
                    map: map,
                    title: 'Localização do Evento'
                });
            <?php endif; ?>
        }
        
        window.addEventListener('load', initMap);
    </script>
</body>
</html>
