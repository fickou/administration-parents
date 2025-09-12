<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - EcoleSpace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="style_inscription.css" rel="stylesheet">
</head>
<body>
    <div class="min-vh-100 d-flex">
        <!-- Image hero à gauche (cachée sur mobile) -->
       
        <div class="d-none d-lg-flex col-lg-6 position-relative hero-section">
            <img src="../../images/image_accueil.png" alt="École moderne" class="w-100 h-100 object-fit-cover">
            <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay d-flex align-items-center justify-content-center">
                <div class="text-center text-white p-4">
                    <h1 class="display-4 fw-bold mb-4">Rejoignez EcoleSpace</h1>
                    <p class="fs-5 opacity-90">
                        La plateforme moderne de communication école-famille
                    </p>
                </div>
            </div>
        </div>

        <!-- Formulaire d'inscription à droite -->
   <div class="col-12 col-lg-6 d-flex align-items-start justify-content-center p-4 bg-light">
    <div class="w-100" style="max-width: 700px;"> <!-- plus large -->
        <div class="d-flex align-items-center gap-5 mb-4">
            <a href="../../index.php" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-2"></i>
                Retour
            </a>
        </div>

                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="card-title mb-2">Créer un compte</h2>
                        <p class="mb-0">Remplissez vos informations pour vous inscrire</p>
                    </div>
                    <div class="card-body">
                        <!-- Messages d'erreur/succès -->
                        <div id="messages"></div>

                        <form id="registerForm" action="register.php" method="POST">
                            <!-- Type d'utilisateur -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Type d'utilisateur <span class="text-danger">*</span></label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Sélectionnez votre rôle</option>
                                    <option value="parent">Parent d'élève</option>
                                    <option value="enseignant">Enseignant</option>
                                    <option value="administrateur">Administrateur</option>
                                </select>
                            </div>

                            <!-- Champs principaux (cachés initialement) -->
                            <div id="mainFields" style="display: none;">
                                <!-- Nom et Prénom -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required>
                                </div>

                                <!-- Téléphone -->
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="06 12 34 56 78" required>
                                </div>

                                <!-- Sexe -->
                                <div class="mb-3">
                                    <label class="form-label">Sexe <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="masculin" value="M" required>
                                            <label class="form-check-label" for="masculin">Masculin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="feminin" value="F" required>
                                            <label class="form-check-label" for="feminin">Féminin</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Champs spécifiques aux parents -->
                                <div id="parentFields" style="display: none;">
                                    <hr>
                                    <h6 class="text-muted mb-3">Informations personnelles du parent</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="profession" class="form-label">Profession</label>
                                            <input type="text" class="form-control" id="profession" name="profession" placeholder="Votre profession">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="adresse" class="form-label">Adresse</label>
                                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Votre adresse">
                                        </div>
                                    </div>

                                    <h6 class="text-muted mb-3 mt-4">Informations de l'élève</h6>
                                    <div class="mb-3">
                                        <label for="codeEleve" class="form-label">Code élève <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="codeEleve" name="codeEleve" placeholder="Code d'identification de l'élève">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nomEleve" class="form-label">Nom de l'élève <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nomEleve" name="nomEleve" placeholder="Nom de l'élève">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="prenomEleve" class="form-label">Prénom de l'élève <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="prenomEleve" name="prenomEleve" placeholder="Prénom de l'élève">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="emailEleve" class="form-label">Email de l'élève</label>
                                            <input type="email" class="form-control" id="emailEleve" name="emailEleve" placeholder="email@eleve.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="telephoneEleve" class="form-label">Téléphone de l'élève</label>
                                            <input type="tel" class="form-control" id="telephoneEleve" name="telephoneEleve" placeholder="06 12 34 56 78">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="dateNaissanceEleve" class="form-label">Date de naissance de l'élève <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="dateNaissanceEleve" name="dateNaissanceEleve">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Sexe de l'élève <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-4 mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexeEleve" id="masculinEleve" value="M">
                                                    <label class="form-check-label" for="masculinEleve">Masculin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexeEleve" id="femininEleve" value="F">
                                                    <label class="form-check-label" for="femininEleve">Féminin</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="nationaliteEleve" class="form-label">Nationalité de l'élève <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nationaliteEleve" name="nationaliteEleve" placeholder="Nationalité">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="adresseEleve" class="form-label">Adresse de l'élève</label>
                                            <input type="text" class="form-control" id="adresseEleve" name="adresseEleve" placeholder="Adresse de l'élève">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="classeEleve" class="form-label">Classe de l'élève <span class="text-danger">*</span></label>
                                            <select class="form-select" id="classeEleve" name="classeEleve">
                                                <option value="">Sélectionnez la classe</option>
                                                <option value="6e">6ème</option>
                                                <option value="5e">5ème</option>
                                                <option value="4e">4ème</option>
                                                <option value="3e">3ème</option>
                                                <option value="2nde">2nde</option>
                                                <option value="1ere">1ère</option>
                                                <option value="terminale">Terminale</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="anneeScolaire" class="form-label">Année scolaire</label>
                                            <input type="text" class="form-control" id="anneeScolaire" name="anneeScolaire" placeholder="2024-2025">
                                        </div>
                                    </div>
                                </div>

                                <!-- Champs spécifiques aux enseignants -->
                                <div id="enseignantFields" style="display: none;">
                                    <hr>
                                    <h6 class="text-muted mb-3">Informations professionnelles</h6>
                                    <div class="mb-3">
                                        <label for="dateNaissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="dateNaissance" name="dateNaissance">
                                    </div>
                                    <div class="mb-3">
                                        <label for="matiere" class="form-label">Matière enseignée <span class="text-danger">*</span></label>
                                        <select class="form-select" id="matiere" name="matiere">
                                            <option value="">Sélectionnez votre matière</option>
                                            <option value="mathematiques">Mathématiques</option>
                                            <option value="francais">Français</option>
                                            <option value="anglais">Anglais</option>
                                            <option value="histoire-geo">Histoire-Géographie</option>
                                            <option value="sciences">Sciences</option>
                                            <option value="eps">EPS</option>
                                            <option value="arts">Arts plastiques</option>
                                            <option value="musique">Musique</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="specialite" class="form-label">Spécialité/Diplôme</label>
                                        <input type="text" class="form-control" id="specialite" name="specialite" placeholder="Ex: CAPES Mathématiques, Master en Sciences...">
                                    </div>
                                </div>

                                <!-- Champs spécifiques aux administrateurs -->
                                <div id="administrateurFields" style="display: none;">
                                    <hr>
                                    <h6 class="text-muted mb-3">Informations administratives</h6>
                                    <div class="mb-3">
                                        <label for="poste" class="form-label">Poste <span class="text-danger">*</span></label>
                                        <select class="form-select" id="poste" name="poste">
                                            <option value="">Sélectionnez votre poste</option>
                                            <option value="directeur">Directeur/Directrice</option>
                                            <option value="adjoint">Directeur adjoint</option>
                                            <option value="cpe">CPE</option>
                                            <option value="secretaire">Secrétaire</option>
                                            <option value="comptable">Comptable</option>
                                            <option value="surveillant">Surveillant</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="departement" class="form-label">Département/Service</label>
                                        <input type="text" class="form-control" id="departement" name="departement" placeholder="Ex: Administration, Vie scolaire...">
                                    </div>
                                </div>

                                <!-- Mot de passe -->
                                <div class="mb-3">
                                    <label for="motDePasse" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="motDePasse" name="motDePasse" placeholder="Minimum 6 caractères" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Confirmer mot de passe -->
                                <div class="mb-3">
                                    <label for="confirmerMotDePasse" class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmerMotDePasse" name="confirmerMotDePasse" placeholder="Confirmez votre mot de passe" required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    Créer mon compte
                                </button>

                                <div class="text-center">
                                    <span class="text-muted">Vous avez déjà un compte ? </span>
                                    <a href="login.html" class="text-decoration-none">Se connecter</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

