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
                    <a href="#" class="text-white hover:text-orange-100 transition-colors">Déconnexion</a>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Depot Card -->
            <div class="card-hover bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 text-white cursor-pointer" onclick="openModal('depot')">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold">Dépôt</h3>
                        </div>
                        <p class="text-gray-300 text-sm">Alimenter votre compte</p>
                    </div>
                </div>
            </div>

            <!-- Paiement Card -->
            <div class="card-hover bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 text-white cursor-pointer" onclick="openModal('paiement')">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold">Paiement</h3>
                        </div>
                        <p class="text-gray-300 text-sm">Effectuer un paiement</p>
                    </div>
                    <div class="text-right">
                        <div class="w-4 h-4 bg-purple-500 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Retrait Card -->
            <div class="card-hover bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 text-white cursor-pointer" onclick="openModal('retrait')">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold">Retrait</h3>
                        </div>
                        <p class="text-gray-300 text-sm">Retirer de l'argent</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-orange-50 to-orange-100 border-b border-orange-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Historique des transactions</h2>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        Voir plus
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12-12-2025</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Retrait</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">(302) 555-0107</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">20 000frc</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

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
        function openModal(type) {
            const modal = document.getElementById('modal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            
            let title = '';
            let content = '';
            
            switch(type) {
                case 'depot':
                    title = 'Effectuer un Dépôt';
                    content = `
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Montant</label>
                                <input type="number" placeholder="Entrez le montant" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                                <input type="tel" placeholder="Entrez votre numéro" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                Confirmer le dépôt
                            </button>
                        </div>
                    `;
                    break;
                case 'paiement':
                    title = 'Effectuer un Paiement';
                    content = `
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Destinataire</label>
                                <input type="text" placeholder="Numéro ou nom du destinataire" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Montant</label>
                                <input type="number" placeholder="Entrez le montant" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Motif (optionnel)</label>
                                <input type="text" placeholder="Motif du paiement" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                Envoyer le paiement
                            </button>
                        </div>
                    `;
                    break;
                case 'retrait':
                    title = 'Effectuer un Retrait';
                    content = `
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Montant à retirer</label>
                                <input type="number" placeholder="Entrez le montant" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Code PIN</label>
                                <input type="password" placeholder="Entrez votre code PIN" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <p class="text-sm text-yellow-800">Le retrait sera traité dans les 24h ouvrées</p>
                            </div>
                            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                Confirmer le retrait
                            </button>
                        </div>
                    `;
                    break;
            }
            
            modalTitle.textContent = title;
            modalContent.innerHTML = content;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
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
    </script>
</body>
</html>