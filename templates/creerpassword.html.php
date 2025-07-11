<form action="<?=$_ENV['URI_HOST']?>motdepasse" method="post">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
            <input type="text" placeholder="Entrez le montant" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer</label>
            <input type="tel" placeholder="Entrez votre numéro" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
        </div>
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-colors">
            Creer Mot de passe
        </button>
    </div>
</form>