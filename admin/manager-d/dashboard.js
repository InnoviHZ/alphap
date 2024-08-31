// Utility functions
function showPopup(popupId) {
  document.getElementById(popupId).style.display = 'block';
}

function closePopup(popupId) {
  document.getElementById(popupId).style.display = 'none';
}

function resetForm(formId) {
  document.getElementById(formId).reset();
}

// Manager Registration
document.getElementById('registerManagerBtn').addEventListener('click', function() {
  showPopup('registerManagerPopup');
});

document.getElementById('closeManagerPopup').addEventListener('click', function() {
  closePopup('registerManagerPopup');
  resetForm('managerForm');
});

// Admin Registration
document.getElementById('registerAdminBtn').addEventListener('click', function() {
  showPopup('registerAdminPopup');
});

document.getElementById('closeAdminPopup').addEventListener('click', function() {
  closePopup('registerAdminPopup');
  resetForm('adminForm');
});

// Form step navigation
function showStep(formId, stepNumber) {
  const form = document.getElementById(formId);
  const steps = form.getElementsByClassName('step-content');
  const indicators = form.getElementsByClassName('step');

  for (let i = 0; i < steps.length; i++) {
    steps[i].style.display = 'none';
    indicators[i].classList.remove('active');
  }

  steps[stepNumber - 1].style.display = 'block';
  indicators[stepNumber - 1].classList.add('active');

  const prevBtn = form.querySelector('#' + formId.replace('Form', 'PrevBtn'));
  const nextBtn = form.querySelector('#' + formId.replace('Form', 'NextBtn'));
  const submitBtn = form.querySelector('#' + formId.replace('Form', 'SubmitBtn'));

  prevBtn.style.display = stepNumber > 1 ? 'inline-block' : 'none';
  nextBtn.style.display = stepNumber < 3 ? 'inline-block' : 'none';
  submitBtn.style.display = stepNumber === 3 ? 'inline-block' : 'none';
}

// Manager form navigation
document.getElementById('managerNextBtn').addEventListener('click', function() {
  const currentStep = document.querySelector('#managerForm .step-content:not([style*="display: none"])');
  const currentStepNumber = Array.from(currentStep.parentNode.children).indexOf(currentStep) + 1;
  showStep('managerForm', currentStepNumber + 1);
});

document.getElementById('managerPrevBtn').addEventListener('click', function() {
  const currentStep = document.querySelector('#managerForm .step-content:not([style*="display: none"])');
  const currentStepNumber = Array.from(currentStep.parentNode.children).indexOf(currentStep) + 1;
  showStep('managerForm', currentStepNumber - 1);
});

// Admin form navigation
document.getElementById('adminNextBtn').addEventListener('click', function() {
  const currentStep = document.querySelector('#adminForm .step-content:not([style*="display: none"])');
  const currentStepNumber = Array.from(currentStep.parentNode.children).indexOf(currentStep) + 1;
  showStep('adminForm', currentStepNumber + 1);
});

document.getElementById('adminPrevBtn').addEventListener('click', function() {
  const currentStep = document.querySelector('#adminForm .step-content:not([style*="display: none"])');
  const currentStepNumber = Array.from(currentStep.parentNode.children).indexOf(currentStep) + 1;
  showStep('adminForm', currentStepNumber - 1);
});

// Form submission
function submitForm(formId, url) {
  const form = document.getElementById(formId);
  const formData = new FormData(form);

  fetch(url, {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Registration successful!');
      closePopup(formId.replace('Form', 'Popup'));
      resetForm(formId);
    } else {
      alert('Registration failed. Please try again.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
  });
}

document.getElementById('managerForm').addEventListener('submit', function(e) {
  e.preventDefault();
  submitForm('managerForm', 'register_manager.php');
});

document.getElementById('adminForm').addEventListener('submit', function(e) {
  e.preventDefault();
  submitForm('adminForm', 'register_admin.php');
});

// Table management
const tableDropdownItems = document.querySelectorAll('#tableDropdown .dropdown-item');
tableDropdownItems.forEach(item => {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    const tableType = this.getAttribute('data-table');
    loadTable(tableType);
  });
});

function loadTable(tableType) {
  // You'll need to implement this function to load the appropriate table data
  // This might involve an AJAX call to fetch the data and then updating the DOM
  console.log(`Loading ${tableType} table...`);
  // Example implementation:
  // fetch(`get_${tableType}_data.php`)
  //   .then(response => response.json())
  //   .then(data => {
  //     updateTableDOM(data);
  //   })
  //   .catch(error => console.error('Error:', error));
}

// Profile and Sign Out functionality
document.getElementById('profileBtn').addEventListener('click', function(e) {
  e.preventDefault();
  // Implement profile view/edit functionality
  console.log('Opening profile...');
});

document.getElementById('signOutBtn').addEventListener('click', function(e) {
  e.preventDefault();
  // Implement sign out functionality
  console.log('Signing out...');
  // Example implementation:
  // fetch('sign_out.php')
  //   .then(response => response.json())
  //   .then(data => {
  //     if (data.success) {
  //       window.location.href = 'login.php';
  //     }
  //   })
  //   .catch(error => console.error('Error:', error));
});

// Initialize the forms
showStep('managerForm', 1);
showStep('adminForm', 1);