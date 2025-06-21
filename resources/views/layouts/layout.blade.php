
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
            --neon-cyan: #00f5ff;
            --neon-purple: #8a2be2;
            --neon-green: #39ff14;
            --neon-orange: #ff6600;
            --neon-pink: #ff1493;
            --neon-blue: #0080ff;
            --dark-void: #0a0a0f;
            --dark-space: #1a1a2e;
            --dark-navy: #16213e;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Exo 2', sans-serif;
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 245, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(138, 43, 226, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(57, 255, 20, 0.05) 0%, transparent 50%),
                linear-gradient(135deg, var(--dark-void) 0%, var(--dark-space) 50%, var(--dark-navy) 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #e0e0ff;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Fondo animado con partículas flotantes */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(2px 2px at 30px 50px, var(--neon-cyan), transparent),
                radial-gradient(1px 1px at 80px 20px, var(--neon-purple), transparent),
                radial-gradient(1px 1px at 150px 80px, var(--neon-green), transparent),
                radial-gradient(2px 2px at 200px 30px, var(--neon-orange), transparent),
                radial-gradient(1px 1px at 250px 60px, var(--neon-pink), transparent);
            background-repeat: repeat;
            background-size: 300px 200px;
            animation: float-particles 25s linear infinite;
            z-index: -1;
            opacity: 0.4;
        }
        
        @keyframes float-particles {
            0% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-100px) translateX(20px); }
            50% { transform: translateY(-200px) translateX(-10px); }
            75% { transform: translateY(-300px) translateX(15px); }
            100% { transform: translateY(-400px) translateX(0px); }
        }
        
        /* Loading futurista mejorado */
        .loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--dark-void), var(--dark-space));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: all 0.8s ease;
        }
        
        .cyber-loader {
            width: 120px;
            height: 120px;
            position: relative;
            margin-bottom: 2rem;
        }
        
        .cyber-loader::before,
        .cyber-loader::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            animation: cyber-pulse 2s linear infinite;
        }
        
        .cyber-loader::before {
            width: 100%;
            height: 100%;
            border: 3px solid transparent;
            border-top-color: var(--neon-cyan);
            border-right-color: var(--neon-purple);
            animation: cyber-spin 1.5s linear infinite;
        }
        
        .cyber-loader::after {
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            border: 2px solid transparent;
            border-bottom-color: var(--neon-green);
            border-left-color: var(--neon-orange);
            animation: cyber-spin 1s linear infinite reverse;
        }
        
        .loading-text {
            font-family: 'Orbitron', monospace;
            font-size: 1.2rem;
            color: var(--neon-cyan);
            text-shadow: 0 0 20px var(--neon-cyan);
            animation: loading-blink 1.5s ease-in-out infinite alternate;
        }
        
        @keyframes cyber-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes cyber-pulse {
            0%, 100% { filter: drop-shadow(0 0 10px currentColor); }
            50% { filter: drop-shadow(0 0 30px currentColor); }
        }
        
        @keyframes loading-blink {
            0% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        /* Título principal mejorado */
        .query-title {
            font-family: 'Orbitron', monospace;
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 900;
            text-align: center;
            background: linear-gradient(45deg, var(--neon-cyan), var(--neon-purple), var(--neon-green), var(--neon-cyan));
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-flow 4s ease infinite, title-glow 2s ease-in-out infinite alternate;
            margin: 3rem 0 2rem 0;
            position: relative;
            letter-spacing: 2px;
        }
        
        .query-title::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
            animation: line-pulse 3s ease-in-out infinite;
        }
        
        .query-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--neon-purple), transparent);
            animation: line-pulse 3s ease-in-out infinite 1.5s;
        }
        
        @keyframes gradient-flow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes title-glow {
            0% { filter: drop-shadow(0 0 10px rgba(0, 245, 255, 0.5)); }
            100% { filter: drop-shadow(0 0 30px rgba(0, 245, 255, 0.8)); }
        }
        
        @keyframes line-pulse {
            0%, 100% { opacity: 0.3; transform: translateX(-50%) scaleX(0.5); }
            50% { opacity: 1; transform: translateX(-50%) scaleX(1); }
        }
        
        /* Navegación mejorada */
        .query-nav {
            background: rgba(26, 26, 46, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            padding: 1.5rem 2rem;
            margin: 0 auto 3rem auto;
            max-width: 800px;
            position: relative;
            overflow: hidden;
        }
        
        .query-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 245, 255, 0.1), transparent);
            animation: nav-shimmer 3s ease-in-out infinite;
        }
        
        @keyframes nav-shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        .query-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }
        
        .query-nav li a {
            color: #e0e0ff;
            text-decoration: none;
            padding: 1rem 2rem;
            border: 2px solid transparent;
            border-radius: 25px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .query-nav li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }
        
        .query-nav li a:hover::before {
            left: 100%;
        }
        
        .query-nav li:nth-child(1) a {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.2);
        }
        
        .query-nav li:nth-child(1) a:hover {
            background: var(--neon-cyan);
            color: var(--dark-void);
            box-shadow: 0 0 40px rgba(0, 245, 255, 0.6);
            transform: translateY(-5px) scale(1.05);
        }
        
        .query-nav li:nth-child(2) a {
            border-color: var(--neon-purple);
            box-shadow: 0 0 20px rgba(138, 43, 226, 0.2);
        }
        
        .query-nav li:nth-child(2) a:hover {
            background: var(--neon-purple);
            color: var(--dark-void);
            box-shadow: 0 0 40px rgba(138, 43, 226, 0.6);
            transform: translateY(-5px) scale(1.05);
        }
        
        .query-nav li:nth-child(3) a {
            border-color: var(--neon-green);
            box-shadow: 0 0 20px rgba(57, 255, 20, 0.2);
        }
        
        .query-nav li:nth-child(3) a:hover {
            background: var(--neon-green);
            color: var(--dark-void);
            box-shadow: 0 0 40px rgba(57, 255, 20, 0.6);
            transform: translateY(-5px) scale(1.05);
        }
        
        /* Container mejorado */
        .container {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            padding: 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple), var(--neon-green), var(--neon-orange), var(--neon-pink), var(--neon-cyan));
            background-size: 200% 100%;
            animation: rainbow-flow 3s linear infinite;
        }
        
        @keyframes rainbow-flow {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }
        
        /* Efectos adicionales */
        .cyber-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 245, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 245, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: -1;
            animation: grid-pulse 4s ease-in-out infinite;
        }
        
        @keyframes grid-pulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.2; }
        }
        
        /* Responsive mejorado */
        @media (max-width: 768px) {
            .query-title {
                font-size: 2rem;
                margin: 2rem 0 1.5rem 0;
            }
            
            .query-nav {
                margin: 0 1rem 2rem 1rem;
                padding: 1rem;
            }
            
            .query-nav ul {
                gap: 1rem;
            }
            
            .query-nav li a {
                padding: 0.8rem 1.5rem;
                font-size: 0.8rem;
            }
            
            .container {
                margin: 0 1rem 2rem 1rem;
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }
        }
        
        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--dark-void);
            border-radius: 6px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--neon-cyan), var(--neon-purple));
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 245, 255, 0.5);
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--neon-purple), var(--neon-green));
            box-shadow: 0 0 20px rgba(138, 43, 226, 0.8);
        }
    </style>
