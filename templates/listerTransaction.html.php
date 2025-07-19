<?php
$session = \App\Core\App::getDependencie('core', 'session');
$solde_user = $session->get('user')['solde'] ?? [];
// var_dump($solde_user);die;
?>
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Depot Card href="<?=URI_HOST?>debutdepot" -->
            <div  class="card-hover bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 text-white cursor-pointer" onclick="openModal('depot')">
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
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900">
                    Historique des transactions
                </h2>
                
                <!-- Affichage du solde amélioré -->
                <div class="flex items-center gap-4">
                    <div class="bg-white/80 backdrop-blur-sm border border-green-200 px-4 py-2 rounded-xl shadow-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-medium text-gray-600 uppercase tracking-wide">Solde disponible</span>
                        </div>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="text-2xl font-bold text-green-700"><?= number_format($solde_user, 2, ',', ' ') ?></span>
                            <span class="text-sm font-semibold text-green-600">FCFA</span>
                        </div>
                    </div>
                    
                    <form action="<?=$_ENV['URI_HOST']?>listerTransaction" method="post">
                        <input name="voirPlus" style="display: none;">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                            Voir plus
                        </button>
                    </form>
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
                        <?php foreach ($transaction as $t): ?>
                            <tr class="table-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d-m-Y', strtotime($t['date'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                        $badgeColor = match(strtolower($t['type_transaction'])) {
                                            'retrait' => 'bg-red-100 text-red-800',
                                            'depot' => 'bg-green-100 text-green-800',
                                            'paiement' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?= $badgeColor ?>">
                                        <?= ucfirst($t['type_transaction']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= $t['numero_destinataire'] ?? 'N/A' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= number_format((float)$t['tarif'], 0, ',', ' ') ?> frc
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <!-- <div class="mt-4 flex justify-center space-x-2">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>" 
                        class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div> -->

            </div>
        </div>
    </main>

