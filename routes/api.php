<?php

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

Route::group(['prefix' => 'device', 'namespace' => 'API'], function(){
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');

    Route::middleware(['jwt.auth'])->group(function () {
    	Route::get('/survey', 'SurveyController');
    	Route::post('/feedback', 'FeedbackController');
    });
});

// Route::group(['prefix' => 'user'], function () {
//     Route::post('/register', 'API\RegisterController@register');
//     Route::post('/login', 'API\LoginController@login');
//     Route::post('/view-profile-without-auth', 'API\UserController@viewProfileWithoutAuth');

//     Route::post('/forget-password', 'API\LoginController@forgetPassword');
//     Route::post('/forget-password-phone', 'API\LoginController@forgetPasswordPhone');

//     Route::post('/verify-otp-forget-password-email', 'API\LoginController@verifyResetOTPPassword');
//     Route::post('/verify-otp-forget-password-phone', 'API\LoginController@verifyResetOTPPasswordPhone');

//     Route::post('/reset-password', 'API\LoginController@resetPasswordUsingEmail');
//     Route::post('/reset-password-phone', 'API\LoginController@resetPasswordUsingPhone');

//     Route::post('/first-time-app', 'API\UserController@saveDevice');
    
//     Route::post('/check-username', 'API\UserController@checkUserName');
//     Route::post('/check-username-social-login', 'API\UserController@checkUserNameSocialLogin');
//     Route::post('/check-email', 'API\UserController@checkEmail');
//     Route::post('/check-phone', 'API\UserController@checkPhone');
//     Route::post('/delete-phone', 'API\UserController@deletePhone');
//     Route::post('/check-otp', 'API\UserController@checkOTP');

//     Route::post('/trend-category-list', 'API\GeneralController@trendList');
//     Route::post('/trend-category-list-with-songs', 'API\GeneralController@trendListSongs');
//     Route::post('/category-list', 'API\GeneralController@categoryList');
//     Route::post('/category-list-with-songs', 'API\GeneralController@categoryListWithSongs');
//     Route::post('/banner-list', 'API\GeneralController@bannerList');
//     Route::post('/video-list', 'API\GeneralController@videoList');
//     Route::post('/music-list-against-category', 'API\MusicController@musicAgainstCategory');

//     Route::post('/videos-against-song', 'API\MusicController@videoAgainstSong');

//     Route::post('/tag-list', 'API\GeneralController@tagList');

//     //search
//     Route::post('/search', 'API\GeneralController@Search');
//     Route::post('/search-song', 'API\GeneralController@SearchSongs');
//     Route::post('/search/tag', 'API\GeneralController@SearchTag');
//     Route::post('/search/tags', 'API\GeneralController@SearchTags');
//     Route::post('/search/tag-with-object', 'API\GeneralController@SearchTagWithObject');
//     Route::post('/search/users', 'API\GeneralController@SearchUsers');
//     Route::post('/search/videos', 'API\GeneralController@SearchVidos');
//     Route::post('/search/song-video', 'API\GeneralController@SearchSongVideo');
//     Route::post('/search/tag-video', 'API\GeneralController@SearchTagVideo');

//     Route::post('/search/top-10-tags', 'API\GeneralController@top10tags');
//     Route::post('/search/top-10-tags-with-video', 'API\GeneralController@top10tagsWithVideos');

//     //token base all APIs
//     Route::middleware(['jwt.auth'])->group(function () {
//         Route::post('/view-profile', 'API\UserController@viewProfile');
//         Route::post('/update-profile', 'API\UserController@updateProfile');
//         Route::post('/update-fcm-token', 'API\UserController@updateFcmToken');

//         Route::post('/logout', 'API\UserController@logout');

//         Route::post('/music-favorite', 'API\MusicController@favorite');
//         Route::post('/trend-category-list-with-songs-auth', 'API\GeneralController@trendListSongswithAuth');

//         Route::post('/category-list-with-songs-with-auth', 'API\GeneralController@categoryListWithSongswithAuth');
//         Route::post('/music-favorite-list', 'API\MusicController@favoriteSongList');
        
//         Route::post('/for_you', 'API\VideoController@forYou');
//         Route::post('/upload-video', 'API\VideoController@uploadVideo');
//         Route::post('/video-list-auth', 'API\GeneralController@videoListAuth');
//         Route::post('/video-like-unlike', 'API\VideoController@likeUnlikeVideo');
//         Route::post('/listing-of-liked-videos', 'API\VideoController@listingLikeVideos');
//         Route::post('/share-video', 'API\VideoController@shareVideo');

//         Route::post('/video-save-unsave', 'API\VideoController@saveUnsaveVideo');
//         Route::post('/list-saved-videos', 'API\VideoController@listVideos');

//         Route::post('/post-comment', 'API\CommentController@postComment');
//         Route::post('/list-comment', 'API\CommentController@listComment');

//         Route::post('/follow-unfollow', 'API\FollowController@FollowUnfollow');
//         Route::post('/list-follow-unfollow', 'API\FollowController@listFollowUnFollow');

//         Route::post('/app_feedback_complaints', 'API\GeneralController@postComplaint');

//         Route::post('/chat_list', 'API\ChatController@chatList');
//         Route::post('/chat_with_id', 'API\ChatController@chatById');
//         Route::post('/check_chat_id', 'API\ChatController@checkChatId');
//         Route::post('/send/message', 'API\ChatController@postMessage');
//         Route::post('/update_online_status', 'API\ChatController@updateUserOnlineStatus');
//         Route::post('/update_chat_is_read', 'API\ChatController@updateChatIsRead');
//         Route::post('/unread_chat_count', 'API\ChatController@UnreadChatCount');

//         Route::post('/liked_videos_list', 'API\GeneralController@likeVideosListByUserID');


//         Route::post('/notificationlist', 'API\NotificationController@NotificationList');
//         Route::post('/unread_notification_count', 'API\NotificationController@UnreadNotificationCount');
//         Route::post('/notification_read_all', 'API\NotificationController@NotificationReadAll');
//         Route::post('/notification_video_by_id', 'API\NotificationController@NotificationVideoById');

//         Route::post('/report', 'API\ReportController@Report');

//     });
// });