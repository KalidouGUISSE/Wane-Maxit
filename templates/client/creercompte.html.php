<?php 
session_start();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}   
?>

<div class="bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Créer un Compte</h1>
    <form id="signupForm" action="<?=$_ENV['URI_HOST']?>creer" method="POST" enctype="multipart/form-data" class="space-y-6">
        
        <!-- Phone and ID Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Numéro de Téléphone <span class="text-red-500">*</span>
                </label>
                <input 
                    type="tel" 
                    name="telephone"    
                    placeholder="Enter your phone number"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-colors"
                    
                />
                <?php if (!empty($errors['telephone'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['telephone'][0]) ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Numero de Carte d'Identité <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="nci"
                    placeholder="Enter your ID card number"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-colors"
                    
                />
                <?php if (!empty($errors['nci'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['nci'][0]) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Upload Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Télécharger les Photos <span class="text-red-500">*</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Upload Front Photo -->
                <div class="upload-container">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Upload front photo
                    </label>
                    <div class="upload-area bg-gray-50 rounded-lg p-8 text-center cursor-pointer border-2 border-dashed border-gray-300 hover:border-orange-400 transition-colors" onclick="document.getElementById('frontPhoto').click()">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Upload a clear photo of the front of your ID card.</p>
                        <button type="button" class="bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            Upload
                        </button>
                        <input type="file" name="photo_recto" id="frontPhoto" accept="image/*" class="hidden" onchange="handleFileUpload(this, 'front')" />
                        <?php if (!empty($errors['photo_recto'])): ?>
                            <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['photo_recto'][0]) ?></p>
                        <?php endif; ?>
                    </div>
                    <div id="frontPreview" class="mt-4 hidden">
                        <img id="frontImage" class="w-full h-48 object-cover rounded-lg border"/>
                        <p class="text-sm text-green-600 mt-2">✓ Photo téléchargée avec succès</p>
                    </div>
                </div>

                <!-- Upload Back Photo -->
                <div class="upload-container">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Upload back photo
                    </label>
                    <div class="upload-area bg-gray-50 rounded-lg p-8 text-center cursor-pointer border-2 border-dashed border-gray-300 hover:border-orange-400 transition-colors" onclick="document.getElementById('backPhoto').click()">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Upload a clear photo of the back of your ID card.</p>
                        <button type="button" class="bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            Upload
                        </button>
                        <input type="file" name="photo_verso" id="backPhoto" accept="image/*" class="hidden" onchange="handleFileUpload(this, 'back')" />
                        <?php if (!empty($errors['photo_verso'])): ?>
                            <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['photo_verso'][0]) ?></p>
                        <?php endif; ?>
                    </div>
                    <div id="backPreview" class="mt-4 hidden">
                        <img id="backImage" class="w-full h-48 object-cover rounded-lg border"/>
                        <p class="text-sm text-green-600 mt-2">✓ Photo téléchargée avec succès</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nom <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="nom"
                    placeholder="Enter votre nom"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-colors"
                    
                />
                <?php if (!empty($errors['nom'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['nom'][0]) ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Prénom <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="prenom"
                    placeholder="Enter your surname"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-colors"
                    
                />
                <?php if (!empty($errors['prenom'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['prenom'][0]) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Address -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Address <span class="text-red-500">*</span>
            </label>
            <textarea 
                placeholder="Enter your address"
                name="adresse"
                rows="3"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-colors"
                
            ></textarea>
            <?php if (!empty($errors['adresse'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['adresse'][0]) ?></p>
            <?php endif; ?>
        </div>

        <!-- Password Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Mot de Passe <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password"
                        id="password"
                        placeholder="Créer un mot de passe"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-colors pr-12"
                        minlength="8"
                    />
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                        <svg id="eye-password" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <!-- <div class="mt-2">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-xs text-gray-500">Force du mot de passe</span>
                        <span id="strength-text" class="text-xs text-gray-500">Faible</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1">
                        <div id="strength-bar" class="password-strength bg-gray-300"></div>
                    </div>
                </div> -->
                <!-- <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères</p> -->
                <?php if (!empty($errors['password'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['password'][0]) ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmer le Mot de Passe <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Confirmez votre mot de passe"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-colors pr-12"
                        
                    />
                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                        <svg id="eye-password_confirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <div id="password-match" class="mt-2 text-sm hidden">
                    <p class="text-red-600">Les mots de passe ne correspondent pas</p>
                </div>
                <?php if (!empty($errors['password_confirmation'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['password_confirmation'][0]) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6">
            <button 
                type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 px-6 rounded-lg transition duration-200 text-lg disabled:opacity-50 disabled:cursor-not-allowed"
                id="submitBtn"
            >
                Create Account
            </button>
        </div>
    </form>
</div>

<script>
// Handle file upload preview
function handleFileUpload(input, type) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(type + 'Preview');
            const image = document.getElementById(type + 'Image');
            image.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eye = document.getElementById('eye-' + fieldId);
    
    if (field.type === 'password') {
        field.type = 'text';
        eye.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        `;
    } else {
        field.type = 'password';
        eye.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
}

// Password strength checker
function checkPasswordStrength(password) {
    let strength = 0;
    let text = 'Faible';
    let className = 'strength-weak';

    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;

    switch (strength) {
        case 0:
        case 1:
            text = 'Faible';
            className = 'strength-weak';
            break;
        case 2:
            text = 'Moyen';
            className = 'strength-medium';
            break;
        case 3:
            text = 'Bon';
            className = 'strength-good';
            break;
        case 4:
        case 5:
            text = 'Fort';
            className = 'strength-strong';
            break;
    }

    return { strength, text, className };
}

// Password validation
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const result = checkPasswordStrength(password);
    
    document.getElementById('strength-text').textContent = result.text;
    document.getElementById('strength-bar').className = `password-strength ${result.className}`;
    
    checkPasswordMatch();
});

document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmation = document.getElementById('password_confirmation').value;
    const matchDiv = document.getElementById('password-match');
    
    if (confirmation && password !== confirmation) {
        matchDiv.classList.remove('hidden');
    } else {
        matchDiv.classList.add('hidden');
    }
}

// Form validation
// document.getElementById('signupForm').addEventListener('submit', function(e) {
//     const password = document.getElementById('password').value;
//     const confirmation = document.getElementById('password_confirmation').value;
    
//     if (password !== confirmation) {
//         e.preventDefault();
//         alert('Les mots de passe ne correspondent pas');
//         return false;
//     }
    
//     if (password.length < 8) {
//         e.preventDefault();
//         alert('Le mot de passe doit contenir au moins 8 caractères');
//         return false;
//     }
// });
</script>