<script>
    // Script JavaScript pour le formulaire d'inscription

document.addEventListener('DOMContentLoaded', function() {
    // Éléments du DOM
    const typeSelect = document.getElementById('type');
    const mainFields = document.getElementById('mainFields');
    const parentFields = document.getElementById('parentFields');
    const enseignantFields = document.getElementById('enseignantFields');
    const administrateurFields = document.getElementById('administrateurFields');
    const form = document.getElementById('registerForm');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const toggleConfirmPasswordBtn = document.getElementById('toggleConfirmPassword');
    const passwordInput = document.getElementById('motDePasse');
    const confirmPasswordInput = document.getElementById('confirmerMotDePasse');

    // Gestion du changement de type d'utilisateur
    typeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        
        // Masquer tous les champs spécifiques
        parentFields.style.display = 'none';
        enseignantFields.style.display = 'none';
        administrateurFields.style.display = 'none';
        
        if (selectedType) {
            // Afficher les champs principaux
            mainFields.style.display = 'block';
            
            // Afficher les champs spécifiques selon le type
            switch(selectedType) {
                case 'parent':
                    parentFields.style.display = 'block';
                    setRequiredFields(['codeEleve', 'nomEleve', 'prenomEleve', 'dateNaissanceEleve', 'sexeEleve', 'nationaliteEleve', 'classeEleve']);
                    break;
                case 'enseignant':
                    enseignantFields.style.display = 'block';
                    setRequiredFields(['dateNaissance', 'matiere']);
                    break;
                case 'administrateur':
                    administrateurFields.style.display = 'block';
                    setRequiredFields(['poste']);
                    break;
            }
        } else {
            mainFields.style.display = 'none';
        }
    });

    // Fonction pour définir les champs obligatoires
    function setRequiredFields(fieldNames) {
        // Réinitialiser tous les champs spécifiques comme non obligatoires
        const allSpecificFields = [
            'codeEleve', 'nomEleve', 'prenomEleve', 'dateNaissanceEleve', 'sexeEleve', 'nationaliteEleve', 'classeEleve',
            'dateNaissance', 'matiere',
            'poste'
        ];
        
        allSpecificFields.forEach(fieldName => {
            const field = document.getElementById(fieldName) || document.querySelector(`input[name="${fieldName}"]`);
            if (field) {
                field.removeAttribute('required');
            }
        });
        
        // Définir les champs spécifiés comme obligatoires
        fieldNames.forEach(fieldName => {
            const field = document.getElementById(fieldName) || document.querySelector(`input[name="${fieldName}"]`);
            if (field) {
                field.setAttribute('required', 'required');
            }
        });
    }

    // Gestion de l'affichage/masquage du mot de passe
    togglePasswordBtn.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPasswordBtn.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    // Validation du formulaire
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitForm();
        }
    });

    // Fonction de validation
    function validateForm() {
        const formData = new FormData(form);
        const errors = [];

        // Validation des champs obligatoires de base
        const requiredBaseFields = ['nom', 'prenom', 'email', 'telephone', 'sexe', 'type', 'motDePasse', 'confirmerMotDePasse'];
        
        requiredBaseFields.forEach(field => {
            if (!formData.get(field)) {
                errors.push(`Le champ ${getFieldLabel(field)} est obligatoire`);
            }
        });

        // Validation spécifique selon le type
        const userType = formData.get('type');
        
        if (userType === 'parent') {
            const requiredParentFields = ['codeEleve', 'nomEleve', 'prenomEleve', 'dateNaissanceEleve', 'sexeEleve', 'nationaliteEleve', 'classeEleve'];
            requiredParentFields.forEach(field => {
                if (!formData.get(field)) {
                    errors.push(`Le champ ${getFieldLabel(field)} est obligatoire pour les parents`);
                }
            });
        } else if (userType === 'enseignant') {
            const requiredTeacherFields = ['dateNaissance', 'matiere'];
            requiredTeacherFields.forEach(field => {
                if (!formData.get(field)) {
                    errors.push(`Le champ ${getFieldLabel(field)} est obligatoire pour les enseignants`);
                }
            });
        } else if (userType === 'administrateur') {
            if (!formData.get('poste')) {
                errors.push('Le champ Poste est obligatoire pour les administrateurs');
            }
        }

        // Validation de l'email
        const email = formData.get('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            errors.push('Veuillez saisir une adresse email valide');
        }

        // Validation du téléphone
        const telephone = formData.get('telephone');
        const phoneRegex = /^(\+33|0)[1-9](\d{8})$/;
        if (telephone && !phoneRegex.test(telephone.replace(/\s/g, ''))) {
            errors.push('Veuillez saisir un numéro de téléphone valide');
        }

        // Validation du mot de passe
        const password = formData.get('motDePasse');
        const confirmPassword = formData.get('confirmerMotDePasse');
        
        if (password.length < 6) {
            errors.push('Le mot de passe doit contenir au moins 6 caractères');
        }
        
        if (password !== confirmPassword) {
            errors.push('Les mots de passe ne correspondent pas');
        }

        // Affichage des erreurs
        if (errors.length > 0) {
            showMessage(errors.join('<br>'), 'danger');
            return false;
        }

        return true;
    }

    // Fonction pour obtenir le libellé d'un champ
    function getFieldLabel(fieldName) {
        const labels = {
            'nom': 'Nom',
            'prenom': 'Prénom',
            'email': 'Email',
            'telephone': 'Téléphone',
            'sexe': 'Sexe',
            'type': 'Type d\'utilisateur',
            'motDePasse': 'Mot de passe',
            'confirmerMotDePasse': 'Confirmation du mot de passe',
            'codeEleve': 'Code élève',
            'nomEleve': 'Nom de l\'élève',
            'prenomEleve': 'Prénom de l\'élève',
            'dateNaissanceEleve': 'Date de naissance de l\'élève',
            'sexeEleve': 'Sexe de l\'élève',
            'nationaliteEleve': 'Nationalité de l\'élève',
            'classeEleve': 'Classe de l\'élève',
            'dateNaissance': 'Date de naissance',
            'matiere': 'Matière enseignée',
            'poste': 'Poste'
        };
        return labels[fieldName] || fieldName;
    }

    // Fonction pour soumettre le formulaire
    function submitForm() {
        const submitBtn = form.querySelector('button[type="submit"]');
        
        // Désactiver le bouton et ajouter l'animation de chargement
        submitBtn.disabled = true;
        submitBtn.classList.add('btn-loading');
        submitBtn.textContent = 'Création en cours...';

        // Simuler l'envoi (remplacer par un vrai appel AJAX si nécessaire)
        setTimeout(() => {
            // Réactiver le bouton
            submitBtn.disabled = false;
            submitBtn.classList.remove('btn-loading');
            submitBtn.textContent = 'Créer mon compte';
            
            // Soumettre le formulaire pour de vrai
            form.submit();
        }, 1000);
    }

    // Fonction pour afficher les messages
    function showMessage(message, type = 'info') {
        const messagesContainer = document.getElementById('messages');
        const alertClass = `alert-${type}`;
        
        messagesContainer.innerHTML = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Faire défiler vers le haut pour voir le message
        messagesContainer.scrollIntoView({ behavior: 'smooth' });
    }

    // Validation en temps réel
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            // Supprimer les classes d'erreur lors de la saisie
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.remove();
            }
        });
    });

    // Fonction de validation d'un champ individuel
    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        let isValid = true;
        let errorMessage = '';

        // Validation selon le type de champ
        switch(fieldName) {
            case 'email':
            case 'emailEleve':
                if (value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    isValid = false;
                    errorMessage = 'Format d\'email invalide';
                }
                break;
                
            case 'telephone':
            case 'telephoneEleve':
                if (value && !/^(\+33|0)[1-9](\d{8})$/.test(value.replace(/\s/g, ''))) {
                    isValid = false;
                    errorMessage = 'Format de téléphone invalide';
                }
                break;
                
            case 'motDePasse':
                if (value && value.length < 6) {
                    isValid = false;
                    errorMessage = 'Au moins 6 caractères requis';
                }
                break;
                
            case 'confirmerMotDePasse':
                const password = document.getElementById('motDePasse').value;
                if (value && value !== password) {
                    isValid = false;
                    errorMessage = 'Les mots de passe ne correspondent pas';
                }
                break;
        }

        // Appliquer les styles de validation
        if (isValid) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
            
            // Ajouter le message d'erreur
            let feedback = field.parentNode.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                field.parentNode.appendChild(feedback);
            }
            feedback.textContent = errorMessage;
        }
    }

    // Animation au chargement
    setTimeout(() => {
        document.querySelector('.card').style.opacity = '1';
        document.querySelector('.card').style.transform = 'translateY(0)';
    }, 100);
});

// Fonction utilitaire pour formater les numéros de téléphone
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 0) {
        value = value.match(/.{1,2}/g).join(' ');
        if (value.length > 14) {
            value = value.substring(0, 14);
        }
    }
    input.value = value;
}

// Appliquer le formatage automatique aux champs téléphone
document.addEventListener('DOMContentLoaded', function() {
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function() {
            formatPhoneNumber(this);
        });
    });
});
</script>