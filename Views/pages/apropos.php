
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - EcoleSpace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/lucide.min.css" rel="stylesheet">
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
        }

        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .navbar {
            background-color: var(--card-background) !important;
            border-bottom: 1px solid var(--border-color);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            color: var(--text-primary) !important;
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
            background: var(--gradient-hero);
            padding: 80px 0;
        }

        .badge-secondary {
            background-color: var(--secondary-color);
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }

        .card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-medium);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(30, 64, 175, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--education-blue);
        }

        .value-icon {
            width: 48px;
            height: 48px;
            background: rgba(22, 163, 74, 0.1);
            border-radius: 8px;
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
            background-color: rgba(241, 245, 249, 0.3);
        }

        .team-section {
            background-color: rgba(241, 245, 249, 0.3);
        }

        /* Animation pour les icônes Lucide */
        [data-lucide] {
            width: 1em;
            height: 1em;
        }

        /* Animation au survol des cartes */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
        }

        /* Compteurs animés */
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--text-primary);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-soft">
        <div class="container">
            <div class="d-flex align-items-center gap-4">
                <a href="#" class="back-link">
                    <i data-lucide="arrow-left"></i>
                    Retour
                </a>
                <a class="navbar-brand" href="#">
                    <div class="logo-icon">
                        <i data-lucide="graduation-cap"></i>
                    </div>
                    EcoleSpace
                </a>
            </div>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-outline-primary">Connexion</a>
                <a href="#" class="btn btn-primary">Inscription</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <span class="badge badge-secondary">À propos d'EcoleSpace</span>
            <h1 class="display-4 fw-bold mb-4">Notre mission : connecter l'éducation</h1>
            <p class="lead text-secondary mx-auto" style="max-width: 48rem;">
                Depuis 2020, EcoleSpace révolutionne la communication entre familles et établissements scolaires. 
                Notre plateforme facilite le suivi pédagogique et simplifie la gestion administrative.
            </p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i data-lucide="award"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="500">0+</div>
                            <div class="small text-muted">Établissements</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i data-lucide="users"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="50">0k+</div>
                            <div class="small text-muted">Familles connectées</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i data-lucide="graduation-cap"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="200">0k+</div>
                            <div class="small text-muted">Élèves suivis</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body p-4">
                            <div class="stat-icon mx-auto mb-3">
                                <i data-lucide="target"></i>
                            </div>
                            <div class="stat-number mb-1" data-count="99">0.9%</div>
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
                <h2 class="display-6 fw-bold mb-3">Nos valeurs</h2>
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
                                    <i data-lucide="target"></i>
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
                                    <i data-lucide="check-circle"></i>
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
                                    <i data-lucide="award"></i>
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
                                    <i data-lucide="users"></i>
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
                <h2 class="display-6 fw-bold mb-3">Notre équipe</h2>
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
            <h2 class="display-6 fw-bold mb-3">Une question ? Contactez-nous !</h2>
            <p class="lead mb-4 mx-auto opacity-75" style="max-width: 32rem;">
                Notre équipe est à votre disposition pour répondre à toutes vos questions 
                et vous accompagner dans votre projet.
            </p>
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                <a href="#" class="btn btn-light btn-lg">
                    <i data-lucide="mail" class="me-2"></i>
                    Nous contacter
                </a>
                <a href="tel:+33123456789" class="btn btn-outline-light btn-lg">
                    <i data-lucide="phone" class="me-2"></i>
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
                    <i data-lucide="graduation-cap" style="width: 16px; height: 16px;"></i>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/lucide.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Animated counters
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60 FPS
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
        const observerOptions = {
            threshold: 0.5,
            triggerOnce: true
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('[data-count]');
                    counters.forEach(counter => {
                        animateCounter(counter);
                    });
                }
            });
        }, observerOptions);

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

        // Initialize cards as hidden
        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        // Reveal cards on scroll
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check

        // Add parallax effect to hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero-section');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });
    </script>
</body>
</html>