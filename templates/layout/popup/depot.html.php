                    <form action="<?=URI_HOST?>depot" method="post">
                    
                        <div class="space-y-4">
                            <div>
                                <label if="tarif" class="block text-sm font-medium text-gray-700 mb-2">Montant</label>
                                <input name="tarif" type="text" placeholder="Entrez le montant" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <div>
                                <label id="telephone" class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                                <input name="telephone" type="tel" placeholder="Entrez votre numéro" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                Confirmer le dépôt
                            </button>
                        </div>
                    </form>