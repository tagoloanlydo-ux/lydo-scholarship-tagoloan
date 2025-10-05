<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LYDO Scholarship - Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('css/scholar.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('/images/LYDO.png') }}">
  </head>
  <body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- HEADER -->
    <header class="banner-grad flex items-center px-6 text-white shadow-md">
       <img src="/images/LYDO.png" alt="LYDO Logo" class="h-10 mr-4"/>
      <div>
        <h1 class="text-3xl font-extrabold">LYDO SCHOLARSHIP</h1>
        <p class="text-sm tracking-widest">
          PARA SA KABATAAN, PARA SA KINABUKASAN.
        </p>
      </div>
    </header>

    <!-- MAIN REGISTRATION SECTION -->
    <main class="flex flex-1 flex-col md:flex-row items-center justify-center px-6 py-10 gap-12 flex-nowrap">
      <!-- LEFT SIDE -->
      <div class="flex flex-col items-center text-center md:text-left md:items-start max-w-lg min-w-0 md:min-w-[400px]">
        <h2 class="text-5xl font-extrabold mb-4 text-purple-700 leading-tight">
          Join Our Scholar Community!
        </h2>
        <p class="text-xl leading-relaxed text-gray-700 mb-4">
          Create your account to access scholarship opportunities, track your applications, and connect with fellow scholars.
        </p>
      </div>

      <!-- RIGHT SIDE (REGISTRATION FORM) -->
      <div class="w-full max-w-sm space-y-6">
     
        <form method="POST" action="{{ route('scholar.register') }}" id="registerForm" novalidate>
          @csrf
          <input type="hidden" name="scholar_id" value="{{ $scholar->scholar_id }}">

          <div>
            <label for="scholar_username" class="block text-lg font-medium text-gray-700">Username</label>
            <input id="scholar_username" name="scholar_username" type="text" value="{{ old('scholar_username') }}" required class="mt-2 w-full bg-white rounded-lg px-4 py-3 text-gray-700 shadow-sm text-lg border @error('scholar_username') border-red-500 @enderror" placeholder="Enter your username"/>
            @error('scholar_username')
              <p class="text-red-600 text-sm mt-1">{{ $message == 'Invalid username.' ? "username doesn't exist" : $message }}</p>
            @enderror
          </div>

          <div class="relative">
            <label for="scholar_pass" class="block text-lg font-medium text-gray-700">Password</label>
            <input id="scholar_pass"name="scholar_pass" type="password" required class="mt-2 w-full bg-white rounded-lg px-4 pr-10 py-3 text-gray-700 shadow-sm text-lg border @error('scholar_pass') border-red-500 @enderror" placeholder="Enter your password"/>
            <button type="button" class="absolute right-3  text-gray-500 hover:text-gray-700" style="margin-top:25px;" onclick="togglePasswordVisibility()" aria-label="Toggle password visibility">
              <i data-feather="eye" id="scholar-pass-eye-icon" class="w-5 h-5"></i>
            </button>
            @error('scholar_pass')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="relative">
            <label for="confirm_password" class="block text-lg font-medium text-gray-700">Confirm Password</label>
            <input id="confirm_password" name="confirm_password" type="password" required class="mt-2 w-full bg-white rounded-lg px-4 pr-10 py-3 text-gray-700 shadow-sm text-lg border @error('confirm_password') border-red-500 @enderror" placeholder="Confirm your password"/>
            <button type="button" class="absolute right-3  text-gray-500 hover:text-gray-700" style="margin-top:25px;" onclick="toggleConfirmPasswordVisibility()" aria-label="Toggle password visibility">
              <i data-feather="eye" id="confirm-pass-eye-icon" class="w-5 h-5"></i>
            </button>
            @error('confirm_password')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit" id="registerBtn" class="w-full bg-purple-600 text-white font-bold py-3 rounded-lg hover:bg-purple-700 transition shadow-md text-lg mt-4 flex justify-center items-center">
            <span id="btnText">Create Account</span>
            <svg id="btnSpinner" class="hidden animate-spin h-5 w-5 ml-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
              <circle class="opacity-25" cx="12" cy="12"r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
          </button>
        </form>
        <div class="flex justify-center">
        <button class="text-purple-600 hover:underline mb-4" type="button" onclick="window.location.href='{{ route('scholar.login') }}'">← Back to Login </button>
      </div>
    </div>
 </main>
    <!-- FOOTER -->
    <footer class="text-center py-4 text-sm text-gray-500">
      © 2025 LYDO Scholarship. All rights reserved.
    </footer>

    <script>
      function togglePasswordVisibility() {
        const passwordInput = document.getElementById('scholar_pass');
        const eyeIcon = document.getElementById('scholar-pass-eye-icon');

        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.setAttribute('data-feather', 'eye-off');
        } else {
          passwordInput.type = 'password';
          eyeIcon.setAttribute('data-feather', 'eye');
        }

        // Re-render the icon
        feather.replace();
      }

      function toggleConfirmPasswordVisibility() {
        const confirmPasswordInput = document.getElementById('confirm_password');
        const eyeIcon = document.getElementById('confirm-pass-eye-icon');

        if (confirmPasswordInput.type === 'password') {
          confirmPasswordInput.type = 'text';
          eyeIcon.setAttribute('data-feather', 'eye-off');
        } else {
          confirmPasswordInput.type = 'password';
          eyeIcon.setAttribute('data-feather', 'eye');
        }

        // Re-render the icon
        feather.replace();
      }

      // Example SweetAlert usage
      function showSuccessAlert() {
        Swal.fire({
          title: 'Success!',
          text: 'Operation completed successfully',
          icon: 'success',
          confirmButtonText: 'OK'
        });
      }

      function showConfirmationAlert() {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            );
          }
        });
      }

      // Spinner functionality
      const registerForm = document.querySelector("form");
      const registerBtn = document.getElementById("registerBtn");
      const btnText = document.getElementById("btnText");
      const btnSpinner = document.getElementById("btnSpinner");

      registerForm.addEventListener("submit", function () {
        // Disable button habang naglo-load
        registerBtn.disabled = true;
        registerBtn.classList.add("opacity-70", "cursor-not-allowed");

        // Palitan ang text at ipakita ang spinner
        btnText.textContent = "Creating account...";
        btnSpinner.classList.remove("hidden");
      });

      // SweetAlert for session messages
      @if(session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '{{ session('success') }}',
          timer: 3000,
          showConfirmButton: false
        });
      @endif

      @if($errors->any())
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first() }}',
            timer: 4000,
            showConfirmButton: false
          });
        </script>
      @endif
    </script>
