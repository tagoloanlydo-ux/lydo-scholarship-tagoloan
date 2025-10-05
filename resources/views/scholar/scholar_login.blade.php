<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LYDO Scholarship - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/scholar.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('/images/LYDO.png') }}">
  </head>
  <body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- HEADER -->
    <script>
  @if (session('success'))
    Swal.fire({
      title: 'Success!',
      text: "{{ session('success') }}",
      icon: 'success',
      confirmButtonText: 'OK'
    });
  @endif

  @if (session('error'))
    Swal.fire({
      title: 'Error!',
      text: "{{ session('error') }}",
      icon: 'error',
      confirmButtonText: 'Try Again'
    });
  @endif

  @if ($errors->any() && ($errors->has('error') || $errors->count() > 1 || (!$errors->has('scholar_username') && !$errors->has('scholar_pass'))))
    Swal.fire({
      title: 'Validation Error',
      html: "{!! implode('<br>', $errors->all()) !!}",
      icon: 'warning',
      confirmButtonText: 'OK'
    });
  @endif
</script>

    <header class="banner-grad flex items-center px-6 text-white shadow-md">
      <img src="{{ asset('images/lydo.png') }}" alt="LYDO Logo" class="h-10 mr-4" />
        <div>
          <h1 class="text-3xl font-extrabold">LYDO SCHOLARSHIP</h1>
          <p class="text-sm tracking-widest">
            PARA SA KABATAAN, PARA SA KINABUKASAN.
          </p>
        </div>
    </header>

    <!-- MAIN LOGIN SECTION -->
    <main
      class="flex flex-1 flex-col md:flex-row items-center justify-center px-6 py-10 gap-12 flex-nowrap">
      <!-- LEFT SIDE -->
      <div class="flex flex-col items-center text-center md:text-left md:items-start max-w-lg min-w-0 md:min-w-[400px]">
        <!-- Centered GIF with transparent background -->

        <h2 class="text-5xl font-extrabold mb-4 text-purple-700 leading-tight">
          Welcome Back, Scholars!
        </h2>
        <p class="text-xl leading-relaxed text-gray-700 mb-4">
          Access your scholarship dashboard, track your application, and explore
          new opportunities for your future.
        </p>
          <button onclick="window.location='{{ route('home') }}'" class="flex items-center gap-2 text-purple-600 hover:text-purple-800 font-semibold mt-4">
              <i class="fa-solid fa-arrow-left"></i> ← Back to Portal
          </button>
      </div>

      <!-- RIGHT SIDE (LOGIN FORM) -->
      <div class="w-full max-w-sm space-y-6">
        <form method="POST" action="{{ route('scholar.login.submit') }}" novalidate>
          @csrf
          <div>
            <label for="scholar_username" class="block text-lg font-medium text-gray-700">Username</label>
            <input id="scholar_username" name="scholar_username" type="text" value="{{ old('scholar_username') }}" required autofocus class="mt-2 w-full bg-white rounded-lg px-4 py-3 text-gray-700 shadow-sm text-lg border @error('scholar_username') border-red-500 @enderror" placeholder="Enter your username"/>
            @error('scholar_username')
              <p class="text-red-600 text-sm mt-1">{{ $message == 'Invalid username.' ? "username doesn't exist" : $message }}</p>
            @enderror
          </div>

          <div class="relative">
            <label for="scholar_pass" class="block text-lg font-medium text-gray-700">Password</label>
            <input id="scholar_pass" name="scholar_pass" type="password" required class="mt-2 w-full bg-white rounded-lg px-4 py-3 text-gray-700 shadow-sm text-lg border @error('scholar_pass') border-red-500 @enderror" placeholder="Enter your password"/>
            <span class="absolute right-3 top-11 text-gray-500 toggle-password" onclick="togglePasswordVisibility()" title="Show/Hide Password" >
              👁️
            </span>
            @error('scholar_pass')
              <p class="text-red-600 text-sm mt-1">{{ $message == 'Incorrect password.' ? 'incorrect password' : $message }}</p>
            @enderror
          </div>
          <a href="{{ route('scholar.forgot-password') }}" class="text-sm text-purple-600 hover:underline mt-3 block text-right">
            Forgot Password?
          </a>
          <button type="submit" id="loginBtn" class="w-full bg-purple-600 text-white font-bold py-3 rounded-lg hover:bg-purple-700 transition shadow-md text-lg mt-4 flex justify-center items-center">
            <span id="btnText">Log In</span>
             <svg id="btnSpinner" class="hidden animate-spin h-5 w-5 ml-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
              <circle class="opacity-25" cx="12" cy="12"r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
          </button>
        </form>
        <div class="flex items-center my-6">
          <div class="flex-grow border-t border-gray-300"></div>
          <span class="mx-4 text-gray-500 font-semibold">OR</span>
          <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <div class="flex gap-4 mt-2">
          @php
            $settings = \App\Models\Settings::first();
            $currentDate = now()->toDateString();
            $applicationDisabled = false;
            $applicationMessage = '';

            if ($settings && $settings->application_start_date && $settings->application_deadline) {
              $startDate = $settings->application_start_date->toDateString();
              $deadline = $settings->application_deadline->toDateString();

              if ($currentDate < $startDate) {
                $applicationDisabled = true;
                $applicationMessage = 'Application period starts on ' . $settings->application_start_date->format('M d, Y');
              } elseif ($currentDate > $deadline) {
                $applicationDisabled = true;
                $applicationMessage = 'Application period has ended on ' . $settings->application_deadline->format('M d, Y');
              }
            } elseif ($settings && (!$settings->application_start_date || !$settings->application_deadline)) {
              $applicationDisabled = true;
              $applicationMessage = 'Application period not yet set by administrator';
            }
          @endphp

          @if($applicationDisabled)
            <div class="flex-1">
              <button disabled class="w-full bg-gray-300 border border-gray-400 text-gray-500 font-bold py-3 rounded-lg cursor-not-allowed text-lg" title="{{ $applicationMessage }}">
                Apply as Scholar
              </button>
              <p class="text-sm text-gray-500 mt-1 text-center">{{ $applicationMessage }}</p>
            </div>
          @else
            <a href="{{ route('applicants.registration') }}" class="flex-1">
              <button class="w-full bg-transparent border border-purple-600 text-purple-600 font-bold py-3 rounded-lg hover:bg-purple-50 transition text-lg">
                Apply as Scholar
              </button>
            </a>
          @endif

          <a href="{{ route('scholar.announcements') }}" class="flex-1">
            <button class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition text-lg">
              View Announcement
            </button>
          </a>
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

      // You can call these functions from buttons or other events
      // Example: <button onclick="showSuccessAlert()">Show Success</button>
    </script>
    <script>
      const loginForm = document.querySelector("form");
      const loginBtn = document.getElementById("loginBtn");
      const btnText = document.getElementById("btnText");
      const btnSpinner = document.getElementById("btnSpinner");

      loginForm.addEventListener("submit", function () {
        // Disable button habang naglo-load
        loginBtn.disabled = true;
        loginBtn.classList.add("opacity-70", "cursor-not-allowed");

        // Palitan ang text at ipakita ang spinner
        btnText.textContent = "Logging in...";
        btnSpinner.classList.remove("hidden");
      });
    </script>
    
  </body>
</html>
