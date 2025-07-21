<!-- Login Form -->
<div class="login-container rounded-3xl p-8 shadow-2xl slide-in">
    <form id="depotForm" action="<?=URI_HOST?>depot" method="post" class="space-y-6">
        
        <!-- Form Title -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Effectuer un Dépôt</h2>
            <p class="text-gray-600">Rechargez votre compte facilement</p>
        </div>

        <!-- Error Messages -->
        <?php if(isset($errors) && !empty($errors)): ?>
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Erreur(s) détectée(s) :</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <?php if(is_array($errors)): ?>
                            <ul class="list-disc list-inside space-y-1">
                                <?php foreach($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p><?= htmlspecialchars($errors) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Success Messages -->
        <?php if(isset($success) && !empty($success)): ?>
        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        <?= htmlspecialchars($success) ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Amount Field -->
        <div class="relative">
            <label for="tarif" class="block text-sm font-medium text-gray-700 mb-2">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Montant (FCFA)
                </span>
            </label>
            <input 
                id="tarif"
                name="tarif" 
                type="text" 
                placeholder="Ex: 10 000" 
                value="<?= isset($_POST['tarif']) ? htmlspecialchars($_POST['tarif']) : '' ?>"
                class="w-full px-4 py-3 pl-12 border <?= isset($errors) && array_key_exists('tarif', $errors) ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-orange-500 focus:border-transparent' ?> rounded-lg focus:ring-2 transition-all duration-200"
                required
            >
            <?php if(isset($errors) && array_key_exists('tarif', $errors)): ?>
                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['tarif']) ?></p>
            <?php endif; ?>
            <div class="absolute inset-y-0 left-3 top-8 flex items-center pointer-events-none">
                <span class="text-gray-500 text-sm">₣</span>
            </div>
        </div>

        <!-- Phone Number Field -->
        <div class="relative">
            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Numéro de téléphone
                </span>
            </label>
            <input 
                id="telephone"
                name="telephone" 
                type="tel" 
                placeholder="7X XXX XX XX" 
                value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>"
                class="w-full px-4 py-3 border <?= isset($errors) && array_key_exists('telephone', $errors) ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-orange-500 focus:border-transparent' ?> rounded-lg focus:ring-2 transition-all duration-200"
                required
            >
            <?php if(isset($errors) && array_key_exists('telephone', $errors)): ?>
                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['telephone']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Quick Amount Buttons -->
        <div class="grid grid-cols-3 gap-3 my-4">
            <button 
                type="button" 
                onclick="setAmount('5000')" 
                class="py-2 px-4 bg-gray-100 hover:bg-orange-100 text-gray-700 hover:text-orange-600 rounded-lg transition-all duration-200 text-sm font-medium"
            >
                5 000 ₣
            </button>
            <button 
                type="button" 
                onclick="setAmount('10000')" 
                class="py-2 px-4 bg-gray-100 hover:bg-orange-100 text-gray-700 hover:text-orange-600 rounded-lg transition-all duration-200 text-sm font-medium"
            >
                10 000 ₣
            </button>
            <button 
                type="button" 
                onclick="setAmount('25000')" 
                class="py-2 px-4 bg-gray-100 hover:bg-orange-100 text-gray-700 hover:text-orange-600 rounded-lg transition-all duration-200 text-sm font-medium"
            >
                25 000 ₣
            </button>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-3 px-4 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
        >
            <span id="depotText">Confirmer le Dépôt</span>
            <svg id="depotSpinner" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>

        <!-- Info Message -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Les dépôts sont traités instantanément. Assurez-vous que votre numéro est correct.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Set amount from quick buttons
    function setAmount(amount) {
        document.getElementById('tarif').value = formatAmount(amount);
    }

    // Format amount with spaces
    function formatAmount(amount) {
        return amount.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    }

    // Format amount input
    document.getElementById('tarif').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value) {
            e.target.value = formatAmount(value);
        }
    });

    // Form submission
    document.getElementById('depotForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const depotButton = this.querySelector('button[type="submit"]');
        const depotText = document.getElementById('depotText');
        const depotSpinner = document.getElementById('depotSpinner');
        
        // Show loading state
        depotButton.disabled = true;
        depotText.textContent = 'Traitement...';
        depotSpinner.classList.remove('hidden');
        
        // Submit the form (remove this timeout and uncomment the line below for real submission)
        setTimeout(() => {
            this.submit(); // Uncomment this line for real form submission
        }, 1000);
        
        // For demo purposes only (remove this in production)
        /*
        setTimeout(() => {
            alert('Dépôt effectué avec succès !');
            
            // Reset form
            this.reset();
            
            // Reset button state
            depotButton.disabled = false;
            depotText.textContent = 'Confirmer le Dépôt';
            depotSpinner.classList.add('hidden');
        }, 2000);
        */
    });
</script>