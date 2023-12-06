<?php

use App\Http\Controllers\Admin\AnnouncementCommentController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\LeaveRequestController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\MeetingDetailController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\SubjectController;
use App\Models\AnnouncementComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("admin")->group(function () {
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('meetings', MeetingController::class);
    // Route::apiResource('meeting-details', MeetingDetailController::class);
    Route::apiResource('leave-requests', LeaveRequestController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('announcements', AnnouncementController::class);
    Route::apiResource('announcement-comments', AnnouncementCommentController::class);
    Route::apiResource('holidays', HolidayController::class);

    Route::post("meeting-details/add-participants/{meeting}", [MeetingController::class, "addParticipants"]);
    Route::post("meeting-details/delete-participants/{meeting}", [MeetingController::class, "deleteParticipants"]);
    Route::patch("meetings/finished/{meeting}", [MeetingController::class, "finishMeeting"]);


    Route::patch("leave-requests/update-status", [LeaveRequestController::class, "updateStatus"]);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
