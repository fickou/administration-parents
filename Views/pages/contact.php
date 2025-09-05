<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - EcoleSpace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../../css/styles.css">

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-soft">
        <div class="container">
            <div class="d-flex align-items-center">
                <a href="index.html" class="btn btn-link me-3">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <a class="navbar-brand d-flex align-items-center" href="index.html">
                    <div class="logo-icon me-2">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    EcoleSpace
                </a>
            </div>
            
            <div class="d-flex">
                 <a href="login.php" class="btn-connexion">Connexion</a>
                        <a href="register.php" class="btn-inscription">Inscription</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <span class="badge badge-secondary mb-4">Contactez-nous</span>
            <h1 class="display-4 fw-bold mb-4">Nous sommes là pour vous aider</h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Une question sur EcoleSpace ? Besoin d'une démonstration ? Notre équipe d'experts 
                est à votre disposition pour vous accompagner dans votre projet.
            </p>
        </div>
    </section>

    <!-- Success Message (initially hidden) -->
    <div id="successAlert" class="alert alert-success alert-dismissible fade" role="alert" style="display: none;">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Message envoyé !</strong> Nous vous répondrons dans les plus brefs délais.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                        <p class="mb-3" style="color: rgba(255, 255, 255, 0.9);">
                            Demandez une démonstration personnalisée et découvrez comment EcoleSpace 
                            peut transformer la gestion de votre établissement.
                        </p>
                        <button class="btn btn-secondary">Demander une démo</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-5" style="background-color: rgba(248, 250, 252, 0.3);">
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
            
            // Récupération des données du formulaire
            const formData = new FormData(this);
            
            // Simulation d'envoi (remplacer par un appel AJAX réel)
            setTimeout(function() {
                // Affichage du message de succès
                const successAlert = document.getElementById('successAlert');
                successAlert.style.display = 'block';
                successAlert.classList.add('show');
                
                // Scroll vers le message
                successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Réinitialisation du formulaire
                document.getElementById('contactForm').reset();
                
                // Masquer le message après 5 secondes
                setTimeout(function() {
                    successAlert.classList.remove('show');
                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 150);
                }, 5000);
            }, 1000);
        });

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
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>

    <?php
    // Traitement PHP pour l'envoi du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération et validation des données
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $establishment = filter_input(INPUT_POST, 'establishment', FILTER_SANITIZE_STRING);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        
        $errors = [];
        
        // Validation
        if (empty($name)) $errors[] = "Le nom est requis";
        if (empty($email) || !$email) $errors[] = "Un email valide est requis";
        if (empty($subject)) $errors[] = "Le sujet est requis";
        if (empty($message)) $errors[] = "Le message est requis";
        
        if (empty($errors)) {
            // Préparation de l'email
            $to = "contact@ecolespace.fr";
            $email_subject = "Nouveau message de contact: " . $subject;
            $email_body = "Nom: $name\n";
            $email_body .= "Email: $email\n";
            if (!empty($establishment)) {
                $email_body .= "Établissement: $establishment\n";
            }
            $email_body .= "Sujet: $subject\n\n";
            $email_body .= "Message:\n$message";
            
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            // Envoi de l'email
            if (mail($to, $email_subject, $email_body, $headers)) {
                $success_message = "Message envoyé avec succès !";
            } else {
                $error_message = "Erreur lors de l'envoi du message.";
            }
        } else {
            $error_message = implode(", ", $errors);
        }
        
        // Retour JSON pour AJAX
        if (!empty($_POST['ajax'])) {
            header('Content-Type: application/json');
            if (isset($success_message)) {
                echo json_encode(['success' => true, 'message' => $success_message]);
            } else {
                echo json_encode(['success' => false, 'message' => $error_message]);
            }
            exit;
        }
    }
    ?>
</body>
</html>