# TODO: Add Date and Deadline Settings for Scholar Applications

## Migration

-   [x] Edit database/migrations/2025_09_20_031429_create_tbl_settings_table.php to add date columns: application_start_date, application_deadline, renewal_start_date, renewal_deadline
-   [x] Create database/migrations/2025_09_27_012237_add_deadline_columns_to_tbl_settings_table.php to add columns to existing table

## Model

-   [x] Create app/Models/Settings.php with fillable fields for the date columns

## Controller

-   [x] Update LydoAdminController::settings() to fetch/create Settings instance and pass to view
-   [x] Add LydoAdminController::updateDeadlines() method for AJAX form submission with validation

## Routes

-   [x] Add PUT route for /lydo_admin/update-deadlines in routes/web.php

## Views

-   [x] Modify resources/views/lydo_admin/settings.blade.php: Replace password form with deadlines form, update navigation buttons, add JavaScript for deadlines form submission
-   [x] Modify resources/views/scholar/scholar_login.blade.php: Add date check to conditionally show/disable "Apply as Scholar" button
-   [x] Modify resources/views/scholar/renewal_app.blade.php: Add date check to conditionally show/disable "Apply for Renewal" button

## Testing

-   [x] Run migration: php artisan migrate
-   [ ] Test setting dates in admin settings
-   [ ] Test button enable/disable in scholar views
-   [ ] Test form submissions within/outside date ranges

# TODO: Add Change Password Functionality for Lydo Admin Settings

## Controller

-   [x] Add LydoAdminController::updatePassword() method for AJAX form submission with validation

## Routes

-   [x] Add PUT route for /lydo_admin/update-password in routes/web.php

## Views

-   [x] Modify resources/views/lydo_admin/settings.blade.php: Add change password form, update navigation buttons, add JavaScript for change password form submission

## Testing

-   [ ] Test change password functionality
-   [ ] Test validation (current password check, new password confirmation)
-   [ ] Test AJAX form submission and SweetAlert notifications
