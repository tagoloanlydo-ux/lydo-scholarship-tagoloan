# TODO: Modify Mayor Staff Status Page for Rejection with SweetAlert Input

## Tasks

-   [ ] Remove the textarea for reason from the form in resources/views/mayor_staff/status.blade.php
-   [ ] Modify JavaScript to show SweetAlert with input field for reason when status is changed to "Rejected"
-   [ ] Update the handleStatusChange function to prompt for reason in SweetAlert instead of checking textarea
-   [ ] Ensure the reason is passed to the submitForm function and included in the AJAX request
-   [ ] Verify that the email is sent with the reason (controller already handles this)

## Notes

-   The controller updateStatus method already validates and sends email with reason for rejections.
-   The email template scholar-status-rejection.blade.php already includes the reason.
-   No changes needed to controller or email template.