</head>
<body>
    <!-- Grid de fondo -->
    <div class="cyber-grid"></div>
    
    <!-- Loading holográfico mejorado -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="cyber-loader"></div>
        <div class="loading-text">INICIANDO SISTEMA NEXUS...</div>
    </div>

    <h1 class="query-title">
        <i class="fas fa-cube me-3"></i>
        Sistema de Productos - Query Builder
    </h1>
    
    <nav class="query-nav">
        <ul>
            <li>
                <a href="{{ route('productos.index') }}">
                    <i class="fas fa-database"></i>
                    Lista de Productos
                </a>
            </li>
            <li>
                <a href="{{ route('productos.list') }}">
                    <i class="fas fa-filter"></i>
                    Consulta por Categoría
                </a>
            </li>
            <li>
                <a href="{{ route('productos.create') }}">
                    <i class="fas fa-plus-circle"></i>
                    Agregar Producto
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="container">
        @yield('contenido')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Loading futurista mejorado
        window.addEventListener('load', function() {
            setTimeout(function() {
                const spinner = document.getElementById('loadingSpinner');
                if (spinner) {
                    spinner.style.opacity = '0';
                    spinner.style.transform = 'scale(0.8)';
                    setTimeout(() => spinner.style.display = 'none', 800);
                }
            }, 1200);
        });
        
        // Efectos de mouse avanzados
        document.querySelectorAll('.query-nav li a').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.filter = 'drop-shadow(0 0 20px currentColor)';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.filter = 'none';
            });
        });
        
        // Efecto de partículas al hacer clic
        document.addEventListener('click', function(e) {
            const particle = document.createElement('div');
            particle.style.position = 'fixed';
            particle.style.left = e.clientX + 'px';
            particle.style.top = e.clientY + 'px';
            particle.style.width = '6px';
            particle.style.height = '6px';
            particle.style.background = 'var(--neon-cyan)';
            particle.style.borderRadius = '50%';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '9999';
            particle.style.boxShadow = '0 0 10px var(--neon-cyan)';
            
            document.body.appendChild(particle);
            
            particle.animate([
                { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                { transform: `translate(${Math.random() * 200 - 100}px, ${Math.random() * 200 - 100}px) scale(0)`, opacity: 0 }
            ], {
                duration: 1000,
                easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
            }).onfinish = () => particle.remove();
        });
        
        // Efecto de escritura para el título (solo primera carga)
        if (!sessionStorage.getItem('titleAnimated')) {
            const title = document.querySelector('.query-title');
            const originalText = title.textContent;
            title.textContent = '';
            
            let i = 0;
            const typeInterval = setInterval(() => {
                title.textContent += originalText.charAt(i);
                i++;
                if (i >= originalText.length) {
                    clearInterval(typeInterval);
                    sessionStorage.setItem('titleAnimated', 'true');
                }
            }, 100);
        }
    </script>

    @yield('scripts')
</body>
</html>