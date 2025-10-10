# Realtime Updates for Lydo Staff and Mayor Staff Blades

## Overview

Implement Server-Sent Events (SSE) to make tables in Lydo Staff and Mayor Staff views update in realtime when new applicants are added. Replaced polling with SSE for better efficiency.

## Steps

1. Add SSE method in LydoStaffController to stream new applicants with initial_screening = 'Reviewed'.
2. Add SSE method in MayorStaffController to stream new applicants with initial_screening = 'Pending'.
3. Update dashboard.blade.php for both lydo_staff and mayor_staff: Replace polling JS with SSE to receive new applicants and prepend to list.
4. Test the implementation by running the app and adding a new applicant.

## Files Edited

-   app/Http/Controllers/LydoStaffController.php: Added sseApplicants method.
-   app/Http/Controllers/MayorStaffController.php: Modified sseApplicants method for initial_screening = 'Pending'.
-   routes/web.php: Added routes for /lydo_staff/sse-applicants and /mayor_staff/sse-applicants.
-   resources/views/lydo_staff/dashboard.blade.php: Replaced polling script with SSE script.
-   resources/views/mayor_staff/dashboard.blade.php: Added SSE script for realtime updates.

## Completed

-   [x] Implemented SSE for realtime applicant updates on lydo_staff dashboard.
-   [x] Implemented SSE for realtime applicant updates on mayor_staff dashboard.
-   [x] Added backend SSE endpoints for both controllers.
-   [x] Updated frontend to use SSE instead of polling for both dashboards.
