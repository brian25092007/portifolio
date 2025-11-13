<?php
// Verifica se há uma sessão ativa
$is_logged_in = isset($_SESSION['usuario']);
$current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary-blue: #0066cc;
        --dark-blue: #004399;
        --light-blue: #e6f2ff;
        --white: #ffffff;
        --gray-light: #f5f5f5;
        --gray-medium: #808080;
        --gray-dark: #333333;
    }

    .navbar {
        background: var(--white);
        padding: 16px 0;
        box-shadow: 0 2px 8px rgba(0, 102, 204, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
        border-bottom: 2px solid var(--light-blue);
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .navbar-logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-blue);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar-logo:hover {
        opacity: 0.85;
    }

    .navbar-menu {
        display: flex;
        gap: 8px;
        align-items: center;
        list-style: none;
    }

    .navbar-item {
        position: relative;
    }

    .navbar-link {
        display: block;
        padding: 10px 18px;
        color: var(--gray-dark);
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        border-radius: 8px;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .navbar-link:hover {
        color: var(--primary-blue);
        background: var(--light-blue);
    }

    .navbar-link.active {
        color: var(--primary-blue);
        background: var(--light-blue);
    }

    .navbar-link.btn-primary {
        background: var(--primary-blue);
        color: var(--white);
    }

    .navbar-link.btn-primary:hover {
        background: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    }

    .navbar-link.btn-danger {
        background: #dc3545;
        color: var(--white);
    }

    .navbar-link.btn-danger:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .navbar-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
    }

    .navbar-toggle span {
        display: block;
        width: 25px;
        height: 3px;
        background: var(--gray-dark);
        margin: 5px 0;
        border-radius: 2px;
        transition: all 0.3s;
    }

    @media (max-width: 768px) {
        .navbar-container {
            flex-wrap: wrap;
        }

        .navbar-toggle {
            display: block;
            order: 3;
        }

        .navbar-menu {
            width: 100%;
            flex-direction: column;
            gap: 8px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .navbar-menu.active {
            max-height: 500px;
            margin-top: 16px;
        }

        .navbar-link {
            width: 100%;
            text-align: center;
        }
    }
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="homepage.php" class="navbar-logo">
            📅 EventoHub
        </a>

        <button class="navbar-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="navbar-menu" id="navbarMenu">
            <li class="navbar-item">
                <a href="homepage.php" class="navbar-link <?php echo $current_page === 'homepage.php' ? 'active' : ''; ?>">
                    Início
                </a>
            </li>
            <li class="navbar-item">
                <a href="evento_anuncio.php" class="navbar-link <?php echo $current_page === 'evento_anuncio.php' ? 'active' : ''; ?>">
                    Ver Eventos
                </a>
            </li>
            
            <?php if ($is_logged_in): ?>
                <li class="navbar-item">
                    <a href="criar_eventos.php" class="navbar-link btn-primary <?php echo $current_page === 'criar_eventos.php' ? 'active' : ''; ?>">
                        + Criar Evento
                    </a>
                </li>
                <li class="navbar-item">
                    <a href="../backend/auth/logout.php" class="navbar-link btn-danger">
                        Sair
                    </a>
                </li>
            <?php else: ?>
                <li class="navbar-item">
                    <a href="index.php" class="navbar-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>">
                        Login
                    </a>
                </li>
                <li class="navbar-item">
                    <a href="cadastro.php" class="navbar-link btn-primary <?php echo $current_page === 'cadastro.php' ? 'active' : ''; ?>">
                        Cadastrar
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.getElementById('navbarMenu');
        menu.classList.toggle('active');
    }

    // Fecha o menu ao clicar fora em mobile
    document.addEventListener('click', function(event) {
        const navbar = document.querySelector('.navbar-container');
        const menu = document.getElementById('navbarMenu');
        const toggle = document.querySelector('.navbar-toggle');
        
        if (!navbar.contains(event.target) && menu.classList.contains('active')) {
            menu.classList.remove('active');
        }
    });
</script>
