<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoleSpace - Connexion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --gradient-start: #3b82f6;
            --gradient-end: #8b5cf6;
            --bg-overlay: rgba(59, 130, 246, 0.8);
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .hero-section {
           background : linear-gradient(135deg, rgba(61, 4, 203, 0.3) 0%, rgba(234, 18, 205, 0.3) 100%),
                url(../../images/image_accueil.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }
   content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 40% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 30%);
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

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .hero-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 0.5rem 0;
            font-size: 1rem;
            opacity: 0.9;
        }

        .feature-list li::before {
            content: '•';
            margin-right: 0.5rem;
            font-weight: bold;
        }

        .login-section {
            background: #f8fafc;
            min-height: 100vh;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .mobile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .mobile-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            padding: 12px 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-select {
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            padding: 12px 16px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #6b7280;
            cursor: pointer;
        }

        .demo-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .btn-demo {
            padding: 8px 12px;
            font-size: 0.875rem;
            border-radius: 6px;
            border: 2px solid #e5e7eb;
            background: white;
            transition: all 0.3s;
        }

        .btn-demo:hover {
            border-color: var(--primary-color);
            background: #f0f9ff;
        }

        .separator {
            margin: 1.5rem 0;
            position: relative;
        }

        .separator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .separator-text {
            background: white;
            padding: 0 1rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        @media (max-width: 991.98px) {
            .hero-section {
                display: none !important;
            }
            
            .login-section {
                min-height: 100vh;
                display: flex;
                align-items: center;
            }
        }

        @media (max-width: 767.98px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .demo-buttons {
                grid-template-columns: 1fr;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <!-- Hero Section - Left Side -->
            <div class="col-lg-6 hero-section d-none d-lg-flex align-items-center justify-content-center">
                <div class="hero-content text-center p-5">
                    <div class="hero-icon">
                        <i class="fas fa-graduation-cap fa-2x text-white"></i>
                    </div>
                    <h1 class="hero-title">EcoleSpace</h1>
                    <p class="hero-subtitle">
                        La plateforme de communication entre l'école et les familles
                    </p>
                    <ul class="feature-list">
                        <li>Suivi en temps réel des notes et absences</li>
                        <li>Communication directe avec les enseignants</li>
                        <li>Gestion simplifiée des paiements scolaires</li>
                    </ul>
                </div>
            </div>

            <!-- Login Form - Right Side -->
            <div class="col-lg-6 login-section d-flex align-items-center justify-content-center p-4">
                <div class="w-100" style="max-width: 480px;">
                    <!-- Mobile Header -->
                    <div class="mobile-header d-lg-none">
                        <div class="mobile-icon">
                            <i class="fas fa-graduation-cap fa-lg text-white"></i>
                        </div>
                        <h1 class="h3 mb-1">EcoleSpace</h1>
                        <p class="text-muted">Plateforme éducative</p>
                    </div>

                    <!-- Login Card -->
                    <div class="card login-card">
                        <div class="card-header text-center bg-white border-0 pt-4">
                            <h2 class="h4 mb-2">Connexion</h2>
                            <p class="text-muted mb-0">Connectez-vous à votre espace personnel</p>
                        </div>
                        <div class="card-body p-4">
                            <form id="loginForm">
                                <!-- Type de compte -->
                                <div class="mb-3">
                                    <label for="accountType" class="form-label fw-medium">Type de compte</label>
                                    <select class="form-select" id="accountType" required>
                                        <option value="parent">Parent d'élève</option>
                                        <option value="teacher">Enseignant</option>
                                        <option value="admin">Administration</option>
                                    </select>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-medium">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="votre@email.com" required>
                                </div>

                                <!-- Mot de passe -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-medium">Mot de passe</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                                        <button type="button" class="password-toggle" id="togglePassword">
                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary-custom w-100 mb-3">
                                    Se connecter
                                </button>
                            </form>

                            <!-- Forgot Password -->
                            <div class="text-center mb-3">
                                <a href="#" class="text-decoration-none">Mot de passe oublié ?</a>
                            </div>

                            <!-- Separator -->
                            <div class="separator text-center">
                                <span class="separator-text">Accès démo :</span>
                            </div>

                            <!-- Demo Buttons -->
                            <div class="demo-buttons">
                                <button type="button" class="btn btn-demo" onclick="demoLogin('parent', 'Marie Dupont')">
                                    Parent
                                </button>
                                <button type="button" class="btn btn-demo" onclick="demoLogin('teacher', 'Jean Martin')">
                                    Enseignant
                                </button>
                                <button type="button" class="btn btn-demo" onclick="demoLogin('admin', 'Sophie Admin')">
                                    Admin
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">
                            Pas de compte ? 
                            <a href="#" class="text-decoration-none">S'inscrire</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        });

        // Handle form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const accountType = document.getElementById('accountType').value;
            
            // Simple validation
            if (!email || !password) {
                alert('Veuillez remplir tous les champs');
                return;
            }
            
            // Simulate login
            const userName = email.split('@')[0] || 'Utilisateur';
            const formattedName = userName.charAt(0).toUpperCase() + userName.slice(1);
            
            handleLogin(accountType, formattedName);
        });

        // Demo login function
        function demoLogin(role, userName) {
            handleLogin(role, userName);
        }

        // Handle successful login
        function handleLogin(role, userName) {
            // Store user data (in a real app, this would be handled server-side)
            sessionStorage.setItem('userRole', role);
            sessionStorage.setItem('userName', userName);
            
            // Show success message
            alert(`Connexion réussie !\nBienvenue ${userName}\nRôle: ${role}`);
            
            // In a real application, you would redirect to the appropriate dashboard
            console.log('Redirecting to dashboard for:', { role, userName });
            
            // Example redirect logic (uncomment and modify as needed):
            // switch(role) {
            //     case 'parent':
            //         window.location.href = '/dashboard/parent.html';
            //         break;
            //     case 'teacher':
            //         window.location.href = '/dashboard/teacher.html';
            //         break;
            //     case 'admin':
            //         window.location.href = '/dashboard/admin.html';
            //         break;
            // }
        }

        // Form validation styling
        document.querySelectorAll('.form-control, .form-select').forEach(input => {
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