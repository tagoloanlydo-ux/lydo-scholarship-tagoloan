<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LYDO Scholarship - Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/scholar.css') }}" /> 
    <link rel="icon" type="image/x-icon" href="/img/LYDO.png">
  </head>
  <body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- HEADER -->
    <header class="banner-grad flex items-center px-6 text-white shadow-md">
    <img src="{{ asset('images/LYDO.png') }}" alt="Logo" class="h-15 w-auto rounded-lg mr-5">
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
            <input id="scholar_pass"name="scholar_pass" type="password" required class="mt-2 w-full bg-white rounded-lg px-4 py-3 text-gray-700 shadow-sm text-lg border @error('scholar_pass') border-red-500 @enderror" placeholder="Enter your password"/>
            <span class="absolute right-3 top-11 text-gray-500 toggle-password" onclick="togglePasswordVisibility()" title="Show/Hide Password">
              👁️
            </span>
            @error('scholar_pass')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="relative">
            <label for="confirm_password" class="block text-lg font-medium text-gray-700">Confirm Password</label>
            <input id="confirm_password" name="confirm_password" type="password" required class="mt-2 w-full bg-white rounded-lg px-4 py-3 text-gray-700 shadow-sm text-lg border @error('confirm_password') border-red-500 @enderror" placeholder="Confirm your password"/>
            <span class="absolute right-3 top-11 text-gray-500 toggle-password" onclick="toggleConfirmPasswordVisibility()" title="Show/Hide Password" >
              👁️
            </span>
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
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
        } else {
          passwordInput.type = 'password';
        }
      }

      function toggleConfirmPasswordVisibility() {
        const confirmPasswordInput = document.getElementById('confirm_password');
        if (confirmPasswordInput.type === 'password') {
          confirmPasswordInput.type = 'text';
        } else {
          confirmPasswordInput.type = 'password';
        }
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
  </body>
</html>
