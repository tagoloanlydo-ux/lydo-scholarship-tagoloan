# Realtime Updates for Lydo Staff Blades

## Overview

Implement AJAX polling to make tables in Lydo Staff views update realtime when new applicants are added. Polling every 10 seconds to fetch new data and prepend to tables/lists.

## Steps

1. Add new AJAX method in LydoStaffController to fetch latest applicants since a given ID.
2. Update dashboard.blade.php: Add JS to poll for new applicants, update counts, prepend to list.
3. Update screening.blade.php: Add JS to poll and prepend new rows to table.
4. Update renewal.blade.php: Add JS to poll and prepend new rows to table.
5. Update disbursement.blade.php: Add JS to poll and prepend new rows to table.
6. Test the implementation by running the app and adding a new applicant.

## Files to Edit

-   app/Http/Controllers/LydoStaffController.php: Add getLatestApplicants method.
-   routes/web.php: Add route for the AJAX endpoint.
-   resources/views/lydo_staff/dashboard.blade.php: Add polling JS.
-   resources/views/lydo_staff/screening.blade.php: Add polling JS.
-   resources/views/lydo_staff/renewal.blade.php: Add polling JS.
-   resources/views/lydo_staff/disbursement.blade.php: Add polling JS.
