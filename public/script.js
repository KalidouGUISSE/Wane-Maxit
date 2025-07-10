// Handle file upload and preview
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

// Handle drag and drop
document.querySelectorAll('.upload-area').forEach(area => {
    area.addEventListener('dragover', (e) => {
        e.preventDefault();
        area.classList.add('dragover');
    });

    area.addEventListener('dragleave', () => {
        area.classList.remove('dragover');
    });

    area.addEventListener('drop', (e) => {
        e.preventDefault();
        area.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const input = area.querySelector('input[type="file"]');
            input.files = files;
            
            const type = input.id.includes('front') ? 'front' : 'back';
            handleFileUpload(input, type);
        }
    });
});

// Form submission
document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Show loading state
    const button = this.querySelector('button[type="submit"]');
    const originalText = button.textContent;
    button.textContent = 'Création du compte...';
    button.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        alert('Compte créé avec succès !');
        button.textContent = originalText;
        button.disabled = false;
        
        // Reset form
        this.reset();
        document.querySelectorAll('[id$="Preview"]').forEach(preview => {
            preview.classList.add('hidden');
        });
    }, 2000);
});