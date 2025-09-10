<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - EcoleSpace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #e2e8f0;
            --success-color: #22c55e;
            --education-blue: #1e40af;
            --education-green: #16a34a;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --background: #ffffff;
            --card-background: #ffffff;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--background);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .gradient-primary {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
        }

        .gradient-hero {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        }

        .shadow-soft {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .shadow-medium {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .navbar {
            background-color: var(--card-background) !important;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            color: var(--text-primary) !important;
            font-size: 1.25rem;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .hero-section {
            background: 
                linear-gradient(135deg, rgba(0, 39, 91, 0.6) 0%, rgba(152, 130, 204, 0.9) 100%),
                url('../../images/image_accueil.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 40% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 30%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .badge-secondary {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
            background: var(--card-background);
        }

        .card:hover {
            box-shadow: var(--shadow-medium);
            transform: translateY(-4px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
        }

        .value-icon {
            width: 48px;
            height: 48px;
            background: rgba(22, 163, 74, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--education-green);
        }

        .team-avatar {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.125rem;
        }

        .back-link {
            color: var(--text-secondary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .back-link:hover {
            color: var(--primary-color);
        }

        .footer {
            background-color: var(--card-background);
            border-top: 1px solid var(--border-color);
            padding: 2rem 0;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
        }

        .stats-section {
            background-color: rgba(248, 250, 252, 0.5);
        }

        .team-section {
            background-color: rgba(248, 250, 252, 0.5);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--text-primary);
        }

        .display-4 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .display-6 {
            font-weight: 700;
        }

        .lead {
            font-size: 1.125rem;
            font-weight: 400;
        }

        .text-secondary {
            color: var(--text-secondary) !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .btn-light {
            background: white;
            color: var(--primary-color);
            border: none;
            font-weight: 600;
        }

        .btn-light:hover {
            background: #f8f9fa;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            font-weight: 600;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 60vh;
                text-align: center;
            }
            
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }

            .navbar {
                padding: 0.5rem 0;
            }

            .d-flex.gap-4 {
                flex-direction: column;
                gap: 1rem !important;
            }
        }

        @media (max-width: 576px) {
            .d-flex.flex-column.flex-sm-row {
                gap: 1rem;
            }

            .btn-lg {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-soft">
        <div class="container">
            <div class="d-flex align-items-center gap-4">
                <a href="../../index.php" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
                <a class="navbar-brand" href="../../index.php">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    EcoleSpace
                </a>
            </div>
            <div class="d-flex gap-2">
                <a href="../authentification/login.php" class="btn btn-outline-primary">Connexion</a>
                <a href="register.html" class="btn btn-primary">Inscription</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <span class="badge badge-secondary">À propos d'EcoleSpace</span>
                <h1 class="display-4 mb-4">Notre mission : connecter l'éducation</h1>
                <p class="lead mx-auto" style="max-width: 48rem; opacity: 0.95;">
                    Depuis 2020, EcoleSpace révolutionne la communication entre familles et établissements scolaires. 
                    Notre plateforme facilite le suivi pédagogique et simplifie la gestion administrative.
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="500">500+</div>
                            <div class="small text-muted">Établissements</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="50">50k+</div>
                            <div class="small text-muted">Familles connectées</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="200">200k+</div>
                            <div class="small text-muted">Élèves suivis</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="99">99.9%</div>
                            <div class="small text-muted">Disponibilité</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 mb-3">Nos valeurs</h2>
                <p class="lead text-secondary mx-auto" style="max-width: 32rem;">
                    EcoleSpace s'appuie sur des valeurs fortes pour offrir la meilleure expérience 
                    à tous les acteurs de la communauté éducative.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card hover-lift">
                        <div class="card-body p-4">
                            <div class="d-flex gap-3">
                                <div class="value-icon flex-shrink-0">
                                    <i class="fas fa-bullseye"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-2">Innovation pédagogique</h5>
                                    <p class="text-muted mb-0">Nous développons des outils modernes pour répondre aux défis éducatifs d'aujourd'hui.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card hover-lift">
                        <div class="card-body p-4">
                            <div class="d-flex gap-3">
                                <div class="value-icon flex-shrink-0">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-2">Facilité d'utilisation</h5>
                                    <p class="text-muted mb-0">Une interface intuitive accessible à tous, sans formation technique préalable.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card hover-lift">
                        <div class="card-body p-4">
                            <div class="d-flex gap-3">
                                <div class="value-icon flex-shrink-0">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-2">Sécurité des données</h5>
                                    <p class="text-muted mb-0">Protection maximale des informations personnelles avec conformité RGPD.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card hover-lift">
                        <div class="card-body p-4">
                            <div class="d-flex gap-3">
                                <div class="value-icon flex-shrink-0">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-2">Support dédié</h5>
                                    <p class="text-muted mb-0">Une équipe d'experts disponible pour accompagner votre établissement.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5 team-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 mb-3">Notre équipe</h2>
                <p class="lead text-secondary mx-auto" style="max-width: 32rem;">
                    Des experts passionnés par l'éducation et la technologie, 
                    unis pour créer des solutions innovantes.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="team-avatar mx-auto mb-3">SD</div>
                            <h5 class="fw-semibold mb-1">Sophie Dubois</h5>
                            <div class="small text-primary fw-medium mb-3">Directrice Générale</div>
                            <p class="small text-muted">Ex-enseignante, passionnée d'innovation éducative depuis 15 ans.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="team-avatar mx-auto mb-3">ML</div>
                            <h5 class="fw-semibold mb-1">Marc Laurent</h5>
                            <div class="small text-primary fw-medium mb-3">Directeur Technique</div>
                            <p class="small text-muted">Expert en sécurité informatique et développement d'applications éducatives.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="team-avatar mx-auto mb-3">JM</div>
                            <h5 class="fw-semibold mb-1">Julie Martin</h5>
                            <div class="small text-primary fw-medium mb-3">Responsable Pédagogique</div>
                            <p class="small text-muted">Consultante en transformation numérique des établissements scolaires.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center hover-lift">
                        <div class="card-body p-4">
                            <div class="team-avatar mx-auto mb-3">TB</div>
                            <h5 class="fw-semibold mb-1">Thomas Bernard</h5>
                            <div class="small text-primary fw-medium mb-3">Responsable Support</div>
                            <p class="small text-muted">Spécialiste de l'accompagnement et de la formation des utilisateurs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 cta-section text-white">
        <div class="container text-center">
            <h2 class="display-6 mb-3">Une question ? Contactez-nous !</h2>
            <p class="lead mb-4 mx-auto" style="max-width: 32rem; opacity: 0.9;">
                Notre équipe est à votre disposition pour répondre à toutes vos questions 
                et vous accompagner dans votre projet.
            </p>
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                <a href="mailto:contact@ecolespace.fr" class="btn btn-light btn-lg">
                    <i class="fas fa-envelope me-2"></i>
                    Nous contacter
                </a>
                <a href="tel:+33123456789" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-phone me-2"></i>
                    +33 1 23 45 67 89
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <div class="logo-icon" style="width: 24px; height: 24px;">
                    <i class="fas fa-graduation-cap" style="width: 16px; height: 16px;"></i>
                </div>
                <span class="fw-bold">EcoleSpace</span>
            </div>
            <p class="small text-muted mb-0">
                &copy; 2024 EcoleSpace. Tous droits réservés.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animated counters
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    if (element.textContent.includes('k+')) {
                        element.textContent = Math.floor(current) + 'k+';
                    } else if (element.textContent.includes('.9%')) {
                        element.textContent = Math.floor(current) + '.9%';
                    } else {
                        element.textContent = Math.floor(current) + '+';
                    }
                    requestAnimationFrame(updateCounter);
                } else {
                    // Final values
                    if (target === 500) {
                        element.textContent = '500+';
                    } else if (target === 50) {
                        element.textContent = '50k+';
                    } else if (target === 200) {
                        element.textContent = '200k+';
                    } else if (target === 99) {
                        element.textContent = '99.9%';
                    }
                }
            };
            
            updateCounter();
        }

        // Intersection Observer for counter animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('[data-count]');
                    counters.forEach(counter => {
                        animateCounter(counter);
                    });
                }
            });
        }, { threshold: 0.5 });

        // Observe stats section
        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add scroll reveal animation
        function revealOnScroll() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        }

        // Initialize cards with animation
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                
                // Stagger animation
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Reveal cards on scroll
        window.addEventListener('scroll', revealOnScroll);
    </script>
</body>
</html>