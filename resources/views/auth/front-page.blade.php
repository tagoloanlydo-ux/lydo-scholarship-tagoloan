<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LYDO Scholarship Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/front-page.css') }}" />
  </head>
  <body
    class="h-screen w-screen flex flex-col items-center justify-between bg-gradient-to-b from-[#2a1e78] via-[#6a4fd4] to-[#7a58f7] text-white overflow-hidden">
    <!-- Transition Overlay -->
    <div id="overlay" class="transition-overlay">
      <h1 class="text-3xl font-bold text-white">LYDO Scholarship Management</h1>
    </div>


    <!-- Hero Section -->
    <div class="flex flex-col items-center mt-16">
      <img src="/images/LYDO.png" alt="LYDO Logo" class="h-10 mr-4"/>
      <h1 class="text-3xl font-bold text-center fade-in-up fade-delay-1 opacity-0">
        LYDO Scholarship Portal
      </h1>
      <p
        class="mt-3 text-lg text-gray-200 text-center max-w-md fade-in-up fade-delay-2 opacity-0">
        Welcome scholars! 🎓 Your journey to success starts here. Together,
        let’s empower education and build brighter futures.
      </p>
    </div>

    <!-- Buttons -->
    <div
      class="flex flex-col gap-4 w-10/12 max-w-sm fade-in-up fade-delay-3 opacity-0">
      <button
        class="flex items-center justify-center gap-2 bg-blue-800 hover:bg-indigo-500 py-3 rounded-xl shadow text-white font-medium transition" onclick="window.location='{{ route('scholar.login') }}'">
        <i class="fa-solid fa-right-to-bracket"></i> Log In Scholar</button>

      <button class="flex items-center justify-center gap-2 bg-green-800 hover:bg-indigo-500 py-3 rounded-xl shadow text-white font-medium transition" onclick="window.location='{{ route('login') }}'">
        <i class="fa-solid fa-right-to-bracket"></i> Log In Lydo Personnel
      </button>
    </div>

    <!-- Footer -->
    <div
      class="mb-6 text-sm text-gray-200 text-center fade-in-up fade-delay-3 opacity-0">
      © 2025 LYDO Scholar <br /> <span class="text-gray-300">Empowering education</span>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>

    <!-- Overlay Script -->
    <script>
      window.addEventListener("load", () => {
        const overlay = document.getElementById("overlay");
        setTimeout(() => {
          overlay.classList.add("fade-out");
          setTimeout(() => overlay.remove(), 1000); // remove overlay after transition
        }, 1000); // show overlay for 1s before fade-out
      });
    </script>
  </body>
</html>
