# TODO: Fix Renewal Rejection Reason Implementation

## Completed Tasks

-   [x] Create migration to add `rejection_reason` column to `tbl_renewal` table
-   [x] Update `updateRenewalStatus` method in `LydoStaffController.php` to save rejection reason when status is Rejected
-   [x] Run migration to apply database changes

## Summary

The issue was that the rejection reason was being sent in the email but not saved in the database. The fix involved:

1. Adding a nullable `rejection_reason` text column to the `tbl_renewal` table via migration.
2. Modifying the `updateRenewalStatus` method to save the reason in the database when rejecting a renewal.
3. The email template already includes the reason if provided, so no changes were needed there.

The rejection flow now properly saves the reason in the database and includes it in the email sent to the scholar.
