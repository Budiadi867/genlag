// Main JavaScript for URL Generator
document.addEventListener('DOMContentLoaded', function() {
    // Copy URL functionality
    const copyBtn = document.getElementById('copyBtn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const generatedUrl = document.getElementById('generatedUrl');
            if (generatedUrl) {
                navigator.clipboard.writeText(generatedUrl.value)
                    .then(() => {
                        // Show success message
                        const copyMessage = document.getElementById('copyMessage');
                        copyMessage.textContent = 'URL berhasil disalin!';
                        copyMessage.style.display = 'block';
                        
                        // Hide message after 3 seconds
                        setTimeout(() => {
                            copyMessage.style.display = 'none';
                        }, 3000);
                    })
                    .catch(err => {
                        console.error('Gagal menyalin URL: ', err);
                    });
            }
        });
    }

    // Form validation
    const urlForm = document.getElementById('urlGeneratorForm');
    if (urlForm) {
        urlForm.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value;
            const description = document.getElementById('description').value;
            const imageUrl = document.getElementById('imageUrl').value;
            const finalUrl = document.getElementById('finalUrl').value;
            
            let isValid = true;
            
            // Simple validation
            if (!finalUrl) {
                isValid = false;
                showError('finalUrl', 'URL tujuan tidak boleh kosong');
            } else if (!isValidUrl(finalUrl)) {
                isValid = false;
                showError('finalUrl', 'URL tujuan tidak valid');
            }
            
            if (!imageUrl) {
                isValid = false;
                showError('imageUrl', 'URL gambar tidak boleh kosong');
            } else if (!isValidUrl(imageUrl)) {
                isValid = false;
                showError('imageUrl', 'URL gambar tidak valid');
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
    
    // Helper functions
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        errorElement.style.color = 'red';
        errorElement.style.fontSize = '0.8rem';
        errorElement.style.marginTop = '0.25rem';
        
        // Remove any existing error messages
        const existingError = field.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        
        field.parentNode.appendChild(errorElement);
        field.style.borderColor = 'red';
        
        // Remove error on input
        field.addEventListener('input', function() {
            const error = field.parentNode.querySelector('.error-message');
            if (error) {
                error.remove();
                field.style.borderColor = '';
            }
        }, { once: true });
    }
    
    function isValidUrl(url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    }
});
