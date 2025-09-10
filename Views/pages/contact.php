<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - EcoleSpace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #6366f1;
            --success-color: #22c55e;
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

        /* Navigation */
        .navbar {
            background-color: var(--card-background) !important;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            color: var(--text-primary) !important;
            font-size: 1.25rem;
            text-decoration: none;
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

        .btn-link {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-link:hover {
            color: var(--primary-color);
            background-color: rgba(59, 130, 246, 0.1);
        }

        .btn-connexion, .btn-inscription {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-left: 8px;
        }

        .btn-connexion {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            background: transparent;
        }

        .btn-connexion:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-inscription {
            background: var(--primary-color);
            color: white;
            border: 2px solid var(--primary-color);
        }

        .btn-inscription:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
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
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .badge-secondary {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            backdrop-filter: blur(10px);
        }

        .display-4 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .lead {
            font-size: 1.125rem;
            opacity: 0.95;
        }

        /* Form Styles */
        .contact-card {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-color);
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid var(--border-color);
            padding: 12px 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-2px);
        }

        /* Contact Info Cards */
        .contact-info-card {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            height: 100%;
        }

        .contact-info-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-blue {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
        }

        .icon-green {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-color);
        }

        /* Quick Contact Card */
        .quick-contact-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin-top: 2rem;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
            color: white;
        }

        /* FAQ Cards */
        .faq-card {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .faq-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        /* Alerts */
        .alert-success {
            background-color: rgba(34, 197, 94, 0.1);
            border-color: var(--success-color);
            color: #166534;
            border-radius: 8px;
        }

        /* Footer */
        footer {
            background-color: var(--card-background);
            border-top: 1px solid var(--border-color);
            padding: 2rem 0;
            margin-top: 3rem;
        }

        /* Shadow utilities */
        .shadow-soft {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0;
            }
            
            .display-4 {
                font-size: 2.5rem;
            }

            .d-flex.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-soft">
        <div class="container">
            <div class="d-flex align-items-center">
                <a href="../../index.php" class="btn btn-link me-3">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
                <a class="navbar-brand" href="../../index.php">
                    <div class="logo-icon me-2">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    EcoleSpace
                </a>
            </div>
            
            <div class="d-flex">
                <a href="../authentification/login.php" class="btn-connexion">Connexion</a>
                <a href="register.html" class="btn-inscription">Inscription</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <span class="badge badge-secondary mb-4">Contactez-nous</span>
            <h1 class="display-4 mb-4">Nous sommes là pour vous aider</h1>
            <p class="lead mx-auto" style="max-width: 600px;">
                Une question sur EcoleSpace ? Besoin d'une démonstration ? Notre équipe d'experts 
                est à votre disposition pour vous accompagner dans votre projet.
            </p>
        </div>
    </section>

    <!-- Success Message (initially hidden) -->
    <div class="container mt-4">
        <div id="successAlert" class="alert alert-success alert-dismissible fade" role="alert" style="display: none;">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Message envoyé !</strong> Nous vous répondrons dans les plus brefs délais.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>

    <!-- Contact Form & Info -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="contact-card p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-comment-dots text-primary me-2"></i>
                            <h3 class="mb-0">Envoyez-nous un message</h3>
                        </div>
                        
                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nom complet *</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="establishment" class="form-label">Établissement</label>
                                <input type="text" class="form-control" id="establishment" name="establishment" placeholder="Nom de votre école/collège/lycée">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet *</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Objet de votre message" required>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Décrivez votre demande en détail..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-6">
                    <h2 class="mb-4">Informations de contact</h2>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <div class="d-flex align-items-start">
                                    <div class="icon-wrapper icon-blue me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Email</h5>
                                        <p class="mb-1">contact@ecolespace.fr</p>
                                        <small class="text-muted">Réponse sous 24h</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <div class="d-flex align-items-start">
                                    <div class="icon-wrapper icon-blue me-3">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Téléphone</h5>
                                        <p class="mb-1">+33 1 23 45 67 89</p>
                                        <small class="text-muted">Lun-Ven 9h-18h</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <div class="d-flex align-items-start">
                                    <div class="icon-wrapper icon-blue me-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Adresse</h5>
                                        <p class="mb-1">42 Rue de l'Innovation</p>
                                        <small class="text-muted">75001 Paris, France</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <div class="d-flex align-items-start">
                                    <div class="icon-wrapper icon-blue me-3">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Horaires</h5>
                                        <p class="mb-1">9h00 - 18h00</p>
                                        <small class="text-muted">Du lundi au vendredi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Contact -->
                    <div class="quick-contact-card">
                        <h5 class="d-flex align-items-center mb-3">
                            <i class="fas fa-building me-2"></i>
                            Vous représentez un établissement ?
                        </h5>
                        <p class="mb-3" style="opacity: 0.9;">
                            Demandez une démonstration personnalisée et découvrez comment EcoleSpace 
                            peut transformer la gestion de votre établissement.
                        </p>
                        <button class="btn btn-secondary" onclick="requestDemo()">Demander une démo</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-5" style="background-color: rgba(248, 250, 252, 0.5);">
        <div class="container" style="max-width: 800px;">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Questions fréquentes</h2>
                <p class="lead text-muted">Retrouvez les réponses aux questions les plus courantes</p>
            </div>

            <div class="row g-4">
                <div class="col-12">
                    <div class="faq-card">
                        <div class="d-flex align-items-start">
                            <div class="icon-wrapper icon-green me-3" style="width: 32px; height: 32px;">
                                <i class="fas fa-question-circle" style="font-size: 1rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Comment démarrer avec EcoleSpace ?</h5>
                                <p class="text-muted mb-0">Contactez-nous pour une démonstration personnalisée et un accompagnement complet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="faq-card">
                        <div class="d-flex align-items-start">
                            <div class="icon-wrapper icon-green me-3" style="width: 32px; height: 32px;">
                                <i class="fas fa-question-circle" style="font-size: 1rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Quels sont les tarifs ?</h5>
                                <p class="text-muted mb-0">Nos tarifs s'adaptent à la taille de votre établissement. Demandez un devis gratuit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="faq-card">
                        <div class="d-flex align-items-start">
                            <div class="icon-wrapper icon-green me-3" style="width: 32px; height: 32px;">
                                <i class="fas fa-question-circle" style="font-size: 1rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Les données sont-elles sécurisées ?</h5>
                                <p class="text-muted mb-0">Oui, nous respectons le RGPD et utilisons un chiffrement de niveau bancaire.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="faq-card">
                        <div class="d-flex align-items-start">
                            <div class="icon-wrapper icon-green me-3" style="width: 32px; height: 32px;">
                                <i class="fas fa-question-circle" style="font-size: 1rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Proposez-vous une formation ?</h5>
                                <p class="text-muted mb-0">Nous offrons une formation complète à tous les utilisateurs de votre établissement.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <div class="logo-icon me-2" style="width: 24px; height: 24px;">
                    <i class="fas fa-graduation-cap" style="font-size: 1rem;"></i>
                </div>
                <span class="fw-bold">EcoleSpace</span>
            </div>
            <p class="text-muted small mb-0">© 2024 EcoleSpace. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gestion du formulaire de contact
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validation des champs
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const message = document.getElementById('message').value.trim();
            
            if (!name || !email || !subject || !message) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }
            
            // Validation email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Veuillez entrer une adresse email valide.');
                return;
            }
            
            // Simulation d'envoi
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
            submitBtn.disabled = true;
            
            setTimeout(function() {
                // Affichage du message de succès
                const successAlert = document.getElementById('successAlert');
                successAlert.style.display = 'block';
                successAlert.classList.add('show');
                
                // Scroll vers le message
                successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Réinitialisation du formulaire
                document.getElementById('contactForm').reset();
                
                // Restaurer le bouton
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Masquer le message après 5 secondes
                setTimeout(function() {
                    successAlert.classList.remove('show');
                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 150);
                }, 5000);
            }, 2000);
        });

        // Fonction pour demander une démo
        function requestDemo() {
            // Pré-remplir le formulaire pour une demande de démo
            document.getElementById('subject').value = 'Demande de démonstration';
            document.getElementById('message').value = 'Bonjour,\n\nJe souhaiterais planifier une démonstration d\'EcoleSpace pour notre établissement.\n\nMerci de me recontacter pour convenir d\'un rendez-vous.\n\nCordialement.';
            
            // Scroll vers le formulaire
            document.getElementById('contactForm').scrollIntoView({ behavior: 'smooth' });
            
            // Focus sur le champ nom
            document.getElementById('name').focus();
        }

        // Animation des cartes au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Appliquer l'animation aux cartes
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.contact-info-card, .faq-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                
                // Animation décalée
                setTimeout(() => {
                    observer.observe(card);
                }, index * 100);
            });
        });

        // Validation en temps réel
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });
        });
    </script>
</body>
</html>