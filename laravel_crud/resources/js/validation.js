/**
 * Real-time form validation with visual feedback - Portuguese
 */

document.addEventListener('DOMContentLoaded', function() {
  // Validate datetime-local fields to ensure future dates
  const datetimeInputs = document.querySelectorAll('input[data-validation="datetime-future"]');
  
  datetimeInputs.forEach(input => {
    const inputId = input.id;
    const errorElement = document.getElementById(`${inputId}-error`);
    
    // Set minimum datetime to now
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    const minDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
    input.setAttribute('min', minDatetime);
    
    // Real-time validation on input
    input.addEventListener('change', function() {
      validateDatetimeFuture(this, errorElement);
    });
    
    input.addEventListener('blur', function() {
      validateDatetimeFuture(this, errorElement);
    });
    
    // Initial validation if value already exists
    if (input.value) {
      validateDatetimeFuture(input, errorElement);
    }
  });

  // Email validation for registration
  const emailInputs = document.querySelectorAll('input[type="email"]');
  emailInputs.forEach(input => {
    if (input.name !== 'email' || input.id === 'email') {
      input.addEventListener('blur', function() {
        validateEmail(this);
      });
    }
  });

  // Password validation for registration
  const passwordInputs = document.querySelectorAll('input[name="password"]');
  passwordInputs.forEach(input => {
    if (input.form && input.form.action.includes('register')) {
      input.addEventListener('blur', function() {
        validatePasswordStrength(this);
      });
    }
  });
});

/**
 * Validate that datetime is in the future
 */
function validateDatetimeFuture(input, errorElement) {
  if (!input.value) {
    hideError(input, errorElement);
    return;
  }
  
  const selectedDate = new Date(input.value);
  const now = new Date();
  
  if (selectedDate <= now) {
    showError(input, errorElement, 'Data e hora devem ser no futuro.');
    return false;
  }
  
  hideError(input, errorElement);
  return true;
}

/**
 * Validate email format
 */
function validateEmail(input) {
  const errorElement = document.getElementById(`${input.id}-error`);
  if (!errorElement) return;
  
  const email = input.value;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  if (!email) {
    hideError(input, errorElement);
    return true;
  }
  
  if (!emailRegex.test(email)) {
    showError(input, errorElement, 'E-mail inválido.');
    return false;
  }
  
  hideError(input, errorElement);
  return true;
}

/**
 * Validate password strength for registration
 */
function validatePasswordStrength(input) {
  const errorElement = document.getElementById(`${input.id}-error`);
  if (!errorElement) return;
  
  const password = input.value;
  const minLength = 8;
  
  if (!password) {
    hideError(input, errorElement);
    return true;
  }
  
  if (password.length < minLength) {
    showError(input, errorElement, `Mínimo de ${minLength} caracteres.`);
    return false;
  }
  
  hideError(input, errorElement);
  return true;
}

/**
 * Show validation error
 */
function showError(input, errorElement, message) {
  input.classList.add('is-invalid');
  input.classList.remove('is-valid');
  
  if (errorElement) {
    errorElement.textContent = message;
    errorElement.style.display = 'block';
  }
}

/**
 * Hide validation error
 */
function hideError(input, errorElement) {
  input.classList.remove('is-invalid');
  input.classList.add('is-valid');
  
  if (errorElement) {
    errorElement.style.display = 'none';
  }
}

export { validateDatetimeFuture, validateEmail, validatePasswordStrength };
