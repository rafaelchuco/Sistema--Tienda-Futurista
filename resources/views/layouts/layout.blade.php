<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NEXUS | Sistema de Gestión')</title>
    <meta name="description" content="Sistema avanzado de gestión empresarial">
    <meta name="author" content="Rafael Chuco">
    
    <!-- Preload -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;500;600;700&display=swap" as="style">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" as="style">
    
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Colores futuristas */
            --neon-cyan: #00f5ff;
            --neon-purple: #8a2be2;
            --neon-green: #39ff14;
            --neon-orange: #ff6600;
            --neon-pink: #ff1493;
            
            --dark-void: #0a0a0f;
            --dark-space: #1a1a2e;
            --dark-navy: #16213e;
            --dark-slate: #0f3460;
            
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            
            --text-neon: #e0e0ff;
            --text-dim: #a0a0d0;
            --text-dark: #606080;
            
            /* Efectos */
            --glow-cyan: 0 0 20px rgba(0, 245, 255, 0.5);
            --glow-purple: 0 0 20px rgba(138, 43, 226, 0.5);
            --glow-green: 0 0 20px rgba(57, 255, 20, 0.5);
            
            --blur-strong: blur(20px);
            --blur-medium: blur(10px);
            --blur-light: blur(5px);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Exo 2', monospace;
            background: radial-gradient(ellipse at center, var(--dark-space) 0%, var(--dark-void) 70%);
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--text-neon);
            overflow-x: hidden;
            position: relative;
        }

        /* Fondo animado con partículas */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(2px 2px at 20px 30px, var(--neon-cyan), transparent),
                radial-gradient(2px 2px at 40px 70px, var(--neon-purple), transparent),
                radial-gradient(1px 1px at 90px 40px, var(--neon-green), transparent),
                radial-gradient(1px 1px at 130px 80px, var(--neon-orange), transparent),
                radial-gradient(2px 2px at 160px 30px, var(--neon-pink), transparent);
            background-repeat: repeat;
            background-size: 200px 100px;
            animation: stars 20s linear infinite;
            z-index: -1;
            opacity: 0.3;
        }

        @keyframes stars {
            from { transform: translateY(0px); }
            to { transform: translateY(-100px); }
        }

        /* Loading futurista */
        .loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--dark-void);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .cyber-loader {
            width: 80px;
            height: 80px;
            border: 3px solid transparent;
            border-top: 3px solid var(--neon-cyan);
            border-right: 3px solid var(--neon-purple);
            border-radius: 50%;
            animation: cyber-spin 1s linear infinite;
            filter: drop-shadow(var(--glow-cyan));
        }

        @keyframes cyber-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Navbar futurista */
        .cyber-navbar {
            background: rgba(26, 26, 46, 0.8);
            backdrop-filter: var(--blur-medium);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 32px rgba(0, 245, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .cyber-brand {
            font-family: 'Orbitron', monospace;
            font-weight: 900;
            font-size: 1.8rem;
            color: var(--neon-cyan) !important;
            text-shadow: var(--glow-cyan);
            transition: all 0.3s ease;
        }

        .cyber-brand:hover {
            transform: scale(1.1);
            text-shadow: 0 0 30px var(--neon-cyan);
        }

        .cyber-nav-link {
            color: var(--text-dim) !important;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.8rem 1.2rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cyber-nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 245, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .cyber-nav-link:hover::before {
            left: 100%;
        }

        .cyber-nav-link:hover,
        .cyber-nav-link.active {
            color: var(--neon-cyan) !important;
            background: rgba(0, 245, 255, 0.1);
            box-shadow: var(--glow-cyan);
            transform: translateY(-2px);
        }

        /* Container principal holográfico */
        .holo-container {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-medium);
            margin: 2rem auto;
            border-radius: 30px;
            border: 1px solid var(--glass-border);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            overflow: hidden;
            max-width: 1400px;
            position: relative;
        }

        .holo-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple), var(--neon-green), var(--neon-cyan));
            animation: neon-flow 3s linear infinite;
        }

        @keyframes neon-flow {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Header holográfico */
        .cyber-header {
            background: linear-gradient(135deg, 
                rgba(0, 245, 255, 0.1) 0%, 
                rgba(138, 43, 226, 0.1) 50%, 
                rgba(57, 255, 20, 0.1) 100%);
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cyber-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="hexagon" width="50" height="43.4" patternUnits="userSpaceOnUse"><polygon points="25,2 45,14.5 45,35.5 25,48 5,35.5 5,14.5" fill="none" stroke="rgba(0,245,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23hexagon)"/></svg>');
            opacity: 0.3;
        }

        .cyber-title {
            font-family: 'Orbitron', monospace;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            background: linear-gradient(45deg, var(--neon-cyan), var(--neon-purple), var(--neon-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            text-shadow: 0 0 30px rgba(0, 245, 255, 0.5);
        }

        .cyber-subtitle {
            font-size: 1.2rem;
            color: var(--text-dim);
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Sección de contenido */
        .cyber-content {
            padding: 3rem;
            background: rgba(26, 26, 46, 0.3);
            backdrop-filter: var(--blur-light);
        }

        /* Botones holográficos */
        .holo-btn {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-light);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 1rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
        }

        .holo-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .holo-btn:hover::before {
            left: 100%;
        }

        .holo-btn-primary {
            color: var(--neon-cyan);
            border-color: var(--neon-cyan);
        }

        .holo-btn-primary:hover {
            color: var(--dark-void);
            background: var(--neon-cyan);
            box-shadow: var(--glow-cyan);
            transform: translateY(-3px) scale(1.05);
        }

        .holo-btn-success {
            color: var(--neon-green);
            border-color: var(--neon-green);
        }

        .holo-btn-success:hover {
            color: var(--dark-void);
            background: var(--neon-green);
            box-shadow: var(--glow-green);
            transform: translateY(-3px) scale(1.05);
        }

        .holo-btn-danger {
            color: var(--neon-pink);
            border-color: var(--neon-pink);
        }

        .holo-btn-danger:hover {
            color: var(--dark-void);
            background: var(--neon-pink);
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.5);
            transform: translateY(-3px) scale(1.05);
        }

        .holo-btn-warning {
            color: var(--neon-orange);
            border-color: var(--neon-orange);
        }

        .holo-btn-warning:hover {
            color: var(--dark-void);
            background: var(--neon-orange);
            box-shadow: 0 0 20px rgba(255, 102, 0, 0.5);
            transform: translateY(-3px) scale(1.05);
        }

        .holo-btn-info {
            color: var(--neon-purple);
            border-color: var(--neon-purple);
        }

        .holo-btn-info:hover {
            color: var(--dark-void);
            background: var(--neon-purple);
            box-shadow: var(--glow-purple);
            transform: translateY(-3px) scale(1.05);
        }

        /* Tabla holográfica */
        .holo-table-container {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-medium);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .holo-table-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        }

        .holo-table {
            color: var(--text-neon);
            font-size: 0.9rem;
            margin: 0;
        }

        .holo-table thead th {
            background: rgba(0, 245, 255, 0.1);
            color: var(--neon-cyan);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            padding: 1.5rem 1rem;
            position: relative;
        }

        .holo-table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        }

        .holo-table tbody td {
            padding: 1.5rem 1rem;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .holo-table tbody tr:hover {
            background: rgba(0, 245, 255, 0.05);
            transform: scale(1.01);
            box-shadow: 0 4px 20px rgba(0, 245, 255, 0.1);
        }

        /* Formularios holográficos */
        .holo-form-control, .holo-form-select {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-light);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            color: var(--text-neon);
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
        }

        .holo-form-control:focus, .holo-form-select:focus {
            background: rgba(0, 245, 255, 0.05);
            border-color: var(--neon-cyan);
            box-shadow: var(--glow-cyan);
            color: var(--text-neon);
            transform: translateY(-2px);
        }

        .holo-form-control::placeholder {
            color: var(--text-dark);
        }

        .holo-form-label {
            color: var(--text-neon);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        /* Cards estadísticas holográficas */
        .holo-stats-card {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-medium);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .holo-stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple));
        }

        .holo-stats-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 245, 255, 0.2);
        }

        .holo-stats-number {
            font-family: 'Orbitron', monospace;
            font-size: 3rem;
            font-weight: 900;
            color: var(--neon-cyan);
            text-shadow: var(--glow-cyan);
            margin-bottom: 0.5rem;
        }

        .holo-stats-label {
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* Alertas holográficas */
        .holo-alert {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-medium);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .holo-alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 4px;
            background: currentColor;
        }

        .holo-alert-success {
            color: var(--neon-green);
            border-left-color: var(--neon-green);
        }

        .holo-alert-danger {
            color: var(--neon-pink);
            border-left-color: var(--neon-pink);
        }

        /* Footer holográfico */
        .cyber-footer {
            background: rgba(10, 10, 15, 0.8);
            backdrop-filter: var(--blur-medium);
            border-top: 1px solid var(--glass-border);
            margin-top: 4rem;
            position: relative;
        }

        .cyber-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        }

        .cyber-footer p {
            color: var(--text-dim);
            font-weight: 500;
        }

        /* Búsqueda holográfica */
        .holo-search-section {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-medium);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .holo-search-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--neon-purple), var(--neon-green));
        }

        /* Utilidades */
        .text-cyber {
            color: var(--neon-cyan) !important;
        }

        .text-neon-green {
            color: var(--neon-green) !important;
        }

        .text-neon-purple {
            color: var(--neon-purple) !important;
        }

        .text-neon-orange {
            color: var(--neon-orange) !important;
        }

        .text-muted-cyber {
            color: var(--text-dark) !important;
        }

        /* Iconos con efectos */
        .cyber-icon {
            color: var(--neon-cyan);
            filter: drop-shadow(0 0 5px currentColor);
            transition: all 0.3s ease;
        }

        .cyber-icon:hover {
            filter: drop-shadow(0 0 15px currentColor);
            transform: scale(1.2);
        }

        /* Responsive holográfico */
        @media (max-width: 768px) {
            .holo-container {
                margin: 1rem;
                border-radius: 20px;
            }
            
            .cyber-header {
                padding: 2rem 1.5rem;
            }
            
            .cyber-content {
                padding: 2rem 1.5rem;
            }
            
            .holo-stats-card {
                padding: 1.5rem;
            }
            
            .holo-btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Scrollbar holográfico */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-void);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--neon-cyan), var(--neon-purple));
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--neon-purple), var(--neon-green));
        }

        /* Animaciones adicionales */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 5px currentColor; }
            50% { box-shadow: 0 0 20px currentColor; }
        }

        .pulse-cyber {
            animation: pulse-glow 2s infinite;
        }

        /* Estados de focus mejorados */
        .holo-btn:focus,
        .holo-form-control:focus,
        .holo-form-select:focus {
            outline: 2px solid var(--neon-cyan);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- Loading holográfico -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="cyber-loader"></div>
    </div>

    <!-- Navbar futurista -->
    <nav class="navbar navbar-expand-lg cyber-navbar">
        <div class="container">
            <a class="navbar-brand cyber-brand" href="{{ route('productos.index') }}">
                <i class="fas fa-cube me-2 cyber-icon"></i>NEXUS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link cyber-nav-link {{ request()->routeIs('productos.index') ? 'active' : '' }}" href="{{ route('productos.index') }}">
                            <i class="fas fa-database me-1 cyber-icon"></i>PRODUCTOS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cyber-nav-link {{ request()->routeIs('productos.create') ? 'active' : '' }}" href="{{ route('productos.create') }}">
                            <i class="fas fa-plus-circle me-1 cyber-icon"></i>CREAR
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container principal -->
    <div class="container">
        <div class="holo-container">
            <div class="cyber-header">
                <h1 class="cyber-title">@yield('header', 'NEXUS SYSTEM')</h1>
                <p class="cyber-subtitle">@yield('description', 'Sistema Avanzado de Gestión Empresarial')</p>
            </div>

            <div class="cyber-content">
                @if(session('success'))
                    <div class="holo-alert holo-alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2 cyber-icon"></i>
                        <strong>SISTEMA:</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="holo-alert holo-alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2 cyber-icon"></i>
                        <strong>ERROR:</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="holo-alert holo-alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-bug me-2 cyber-icon"></i>
                        <strong>ERRORES DETECTADOS:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('contenido')
            </div>
        </div>
    </div>

    <!-- Footer holográfico -->
    <footer class="text-center py-4 cyber-footer">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-terminal me-1 cyber-icon"></i>
                &copy; 2025 NEXUS SYSTEM v2.0 - Desarrollado por <span class="text-cyber">Rafael Chuco</span>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Loading futurista
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loadingSpinner').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('loadingSpinner').style.display = 'none';
                }, 500);
            }, 800);
        });

        // Auto-hide alerts con efecto
        setTimeout(function() {
            const alerts = document.querySelectorAll('.holo-alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 8000);

        // Confirmación futurista
        function confirmDelete(productName) {
            return confirm(`⚠️ SISTEMA DE SEGURIDAD\n\n¿Confirmar eliminación del elemento "${productName}"?\n\nEsta operación es IRREVERSIBLE.`);
        }

        // Función de ordenamiento
        function sortTable(column, direction) {
            const url = new URL(window.location);
            url.searchParams.set('order_by', column);
            url.searchParams.set('order_direction', direction);
            window.location = url;
        }

        // Efectos de mouse para elementos holográficos
        document.querySelectorAll('.holo-stats-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.filter = 'drop-shadow(0 0 20px rgba(0, 245, 255, 0.3))';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.filter = 'none';
            });
        });

        // Atajos de teclado futuristas
        document.addEventListener('keydown', function(e) {
            // Ctrl + Shift + N para nuevo producto
            if (e.ctrlKey && e.shiftKey && e.key === 'N') {
                e.preventDefault();
                window.location.href = "{{ route('productos.create') }}";
            }
            
            // Ctrl + / para búsqueda
            if (e.ctrlKey && e.key === '/') {
                e.preventDefault();
                const searchInput = document.querySelector('#search');
                if (searchInput) {
                    searchInput.focus();
                    searchInput.style.boxShadow = '0 0 20px rgba(0, 245, 255, 0.5)';
                }
            }
        });

        // Efectos de carga en formularios
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-sync fa-spin me-1"></i>PROCESANDO...';
                    submitBtn.disabled = true;
                    submitBtn.style.background = 'rgba(0, 245, 255, 0.5)';
                }
            });
        });

        // Efecto de escritura para el título
        function typewriterEffect() {
            const titles = document.querySelectorAll('.cyber-title');
            titles.forEach(title => {
                const text = title.textContent;
                title.textContent = '';
                let i = 0;
                const timer = setInterval(() => {
                    title.textContent += text.charAt(i);
                    i++;
                    if (i >= text.length) {
                        clearInterval(timer);
                    }
                }, 100);
            });
        }

        // Ejecutar efecto solo la primera vez
        if (!sessionStorage.getItem('typewriterPlayed')) {
            typewriterEffect();
            sessionStorage.setItem('typewriterPlayed', 'true');
        }
    </script>

    @yield('scripts')
</body>
</html>