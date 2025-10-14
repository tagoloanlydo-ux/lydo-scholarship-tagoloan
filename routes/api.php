<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ScholarController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DisbursementController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RenewalController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MayorApplicationController; // Add this missing import
use App\Http\Controllers\MayorStaffController; // Add this import for API routes

// ----------------------- PUBLIC ROUTES -----------------------
Route::post('/login', [AuthController::class, 'login']);
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/scholars/login', [ScholarController::class, 'login']);

// ----------------------- PUBLIC APPLICATION SUBMISSION -----------------------
Route::post('/applications', [ApplicantController::class, 'store']); // Allow public submission
Route::post('/mayor/applications', [MayorApplicationController::class, 'store']); // Allow public submission

// ----------------------- API TEST -----------------------
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});

// ----------------------- PROTECTED ROUTES (Require Authentication) -----------------------
Route::middleware('auth:sanctum')->group(function () {

    // ----------------------- AUTH -----------------------
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // ----------------------- MAYOR APPLICATIONS -----------------------
    Route::prefix('mayor')->group(function () {
        Route::get('/applications', [MayorApplicationController::class, 'index']);
        Route::post('/applications', [MayorApplicationController::class, 'store']);
        Route::post('/applications/status/{id}', [MayorApplicationController::class, 'updateStatus']);
        Route::get('/applications/{id}', [MayorApplicationController::class, 'show']);
        Route::put('/applications/{id}', [MayorApplicationController::class, 'update']);
        Route::delete('/applications/{id}', [MayorApplicationController::class, 'destroy']);
    });

    // ----------------------- MAYOR STAFF API ROUTES (Mobile App) -----------------------
    Route::prefix('mayor')->group(function () {
        // Dashboard routes
        Route::get('/dashboard', [MayorStaffController::class, 'index']);


        // Application management routes
        Route::get('/applications', [MayorStaffController::class, 'application']);
        Route::get('/application/updates', [MayorStaffController::class, 'getApplicationUpdates']);
        Route::post('/applications/{id}/approve', [MayorStaffController::class, 'approveApplication']);
        Route::post('/applications/{id}/reject', [MayorStaffController::class, 'rejectApplication']);
        Route::post('/applications/{id}/update-initial-screening', [MayorStaffController::class, 'updateInitialScreening']);
        Route::patch('/applications/{id}/edit-initial-screening', [MayorStaffController::class, 'editInitialScreening']);
        Route::delete('/applications/{id}', [MayorStaffController::class, 'deleteApplication']);
        Route::get('/applications/{id}/requirements', [MayorStaffController::class, 'getRequirements']);

        // Status management routes
        Route::get('/status', [MayorStaffController::class, 'status']);
        Route::get('/status/updates', [MayorStaffController::class, 'getStatusUpdates']);
        Route::post('/applications/{id}/update-status', [MayorStaffController::class, 'updateStatus']);

        // Email and SMS routes
        Route::post('/send-email', [MayorStaffController::class, 'sendEmail']);

        // Settings routes
        Route::get('/settings', [MayorStaffController::class, 'settings']);
        Route::put('/settings/personal-info/{id}', [MayorStaffController::class, 'updatePersonalInfo']);
        Route::put('/settings/password', [MayorStaffController::class, 'updatePassword']);
        Route::post('/notifications/viewed', [MayorStaffController::class, 'markNotificationsViewed']);

        // Report routes
        Route::get('/report', [MayorStaffController::class, 'report']);
        Route::get('/report/print', [MayorStaffController::class, 'printReport']);
        Route::get('/report/print-status', [MayorStaffController::class, 'printStatusReport']);

        // SSE routes
        Route::get('/sse/applicants', [MayorStaffController::class, 'sseApplicants']);
    });

    // ----------------------- ANNOUNCEMENTS -----------------------
    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::get('/announcements/scholars', [AnnouncementController::class, 'scholars']);
    Route::get('/announcements/applicants', [AnnouncementController::class, 'applicants']);
    Route::post('/announcements', [AnnouncementController::class, 'store']);
    Route::put('/announcements/{id}', [AnnouncementController::class, 'update']);
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);

    // ----------------------- SCHOLARS -----------------------
    Route::get('/scholars', [ScholarController::class, 'index']);
    Route::get('/scholars/count', [ScholarController::class, 'count']);
    Route::get('/scholars/inactive/count', [ScholarController::class, 'inactiveCount']);
    Route::post('/scholars', [ScholarController::class, 'store']);
    Route::put('/scholars/{id}', [ScholarController::class, 'update']);
    Route::put('/scholars/{id}/profile', [ScholarController::class, 'updateProfile']);
    Route::put('/scholars/{id}/status', [ScholarController::class, 'updateStatus']);
    Route::delete('/scholars/{id}', [ScholarController::class, 'destroy']);

    // ----------------------- APPLICANTS -----------------------
    Route::get('/applicants', [ApplicantController::class, 'index']);
    Route::get('/applicants/meta', [ApplicantController::class, 'meta']);
    Route::get('/applicants/distribution/barangay', [ApplicantController::class, 'distributionByBarangay']);
    Route::get('/applicants/distribution/school', [ApplicantController::class, 'distributionBySchool']);
    Route::post('/applicants', [ApplicantController::class, 'store']);
    Route::put('/applicants/{id}', [ApplicantController::class, 'update']);
    Route::delete('/applicants/{id}', [ApplicantController::class, 'destroy']);

    // ----------------------- DISBURSEMENTS -----------------------
    Route::get('/disbursements', [DisbursementController::class, 'index']);
    Route::get('/disbursements/pending/count', [DisbursementController::class, 'pendingCount']);
    Route::post('/disbursements', [DisbursementController::class, 'store']);
    Route::put('/disbursements/{id}', [DisbursementController::class, 'update']);
    Route::delete('/disbursements/{id}', [DisbursementController::class, 'destroy']);

    // ----------------------- STAFF -----------------------
    Route::get('/staff', [StaffController::class, 'index']);
    Route::post('/staff', [StaffController::class, 'store']);
    Route::put('/staff/{id}', [StaffController::class, 'update']);
    Route::delete('/staff/{id}', [StaffController::class, 'destroy']);

    // ----------------------- REPORTS -----------------------
    Route::get('/reports', [ReportController::class, 'index']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::put('/reports/{id}', [ReportController::class, 'update']);
    Route::delete('/reports/{id}', [ReportController::class, 'destroy']);

    // ----------------------- USERS -----------------------
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // ----------------------- RENEWALS -----------------------
    Route::get('/renewals', [RenewalController::class, 'index']);
    Route::get('/renewals/pending/count', [RenewalController::class, 'pendingCount']);
    Route::post('/renewals', [RenewalController::class, 'store']);
    Route::put('/renewals/{id}', [RenewalController::class, 'update']);
    Route::delete('/renewals/{id}', [RenewalController::class, 'destroy']);

    // ----------------------- EMAIL -----------------------
    Route::post('/send-email', [EmailController::class, 'send']);

    // ----------------------- SMS -----------------------
    Route::post('/send-sms', [EmailController::class, 'sendSms']);

});
