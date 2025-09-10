<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoleSpace - Plateforme éducative moderne</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #2563eb;
            --light-blue: #3b82f6;
            --teal: #0891b2;
            --green: #10b981;
            --orange: #f97316;
            --dark-gray: #374151;
            --light-gray: #f8fafc;
            --text-muted: #6b7280;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-gray);
            line-height: 1.6;
        }

        /* Navbar */
        .navbar-modern {
            background-color: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark-gray) !important;
            text-decoration: none;
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 40px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-menu a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: var(--dark-gray);
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-connexion {
            background: transparent;
            color: var(--dark-gray);
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-connexion:hover {
            background-color: #f3f4f6;
            color: var(--dark-gray);
        }

        .btn-inscription {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-inscription:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero-section {
           background: url("images/image_accueil.png") no-repeat center center;
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .badge-modern {
            background: rgba(16, 185, 129, 0.9);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 25px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 40px;
            opacity: 0.95;
            max-width: 600px;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background: var(--primary-blue);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-hero-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .btn-hero-outline {
            background: transparent;
            color: white;
            padding: 15px 30px;
            border: 2px solid white;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-hero-outline:hover {
            background: white;
            color: var(--primary-blue);
        }

        /* Hero 3D Elements */
        .hero-3d {
            position: absolute;
            right: 0;
            top: 0;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .books-stack {
            position: relative;
            transform: perspective(1000px) rotateY(-15deg);
        }

        /*.book {
            width: 60px;
            height: 80px;
            position: absolute;
            border-radius: 4px;
        }

        .book-1 {
            background: #ef4444;
            left: 0;
            z-index: 3;
        }

        .book-2 {
            background: #3b82f6;
            left: 50px;
            z-index: 2;
        }

        .book-3 {
            background: #10b981;
            left: 100px;
            z-index: 1;
        }

        .laptop {
            position: absolute;
            right: -100px;
            top: 20px;
            width: 150px;
            height: 100px;
            background: #374151;
            border-radius: 8px;
            transform: perspective(1000px) rotateY(15deg);
        }

        .laptop::before {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 20px;
            background: #1f2937;
            border-radius: 4px;
        }

        .network-dots {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.3;
        }

        .dot {
            position: absolute;
            width: 8px;
            height: 8px;
            background: var(--orange);
            border-radius: 50%;
            animation: float 3s ease-in-out infinite;
        }

        .dot:nth-child(1) { top: 20%; right: 20%; animation-delay: 0s; }
        .dot:nth-child(2) { top: 40%; right: 60%; animation-delay: 0.5s; }
        .dot:nth-child(3) { top: 60%; right: 30%; animation-delay: 1s; }
        .dot:nth-child(4) { top: 80%; right: 70%; animation-delay: 1.5s; }
*/
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Section Styles */
        .section {
            padding: 80px 0;
        }

        .section-light {
            background: var(--light-gray);
        }

        .section-white {
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-badge {
            background: rgba(16, 185, 129, 0.9);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Feature Cards */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
        }

        .icon-blue {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-blue);
        }

        .icon-green {
            background: rgba(16, 185, 129, 0.1);
            color: var(--green);
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 15px;
        }

        .feature-description {
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #1d4ed8 100%);
            padding: 80px 0;
            color: white;
            text-align: center;
        }

        .cta-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta-green {
            background: var(--green);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cta-green:hover {
            background: #059669;
            transform: translateY(-2px);
            color: white;
        }

        .btn-cta-outline {
            background: transparent;
            color: white;
            padding: 15px 30px;
            border: 2px solid white;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cta-outline:hover {
            background: white;
            color: var(--primary-blue);
        }

        /* Footer */
        .footer {
            background: white;
            padding: 60px 0 30px;
            border-top: 1px solid #e5e7eb;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .footer-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .footer-brand-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-gray);
        }

        .footer-description {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 400px;
        }

        .footer-contact {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .footer-section h6 {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-blue);
        }

        .footer-bottom {
            border-top: 1px solid #e5e7eb;
            margin-top: 40px;
            padding-top: 25px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .cta-title {
                font-size: 2.2rem;
            }
            
            .hero-3d {
                display: none;
            }
            
            .hero-buttons,
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .auth-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-connexion,
            .btn-inscription {
                width: 100%;
                text-align: center;
            }
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-gray);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }
            
            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                gap: 0;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                padding: 20px;
            }
            
            .nav-menu.show {
                display: flex;
            }
            
            .nav-menu a {
                padding: 15px 0;
                border-bottom: 1px solid #f1f5f9;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar-modern">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a href="index.php" class="navbar-brand">
                    <div class="brand-logo">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    EcoleSpace
                </a>
                
                <div class="d-flex align-items-center">
                    <ul class="nav-menu">
                        <li><a href="index.php" class="active">Accueil</a></li>
                        <li><a href="Views/pages/apropos.php">À propos</a></li>
                        <li><a href="Views/pages/contact.php">Contact</a></li>
                    </ul>
                    
                    <div class="auth-buttons ms-4">
                        <a href="Views/authentification/login.php" class="btn-connexion">Connexion</a>
                        <a href="register.php" class="btn-inscription">Inscription</a>
                    </div>
                    
                    <button class="mobile-toggle ms-3" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="badge-modern">Plateforme éducative moderne</span>
                        <h1 class="hero-title">
                            Connectez votre<br>
                            <span style="color: #1e40af;">communauté scolaire</span>
                        </h1>
                        <p class="hero-subtitle">
                            EcoleSpace facilite la communication entre parents, enseignants et 
                            administration pour un suivi scolaire optimal et une gestion simplifiée.
                        </p>
                        <div class="hero-buttons">
                            <a href="register.php" class="btn-hero-primary">Commencer gratuitement</a>
                            <a href="about.php" class="btn-hero-outline">En savoir plus</a>
                        </div>
                    </div>
                </div>
               <!-- <div class="col-lg-6">
                    <div class="hero-3d">
                        <div class="books-stack">
                            <div class="book book-1"></div>
                            <div class="book book-2"></div>
                            <div class="book book-3"></div>
                        </div>
                        <div class="laptop"></div>
                        <div class="network-dots">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </section>

    <!-- Features for Parents -->
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Pour les parents</span>
                <h2 class="section-title">Restez connectés à la scolarité de vos enfants</h2>
                <p class="section-subtitle">
                    Suivez en temps réel la progression scolaire, communiquez facilement 
                    avec les enseignants et gérez toutes les démarches administratives.
                </p>
            </div>
            
            <div class="feature-grid">
                <?php
                $parentFeatures = [
                    [
                        'icon' => 'fas fa-book-open',
                        'title' => 'Suivi scolaire',
                        'description' => 'Consultez les notes, devoirs et progression de vos enfants en temps réel'
                    ],
                    [
                        'icon' => 'fas fa-calendar',
                        'title' => 'Calendrier intégré',
                        'description' => 'Accédez aux emplois du temps, événements scolaires et rendez-vous'
                    ],
                    [
                        'icon' => 'fas fa-comments',
                        'title' => 'Communication directe',
                        'description' => 'Échangez facilement avec les enseignants et l\'administration'
                    ],
                    [
                        'icon' => 'fas fa-credit-card',
                        'title' => 'Paiements en ligne',
                        'description' => 'Réglez les frais scolaires et activités en toute sécurité'
                    ]
                ];
                
                foreach ($parentFeatures as $feature): ?>
                    <div class="feature-card">
                        <div class="feature-icon icon-blue">
                            <i class="<?php echo $feature['icon']; ?>"></i>
                        </div>
                        <h3 class="feature-title"><?php echo $feature['title']; ?></h3>
                        <p class="feature-description"><?php echo $feature['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Features for Administration -->
    <section class="section section-white">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Pour l'administration</span>
                <h2 class="section-title">Simplifiez la gestion de votre établissement</h2>
                <p class="section-subtitle">
                    Centralisez toutes les données, automatisez les processus administratifs 
                    et obtenez une vue d'ensemble complète de votre établissement.
                </p>
            </div>
            
            <div class="feature-grid">
                <?php
                $adminFeatures = [
                    [
                        'icon' => 'fas fa-users',
                        'title' => 'Gestion des utilisateurs',
                        'description' => 'Administration complète des élèves, parents et personnel'
                    ],
                    [
                        'icon' => 'fas fa-chart-bar',
                        'title' => 'Analyses et rapports',
                        'description' => 'Tableaux de bord et statistiques détaillées sur l\'établissement'
                    ],
                    [
                        'icon' => 'fas fa-shield-alt',
                        'title' => 'Sécurité avancée',
                        'description' => 'Contrôle d\'accès et protection des données sensibles'
                    ],
                    [
                        'icon' => 'fas fa-calendar-alt',
                        'title' => 'Planification globale',
                        'description' => 'Gestion centralisée des horaires et événements scolaires'
                    ]
                ];
                
                foreach ($adminFeatures as $feature): ?>
                    <div class="feature-card">
                        <div class="feature-icon icon-green">
                            <i class="<?php echo $feature['icon']; ?>"></i>
                        </div>
                        <h3 class="feature-title"><?php echo $feature['title']; ?></h3>
                        <p class="feature-description"><?php echo $feature['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Prêt à transformer votre gestion scolaire ?</h2>
            <p class="cta-subtitle">
                Rejoignez les centaines d'établissements qui font déjà confiance à EcoleSpace 
                pour améliorer leur communication et leur efficacité.
            </p>
            <div class="cta-buttons">
                <a href="register.php" class="btn-cta-green">Démarrer maintenant</a>
                <a href="contact.php" class="btn-cta-outline">Demander une démo</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="footer-brand-name">EcoleSpace</span>
                    </div>
                    <p class="footer-description">
                        La plateforme de gestion scolaire moderne qui connecte parents, 
                        enseignants et administration pour une éducation collaborative.
                    </p>
                    <div class="footer-contact">
                        <div class="footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>contact@ecolespace.fr</span>
                        </div>
                        <div class="footer-contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+33 1 23 45 67 89</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h6>Navigation</h6>
                        <ul class="footer-links">
                            <li><a href="index.php">Accueil</a></li>
                            <li><a href="about.php">À propos</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="login.php">Connexion</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h6>Légal</h6>
                        <ul class="footer-links">
                            <li><a href="privacy.php">Confidentialité</a></li>
                            <li><a href="terms.php">Conditions d'utilisation</a></li>
                            <li><a href="cookies.php">Cookies</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 EcoleSpace. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const navMenu = document.querySelector('.nav-menu');
            const toggleIcon = document.querySelector('.mobile-toggle i');
            
            navMenu.classList.toggle('show');
            
            if (navMenu.classList.contains('show')) {
                toggleIcon.className = 'fas fa-times';
            } else {
                toggleIcon.className = 'fas fa-bars';
            }
        }

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Initialize animations
        document.addEventListener