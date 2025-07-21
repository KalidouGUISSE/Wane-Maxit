<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXITSA - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%);
        }
        .login-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .slide-in {
            animation: slideIn 0.8s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen gradient-bg overflow-hidden">

    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white bg-opacity-10 rounded-full floating-animation"></div>
        <div class="absolute top-1/3 right-20 w-96 h-96 bg-white bg-opacity-5 rounded-full floating-animation" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-white bg-opacity-10 rounded-full floating-animation" style="animation-delay: -4s;"></div>
    </div>
    <!-- Main Container -->
    <div class="relative min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Logo Section -->
            <div class="text-center mb-8 slide-in">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 pulse-animation">
                    <span class="text-3xl">📱</span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">MAXITSA</h1>
                <p class="text-white text-opacity-90">Votre solution de paiement mobile</p>
            </div>

        <!-- Main Form -->
            <?php
                echo $containteForLayoute;
            ?>
</div>
</div>
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }

        // Form submission
        // document.getElementById('loginForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     const loginButton = this.querySelector('button[type="submit"]');
        //     const loginText = document.getElementById('loginText');
        //     const loginSpinner = document.getElementById('loginSpinner');
            
        //     // Show loading state
        //     loginButton.disabled = true;
        //     loginText.textContent = 'Connexion...';
        //     loginSpinner.classList.remove('hidden');
            
        //     // Simulate API call
        //     setTimeout(() => {
        //         // For demo, just show success message
        //         alert('Connexion réussie !');
                
        //         // Reset button state
        //         loginButton.disabled = false;
        //         loginText.textContent = 'Se connecter';
        //         loginSpinner.classList.add('hidden');
                
        //         // In real app, redirect to dashboard
        //         // window.location.href = '/dashboard';
        //     }, 2000);
        // });

        // Phone number formatting
        document.getElementById('telephone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            

            
            // Format the number
            if (value.length >= 3) {
                value = value.replace(/^(\d{3})(\d{2})(\d{3})(\d{2})(\d{2})$/, '+$1 $2 $3 $4 $5');
            }
            
            e.target.value = value;
        });

        // Add floating label effect
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>