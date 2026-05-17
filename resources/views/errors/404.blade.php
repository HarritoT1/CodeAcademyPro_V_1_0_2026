<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --body-background: linear-gradient(358deg,rgba(121, 4, 217, 1) 0%, rgba(164, 4, 217, 1) 50%, rgba(210, 4, 217, 1) 75%);
            --button-color: radial-gradient(circle,rgba(121, 4, 217, 1) 0%, rgba(185, 4, 217, 1) 35%, rgba(121, 4, 217, 1) 100%);
            --extra-color-1: #c57ce1;
            --extra-color-2: #b9a67b;
            --extra-color-3: #8f9fb5;
            --textfont: 'Inter', Arial, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--textfont);
            background: var(--body-background);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Partículas de fondo animadas */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .container {
            text-align: center;
            z-index: 10;
            position: relative;
            max-width: 600px;
            padding: 2rem;
        }

        .error-code {
            font-size: clamp(4rem, 12vw, 10rem);
            font-weight: 700;
            background: linear-gradient(45deg, #fff, var(--extra-color-1), #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            animation: glow 2s ease-in-out infinite alternate;
            text-shadow: 0 0 20px rgba(197, 124, 225, 0.5);
        }

        @keyframes glow {
            from {
                filter: drop-shadow(0 0 20px var(--extra-color-1));
            }
            to {
                filter: drop-shadow(0 0 40px var(--extra-color-1));
            }
        }

        .error-title {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            color: #fff;
            font-weight: 500;
            margin-bottom: 1rem;
            opacity: 0;
            animation: slideInUp 1s ease-out 0.5s forwards;
        }

        .error-message {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            line-height: 1.6;
            opacity: 0;
            animation: slideInUp 1s ease-out 0.8s forwards;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2.5rem;
            background: var(--button-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            opacity: 0;
            animation: slideInUp 1s ease-out 1.1s forwards;
            box-shadow: 0 10px 30px rgba(121, 4, 217, 0.4);
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(121, 4, 217, 0.6);
        }

        .btn-home:active {
            transform: translateY(-1px);
        }

        .btn-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .btn-home:hover .btn-icon {
            transform: scale(1.1);
        }

        /* Icono animado 404 */
        .error-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            position: relative;
            opacity: 0;
            animation: bounceIn 1s ease-out 0.2s forwards;
        }

        .error-icon::before,
        .error-icon::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        .error-icon::before {
            width: 80px;
            height: 80px;
            top: 20px;
            left: 20px;
            animation: rotate 10s linear infinite;
        }

        .error-icon::after {
            width: 40px;
            height: 40px;
            top: 10px;
            right: 10px;
            animation: rotateReverse 8s linear infinite reverse;
        }

        @keyframes rotate {
            100% { transform: rotate(360deg); }
        }

        @keyframes rotateReverse {
            100% { transform: rotate(-360deg); }
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 1rem;
            }
            
            .error-message {
                font-size: 1rem;
            }
        }

        /* Ondas de energía */
        .energy-wave {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300px;
            height: 300px;
            border: 2px solid rgba(197, 124, 225, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 3s ease-out infinite;
            z-index: 5;
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(0.5);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(2);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="particles" id="particles"></div>
    <div class="energy-wave"></div>
    
    <div class="container">
        <div class="error-icon"></div>
        <h1 class="error-code">404</h1>
        <h2 class="error-title">¡Ups! Página no encontrada</h2>
        <p class="error-message">
            Parece que la página que buscas se ha perdido en el universo digital.
            ¡No te preocupes! Estamos aquí para ayudarte.
        </p>
        <a href="/usercourses" class="btn-home" title="Inicio" class="element-animation">
            <span class="btn-icon">🏠</span>
            Volver al inicio
        </a>
    </div>

    <script>
        // Generar partículas flotantes
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 8 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
                
                particlesContainer.appendChild(particle);
            }
        }

        // Efecto de ondas al cargar
        function createWaves() {
            const container = document.querySelector('.container');
            setTimeout(() => {
                for (let i = 0; i < 3; i++) {
                    setTimeout(() => {
                        const wave = document.createElement('div');
                        wave.className = 'energy-wave';
                        document.body.appendChild(wave);
                        
                        setTimeout(() => wave.remove(), 3000);
                    }, i * 500);
                }
            }, 500);
        }

        // Inicializar animaciones
        window.addEventListener('load', () => {
            createParticles();
            createWaves();
            
            // Pequeña interacción al mover el mouse
            document.addEventListener('mousemove', (e) => {
                const waves = document.querySelectorAll('.energy-wave');
                waves.forEach(wave => {
                    const rect = wave.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    wave.style.setProperty('--mouse-x', `${x}px`);
                    wave.style.setProperty('--mouse-y', `${y}px`);
                });
            });
        });

        // Prevenir zoom en dispositivos móviles
        document.addEventListener('touchmove', function (event) {
            if (event.scale !== 1) { event.preventDefault(); }
        }, { passive: false });
    </script>
</body>
</html>