<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXITSA - Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .table-row:hover {
            background-color: #fef3f2;
        }
        .error-shake {
            animation: shake 0.6s ease-in-out;
        }
        @keyframes shake {
            0%, 20%, 40%, 60%, 80%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-3px); }
        }
    </style>
</head>
<body class="bg-orange-50 min-h-screen">
    <!-- Header -->
    <header class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="text-2xl font-bold text-white">📱 MAXITSA</div>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex space-x-6">
                    <a href="#" class="text-white hover:text-orange-100 transition-colors">Ajouter un Compte</a>
                    <a href="#" class="text-white hover:text-orange-100 transition-colors">Changer Compte</a>
                    <a href="#" class="text-white hover:text-orange-100 transition-colors">Consulter Solde</a>
                    <a href="<?=URI_HOST?>deconnexion" class="text-white hover:text-orange-100 transition-colors">Déconnexion</a>
                </nav>
                
                <!-- User Profile -->
                <div class="flex items-center space-x-3">
                    <div class="bg-white bg-opacity-20 rounded-full p-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </header>

        <!-- Main Content -->
        <?php
            echo $containteForLayoute;
        ?>


    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-900"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="space-y-4">
                <!-- Dynamic content will be inserted here -->
            </div>
        </div>
    </div>

    <script>
        // Variables PHP injectées en JavaScript pour gérer les erreurs
        const formErrors = <?= json_encode($errors) ?>;
        const formData = <?= json_encode($formData) ?>;
        const formType = <?= json_encode($formType) ?>;

        // Fonction pour afficher les erreurs
        function displayError(fieldName, errorMessage) {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field) {
                field.classList.add('border-red-500', 'error-shake');
                field.classList.remove('border-gray-300');
                
                // Créer ou mettre à jour le message d'erreur
                let errorDiv = field.parentNode.querySelector('.error-message');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                    field.parentNode.appendChild(errorDiv);
                }
                errorDiv.textContent = errorMessage;
                
                // Retirer l'animation shake après un délai
                setTimeout(() => {
                    field.classList.remove('error-shake');
                }, 600);
            }
        }

        // Fonction pour effacer les erreurs
        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(error => error.remove());
            document.querySelectorAll('input').forEach(input => {
                input.classList.remove('border-red-500');
                input.classList.add('border-gray-300');
            });
        }

        function openModal(type) {
            const modal = document.getElementById('modal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            
            let title = '';
            let content = '';
            
            // Effacer les erreurs précédentes
            clearErrors();
            
            switch(type) {
                case 'depot':
                    title = 'Effectuer un Dépôt';
                    content = `
                        <form action="<?=URI_HOST?>depot" method="post" onsubmit="return validateForm('depot')">
                            <div class="space-y-4">
                                <div>
                                    <label for="tarif" class="block text-sm font-medium text-gray-700 mb-2">Montant</label>
                                    <input name="tarif" type="text" placeholder="Entrez le montant" value="${formData.tarif || ''}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                                    <input name="telephone" type="tel" placeholder="Entrez votre numéro" value="${formData.telephone || ''}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                    Confirmer le dépôt
                                </button>
                            </div>
                        </form>
                    `;
                    break;
                    
                case 'paiement':
                    title = 'Effectuer un Paiement';
                    content = `
                        <form action="<?=URI_HOST?>paiement" method="post" onsubmit="return validateForm('paiement')">
                            <div class="space-y-4">
                                <div>
                                    <label for="destinataire" class="block text-sm font-medium text-gray-700 mb-2">Destinataire</label>
                                    <input name="destinataire" type="text" placeholder="Numéro ou nom du destinataire" value="${formData.destinataire || ''}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="montant" class="block text-sm font-medium text-gray-700 mb-2">Montant</label>
                                    <input name="montant" type="number" placeholder="Entrez le montant" value="${formData.montant || ''}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="motif" class="block text-sm font-medium text-gray-700 mb-2">Motif (optionnel)</label>
                                    <input name="motif" type="text" placeholder="Motif du paiement" value="${formData.motif || ''}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                    Envoyer le paiement
                                </button>
                            </div>
                        </form>
                    `;
                    break;
                    
                case 'retrait':
                    title = 'Effectuer un Retrait';
                    content = `
                        <form action="<?=URI_HOST?>retrait" method="post" onsubmit="return validateForm('retrait')">
                            <div class="space-y-4">
                                <div>
                                    <label for="montant_retrait" class="block text-sm font-medium text-gray-700 mb-2">Montant à retirer</label>
                                    <input name="montant_retrait" type="number" placeholder="Entrez le montant" value="${formData.montant_retrait || ''}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="code_pin" class="block text-sm font-medium text-gray-700 mb-2">Code PIN</label>
                                    <input name="code_pin" type="password" placeholder="Entrez votre code PIN" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                    <p class="text-sm text-yellow-800">Le retrait sera traité dans les 24h ouvrées</p>
                                </div>
                                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                    Confirmer le retrait
                                </button>
                            </div>
                        </form>
                    `;
                    break;
            }
            
            modalTitle.textContent = title;
            modalContent.innerHTML = content;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Afficher les erreurs si elles existent et correspondent au type de formulaire
            setTimeout(() => {
                if (formErrors && Object.keys(formErrors).length > 0 && formType === type) {
                    Object.keys(formErrors).forEach(fieldName => {
                        displayError(fieldName, formErrors[fieldName]);
                    });
                }
            }, 100);
        }
        
        // Validation côté client
        function validateForm(type) {
            clearErrors();
            let isValid = true;
            
            if (type === 'depot') {
                const tarif = document.querySelector('[name="tarif"]').value;
                const telephone = document.querySelector('[name="telephone"]').value;
                
                if (!tarif || tarif <= 0) {
                    displayError('tarif', 'Le montant doit être supérieur à 0');
                    isValid = false;
                }
                if (!telephone || telephone.length < 9) {
                    displayError('telephone', 'Le numéro de téléphone est invalide');
                    isValid = false;
                }
            } else if (type === 'paiement') {
                const destinataire = document.querySelector('[name="destinataire"]').value;
                const montant = document.querySelector('[name="montant"]').value;
                
                if (!destinataire.trim()) {
                    displayError('destinataire', 'Le destinataire est requis');
                    isValid = false;
                }
                if (!montant || montant <= 0) {
                    displayError('montant', 'Le montant doit être supérieur à 0');
                    isValid = false;
                }
            } else if (type === 'retrait') {
                const montantRetrait = document.querySelector('[name="montant_retrait"]').value;
                const codePin = document.querySelector('[name="code_pin"]').value;
                
                if (!montantRetrait || montantRetrait <= 0) {
                    displayError('montant_retrait', 'Le montant doit être supérieur à 0');
                    isValid = false;
                }
                if (!codePin || codePin.length < 4) {
                    displayError('code_pin', 'Le code PIN doit contenir au moins 4 caractères');
                    isValid = false;
                }
            }
            
            return isValid;
        }
        
        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        
        // Close modal when clicking outside
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Auto-ouvrir le modal si il y a des erreurs
        document.addEventListener('DOMContentLoaded', function() {
            if (formType && formErrors && Object.keys(formErrors).length > 0) {
                openModal(formType);
            }
        });
    </script>
</body>
</html>