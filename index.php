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
        <link rel="stylesheet" href="css/styles.css">

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar-modern">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a href="../index.php" class="navbar-brand">
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
                        <a href="login.php" class="btn-connexion">Connexion</a>
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
                        <div class="laptop"></div>
                        <div class="network-dots">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                </div>
            </div>
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