function validateForm() {

  const submitButton = document.getElementById('submitButton');

  // Honeypot check
  const honeypot = document.getElementById('website');
  if (honeypot && honeypot.value) {
      console.log('Bot submission detected');
      return false; // Silently fail for bots
  }
  
  // Rate limiting check
  const lastSubmissionTime = localStorage.getItem('lastFormSubmission');
  const currentTime = Date.now();
  const cooldownPeriod = 60000; // 60 seconds
  
  if (lastSubmissionTime && (currentTime - lastSubmissionTime) < cooldownPeriod) {
      const remainingTime = Math.ceil((cooldownPeriod - (currentTime - lastSubmissionTime)) / 1000);
      alert(`Please wait ${remainingTime} seconds before submitting again.`);
      return false;
  }
    
  // Set loading state
  function setLoading(isLoading) {
      if (isLoading) {
          submitButton.classList.add('loading');
          submitButton.disabled = true;
      } else {
          submitButton.classList.remove('loading');
          submitButton.disabled = false;
      }
  }


  // Get form elements
  const name = document.getElementById('name');
  const email = document.getElementById('email');
  const message = document.getElementById('message');
  
  // Get error elements
  const nameError = document.getElementById('nameError');
  const emailError = document.getElementById('emailError');
  const messageError = document.getElementById('messageError');
  
  // Reset all error messages
  nameError.style.display = 'none';
  emailError.style.display = 'none';
  messageError.style.display = 'none';
  
  let isValid = true;
  
  // Name validation (at least two words, letters only)
  const nameRegex = /^[A-Za-z]+ [A-Za-z]+$/;
  if (!nameRegex.test(name.value.trim())) {
      nameError.style.display = 'block';
      name.focus();
      isValid = false;
  }
  
  // Email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email.value.trim())) {
      emailError.style.display = 'block';
      if (isValid) email.focus();
      isValid = false;
  }
  
  // Message validation (not empty and at least 10 characters)
  if (message.value.trim().length < 10) {
      messageError.style.display = 'block';
      if (isValid) message.focus();
      isValid = false;
  }
  
 

    if (isValid) {
      setLoading(true);
      
      // Simulate form submission delay (replace with actual form submission)
      setTimeout(() => {
          alert('Thank you for your message! We will get back to you soon.');
          
          // Clear the form
          name.value = '';
          email.value = '';
          message.value = '';
          
          // Remove loading state
          setLoading(false);
      }, 1500); // Simulated 1.5 second delay
  }

  

  // Optional: Real-time validation as user types
  function setupRealTimeValidation() {
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const message = document.getElementById('message');
    
    name.addEventListener('input', function() {
        const nameError = document.getElementById('nameError');
        const nameRegex = /^[A-Za-z]+ [A-Za-z]+$/;
        nameError.style.display = nameRegex.test(this.value.trim()) ? 'none' : 'block';
    });
    
    email.addEventListener('input', function() {
        const emailError = document.getElementById('emailError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        emailError.style.display = emailRegex.test(this.value.trim()) ? 'none' : 'block';
    });
    
    message.addEventListener('input', function() {
        const messageError = document.getElementById('messageError');
        messageError.style.display = this.value.trim().length >= 10 ? 'none' : 'block';
    });
  }
}


// Back to Top functionality
document.addEventListener('DOMContentLoaded', function() {
  const backToTop = document.getElementById('back-to-top');
  
  // Show button when user scrolls down 800px
  window.addEventListener('scroll', function() {
      if (window.pageYOffset > 800) {
          backToTop.classList.add('show');
      } else {
          backToTop.classList.remove('show');
      }
  });
  
  // Smooth scroll to top when clicked
  backToTop.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({
          top: 0,
          behavior: 'smooth'
      });
  });
});

// Call setup function when page loads
document.addEventListener('DOMContentLoaded', setupRealTimeValidation);