# TODO: Fix Renewal Rejection Reason Implementation

## Completed Tasks

-   [x] Create migration to add `rejection_reason` column to `tbl_renewal` table
-   [x] Update `updateRenewalStatus` method in `LydoStaffController.php` to save rejection reason when status is Rejected
-   [x] Run migration to apply database changes
-   [x] Update `updateDeadlines` method in `LydoAdminController.php` to handle `renewal_semester` field
-   [x] Add deadline check in `submitRenewal` method in `ScholarController.php`
-   [x] Update `renewal_app.blade.php` view to disable renewal button when outside deadline period
-   [x] Fix Validator facade import in `LydoAdminController.php`
-   [x] Disable timestamps in Settings model to match database table structure

## Summary

The issue was that the rejection reason was being sent in the email but not saved in the database. The fix involved:

1. Adding a nullable `rejection_reason` text column to the `tbl_renewal` table via migration.
2. Modifying the `updateRenewalStatus` method to save the reason in the database when rejecting a renewal.
3. The email template already includes the reason if provided, so no changes were needed there.

The rejection flow now properly saves the reason in the database and includes it in the email sent to the scholar.

## Additional Task Completed

Updated the `updateDeadlines` method in `LydoAdminController.php` to properly handle the `renewal_semester` field:

1. Added validation for `renewal_semester` as a nullable string with allowed values: '1st Semester', '2nd Semester', 'Summer'
2. Added `renewal_semester` to the `fill()` method to ensure it gets saved to the database
3. The Settings model already had `renewal_semester` in the fillable array
4. The settings view already had the renewal semester dropdown implemented

The updateDeadlines method now properly validates and saves the renewal_semester setting.

## Deadline Check Implementation

Implemented deadline checking for renewal submissions:

1. **Controller Logic**: Added deadline validation in `submitRenewal` method that checks both start date and deadline from settings table
2. **View Updates**: Modified `renewal_app.blade.php` to:
    - Check if current time is within renewal period
    - Display appropriate messages when outside the period
    - Disable the renewal button when submissions are not allowed
    - Show start date and deadline information to scholars

The system now prevents renewal submissions outside the configured deadline period and provides clear feedback to scholars about when they can submit their renewals.

## Bug Fixes

Fixed critical issues in the `updateDeadlines` method:

1. **Validator Import**: Added missing `use Illuminate\Support\Facades\Validator;` import to `LydoAdminController.php`
2. **Model Timestamps**: Disabled timestamps in the Settings model (`public $timestamps = false;`) since the `tbl_settings` table doesn't have `created_at` and `updated_at` columns

These fixes resolved the "Class 'Validator' not found" error and the "Unknown column 'updated_at'" SQL error, allowing the deadline update functionality to work properly.