<script>
  // Initialize Feather icons
  document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
  });
</script>
<script>
const registerForm = document.getElementById("registerForm");
const usernameInput = document.getElementById("scholar_username");
const passwordInput = document.getElementById("scholar_pass");
const confirmPasswordInput = document.getElementById("confirm_password");

// Password rules regex
const passwordRules = {
  minLength: 8,
  uppercase: /[A-Z]/,
  lowercase: /[a-z]/,
  number: /[0-9]/,
  symbol: /[!@#$%^&*(),.?":{}|<>]/
};

// Show inline error
function showInlineError(input, message) {
  let errorEl = input.nextElementSibling;
  if (!errorEl || !errorEl.classList.contains("inline-error")) {
    errorEl = document.createElement("p");
    errorEl.classList.add("text-red-600", "text-sm", "mt-1", "inline-error");
    input.parentNode.appendChild(errorEl);
  }
  errorEl.textContent = message;
  input.classList.add("border-red-500");
}

// Clear inline error
function clearInlineError(input) {
  const errorEl = input.parentElement.querySelector(".inline-error");
  if (errorEl) errorEl.textContent = "";
  input.classList.remove("border-red-500");
}

// Check username uniqueness
function checkUsername() {
  const username = usernameInput.value.trim();
  if (!username) {
    clearInlineError(usernameInput);
    return;
  }
  fetch('/check-scholar-username', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ username: username })
  })
  .then(response => response.json())
  .then(data => {
    if (data.exists) {
      showInlineError(usernameInput, 'Username is already taken.');
    } else {
      clearInlineError(usernameInput);
    }
  })
  .catch(error => {
    console.error('Error checking username:', error);
  });
}

// Validate password
function validatePassword() {
  const value = passwordInput.value.trim();
  if (value.length < passwordRules.minLength) {
    showInlineError(passwordInput, `Password must be at least ${passwordRules.minLength} characters`);
    return false;
  }
  if (!passwordRules.uppercase.test(value)) {
    showInlineError(passwordInput, "Password must contain at least one uppercase letter");
    return false;
  }
  if (!passwordRules.lowercase.test(value)) {
    showInlineError(passwordInput, "Password must contain at least one lowercase letter");
    return false;
  }
  if (!passwordRules.number.test(value)) {
    showInlineError(passwordInput, "Password must contain at least one number");
    return false;
  }
  if (!passwordRules.symbol.test(value)) {
    showInlineError(passwordInput, "Password must contain at least one symbol (!@#$...)");
    return false;
  }
  clearInlineError(passwordInput);
  return true;
}

// Validate confirm password
function validateConfirmPassword() {
  const value = confirmPasswordInput.value.trim();
  if (value !== passwordInput.value.trim()) {
    showInlineError(confirmPasswordInput, "Passwords do not match");
    return false;
  }
  clearInlineError(confirmPasswordInput);
  return true;
}

// Attach events
usernameInput.addEventListener("blur", checkUsername);
passwordInput.addEventListener("blur", validatePassword);
passwordInput.addEventListener("input", validatePassword);
confirmPasswordInput.addEventListener("blur", validateConfirmPassword);
confirmPasswordInput.addEventListener("input", validateConfirmPassword);

// Final validation before submit
registerForm.addEventListener("submit", function(e) {
  const isPasswordValid = validatePassword();
  const isConfirmValid = validateConfirmPassword();
  if (!isPasswordValid || !isConfirmValid) {
    e.preventDefault(); // Stop submission if invalid
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please fix the password errors before submitting'
    });
  }
});
</script>

  </body>
</html>
