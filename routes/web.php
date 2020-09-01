<?php

use Illuminate\Support\Facades\Route;
use App\Notification;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); */

/* Route::livewire('/', 'home')->layout('layouts.frontend-layout'); */

/* Route::layout('layouts.frontend-layout')->section('main-content')->group(function(){
    Route::livewire('/', 'home')->name('home');
});


Route::layout('layouts.auth-layout')->section('main-content')->group(function(){
    Route::livewire('/login', 'login')->name('login');
});

Route::livewire('/activity-stream', 'activity-stream')->name('activity-stream');
Route::livewire('/workflows', 'workflows')->name('workflows'); */
#Base [Frontend routes]
Route::get('/test', function(){
    $unread = Auth::user()->unReadNotifications;
    return dd($unread);
});
Route::get('/', 'CNX247\Frontend\BaseController@homepage')->name('home');

#Administrator routes
Route::get('/dashboard', 'CNX247\Backend\DashboardController@index')->name('dashboard');
Route::get('/roles', 'CNX247\Backend\AdminController@roles')->name('roles');
Route::post('/role/new', 'CNX247\Backend\AdminController@newRole')->name('new-role');
Route::get('/role/edit/{id}', 'CNX247\Backend\AdminController@editRole')->name('edit-role');
Route::post('/role/save', 'CNX247\Backend\AdminController@saveRoleChanges')->name('save-role-changes');
Route::get('/permissions', 'CNX247\Backend\AdminController@permissions')->name('permissions');
Route::get('/permission/edit/{id}', 'CNX247\Backend\AdminController@editPermission')->name('edit-permission');
Route::post('/permission/edit', 'CNX247\Backend\AdminController@savePermissionChanges')->name('save-permission-changes');
Route::post('/permission/new', 'CNX247\Backend\AdminController@newPermission')->name('new-permission');
Route::get('/assign/role-to-permission/{id}', 'CNX247\Backend\AdminController@assignRoleToPermission')
        ->name('assign-role-to-permission');
Route::post('/store/permission', 'CNX247\Backend\AdminController@storeRolePermission')->name('store-permission');
Route::get('/module-manager', 'CNX247\Backend\AdminController@moduleManager')->name('module-manager');
Route::post('/module/new', 'CNX247\Backend\AdminController@newModule')->name('new-module');
#Plans & Features
Route::get('/plans-n-features', 'CNX247\Backend\PlansnFeaturesController@index')->name('plans-n-features');
Route::get('/plans-n-features/new', 'CNX247\Backend\PlansnFeaturesController@create')->name('new-plans-n-features');
Route::post('/plans-n-features/new', 'CNX247\Backend\PlansnFeaturesController@store');
Route::get('/plans-n-features/view/{url}', 'CNX247\Backend\PlansnFeaturesController@view')->name('view-plans-n-features');
#Constants
Route::get('/admin/constants', 'CNX247\Backend\ConstantController@index')->name('constants');
#Tenants
Route::get('/tenants', 'CNX247\Backend\TenantController@index')->name('tenants');
Route::get('/tenant/{slug}', 'CNX247\Backend\TenantController@view')->name('view-tenant');
Route::get('/tenant/analytics/financials', 'CNX247\Backend\TenantController@financials')->name('tenant-financials');
Route::get('/tenants/memberships', 'CNX247\Backend\TenantController@memberships')->name('tenant-memberships');
Route::post('/tenant/send-reminder', 'CNX247\Backend\TenantController@sendReminder');
Route::post('/tenant/email/send', 'CNX247\Backend\TenantController@sendMessage');
Route::get('/tenant/landlord/conversation/{slug}', 'CNX247\Backend\TenantController@viewConversation')->name('tenant-landlord-conversation');
#General settings
Route::get('/general-settings', 'CNX247\Backend\GeneralSettingsController@index')->name('general-settings');
Route::post('/change/company-assets', 'CNX247\Backend\GeneralSettingsController@changeCompanyAssets');

#Workflow Routes
Route::get('/workflow-tasks', 'CNX247\Backend\WorkflowController@index')->name('workflow-tasks');
Route::get('/workflow-task/view/{url}', 'CNX247\Backend\WorkflowController@viewWorkflowTask')->name('view-workflow-task');

#Expense report route
Route::get('/expense-report', 'CNX247\Backend\ExpenseController@index')->name('expense-report');

#Purchase request route
Route::get('/purchase-request', 'CNX247\Backend\PurchaseRequestController@index')->name('purchase-request');

#General request route
Route::get('/general-request', 'CNX247\Backend\GeneralRequestController@index')->name('general-request');

#Business trip route
Route::get('/business-trip', 'CNX247\Backend\BusinessTripController@index')->name('business-trip');

#Leave request route
Route::get('/leave-request', 'CNX247\Backend\LeaveRequestController@index')->name('leave-request');

#Internal memo routes
Route::get('/internal-memo', 'CNX247\Backend\InternalMemoController@index')->name('internal-memo');

#Announcement routes
Route::get('/announcement', 'CNX247\Backend\AnnouncementController@index')->name('internal-memo');

#Chat n Calls routes
Route::get('/conversation/{id}', 'CNX247\Backend\ChatnCallsController@getConversation')->name('conversation');
Route::post('/conversation/send', 'CNX247\Backend\ChatnCallsController@sendChat');
Route::post('/conversation/attachment', 'CNX247\Backend\ChatnCallsController@sendAttachment');
Route::get('/chat-n-calls', 'CNX247\Backend\ChatnCallsController@showChatnCallsView')->name('chat-n-calls');

#CNXStream
Route::get('/cnx247-stream', 'CNX247\Backend\CNX247Stream@index')->name('cnx247-stream');
Route::get('/livestreaming/{room_name}', 'CNX247\Backend\CNX247Stream@joinRoom')->name('join-room');
Route::post('/livestreaming/security-check', 'CNX247\Backend\CNX247Stream@securityCheck')->name('security-check');
Route::post('/cnx247-stream/create', 'CNX247\Backend\CNX247Stream@createRoom')->name('create-new-room');
Route::get('/delete/room/{room_name}', 'CNX247\Backend\CNX247Stream@deleteRoom')->name('delete-room');

#Auth routes
Route::get('/signup', 'Auth\RegisterController@signup')->name('signup');
Route::get('/email-verification', 'Auth\RegisterController@emailVerification')->name('email-verification');
Route::get('/verify/{link}', 'Auth\RegisterController@verifyEmail')->name('verify-email');
Route::get('/signin', 'Auth\LoginController@signin')->name('signin');
Route::get('/reset-password', 'Auth\LoginController@showResetPasswordForm')->name('reset-password');
Route::get('/reset-password/{token}', 'Auth\LoginController@setPassword')->name('set-password');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

#Payment Gateway
Route::get('/create-site/{timestamp}/{plan}', 'CNX247\Frontend\PaymentGatewayController@createSite')->name('create-site');
Route::post('/register-site', 'CNX247\Frontend\PaymentGatewayController@proceedToPay')->name('register-site');
Route::get('/payment/gateway', 'CNX247\Frontend\PaymentGatewayController@handleGatewayCallback')->name('payment-callback');

#Frontend routes
Route::get('/pricing', 'CNX247\Frontend\BaseController@pricing')->name('pricing');
Route::get('/support', 'CNX247\Frontend\BaseController@support')->name('support');
Route::get('/faqs', 'CNX247\Frontend\BaseController@faqs')->name('faqs');
#User routes
Route::get('/my-profile', 'CNX247\Backend\UserController@myProfile')->name('my-profile');
Route::get('/notifications', 'CNX247\Backend\UserController@notifications')->name('notifications');
Route::post('/upload/avatar', 'CNX247\Backend\UserController@uploadAvatar');
Route::post('/upload/cover', 'CNX247\Backend\UserController@uploadCoverPhoto');
Route::get('/user/administration', 'CNX247\Backend\UserController@administration')->name('user-administration');
Route::get('/user/settings', 'CNX247\Backend\UserController@settings')->name('user-settings');
Route::get('/settings/education', 'CNX247\Backend\UserController@education')->name('education');
Route::post('/settings/education', 'CNX247\Backend\UserController@storeEducation');
Route::get('/settings/work-experience', 'CNX247\Backend\UserController@workExperience')->name('work-experience');
Route::get('/p/our-pricing', 'CNX247\Backend\UserController@ourPricing')->name('our-pricing');


#HR routes
Route::get('/hr-dashboard', 'CNX247\Backend\HRController@hrDashboard')->name('hr-dashboard');
Route::get('/employees', 'CNX247\Backend\HRController@index')->name('employees');
Route::get('/appreciation', 'CNX247\Backend\HRController@appreciation')->name('appreciation');
Route::get('/on-boarding', 'CNX247\Backend\HRController@onBoarding')->name('on-boarding');
    #Resignation
        Route::get('/resignation', 'CNX247\Backend\HRController@resignation')->name('resignation');
        Route::post('/resignation', 'CNX247\Backend\HRController@submitResignation');
    #Complaint
        Route::get('/complaints', 'CNX247\Backend\HRController@complaints')->name('complaints');
    #Timesheet
        Route::get('/attendance', 'CNX247\Backend\HRController@attendance')->name('attendance');
        Route::get('/leave-management', 'CNX247\Backend\HRController@leaveManagement')->name('leave-management');
        Route::get('/leave-wallet', 'CNX247\Backend\HRController@leaveWallet')->name('leave-wallet');
        Route::get('/leave-type', 'CNX247\Backend\HRController@leaveType')->name('leave-type');
        Route::get('/timesheet', 'CNX247\Backend\HRController@timesheet')->name('timesheet');
    #Performance
        Route::get('/performance-indicator', 'CNX247\Backend\HRController@performanceIndicator')->name('performance-indicator');
    #HR Constants
        Route::get('/hr/configurations', 'CNX247\Backend\HRController@hrConfigurations')->name('hr-configurations');
    #Assign permission(s) to employee
        Route::get('/assign/permission-to-employee/{url}', 'CNX247\Backend\HRController@assignPermissionToEmployee')
        ->name('assign-permission-to-employee');
        Route::post('/store/user/permission', 'CNX247\Backend\HRController@storeUserPermission')
               ->name('store-user-permission');
    #Query employee
        Route::get('/employee/queries', 'CNX247\Backend\HRController@queries')->name('queries');
        Route::get('/query/employee/{url}', 'CNX247\Backend\HRController@queryEmployee')->name('query-employee');
        Route::post('/store/query/employee', 'CNX247\Backend\HRController@storeQueryEmployee')->name('store-query-employee');
        Route::get('/employee/query/view/{slug}', 'CNX247\Backend\HRController@viewQuery')->name('view-query');
#Customer Relationship Management (CRM)
Route::get('/crm-dashboard', 'CNX247\Backend\CRMController@crmDashboard')->name('crm-dashboard');
#Leads
    Route::get('/crm/leads', 'CNX247\Backend\CRMController@leads')->name('leads');
    Route::get('/crm/lead/view/{slug}', 'CNX247\Backend\CRMController@viewLead')->name('view-lead');
    Route::get('/crm/lead/convert-to-deal/{slug}', 'CNX247\Backend\CRMController@convertLeadToDeal')->name('convert-to-deal');
    Route::post('/crm/lead/raise-receipt', 'CNX247\Backend\CRMController@raiseReceipt')->name('raise-receipt');
#Deal
    Route::get('/crm/deals', 'CNX247\Backend\CRMController@deals')->name('deals');
    Route::get('/crm/deal/view/{slug}', 'CNX247\Backend\CRMController@viewDeal')->name('view-deal');
#Invoice list
    Route::get('/invoice-list', 'CNX247\Backend\CRMController@invoiceList')->name('invoice-list');
    Route::get('/print/invoice/{slug}', 'CNX247\Backend\CRMController@printInvoice')->name('print-invoice');
    Route::post('/send/invoice/email', 'CNX247\Backend\CRMController@sendInvoiceViaEmail');
#Receipt list
    Route::get('/receipt-list', 'CNX247\Backend\CRMController@receiptList')->name('receipt-list');
    Route::get('/print/receipt/{slug}', 'CNX247\Backend\CRMController@printReceipt')->name('print-receipt');
    Route::post('/send/receipt/email', 'CNX247\Backend\CRMController@sendReceiptViaEmail');
#Contacts/clients
    Route::get('/crm/clients', 'CNX247\Backend\CRMController@clients')->name('clients');
    Route::get('/crm/client/new', 'CNX247\Backend\CRMController@createClient')->name('new-client');
    Route::get('/crm/client/view/{slug}', 'CNX247\Backend\CRMController@viewClient')->name('view-client');
    Route::get('/crm/client/edit/{slug}', 'CNX247\Backend\CRMController@editClient')->name('edit-client');
#Products
    Route::get('/crm/products', 'CNX247\Backend\CRMController@products')->name('products');
    Route::get('/crm/product/new', 'CNX247\Backend\CRMController@addNewProduct')->name('add-new-product');
    Route::post('/crm/product/new', 'CNX247\Backend\CRMController@saveProduct');
    Route::get('/crm/product/{slug}', 'CNX247\Backend\CRMController@viewProduct')->name('product-details');
    Route::get('/crm/product/edit/{slug}', 'CNX247\Backend\CRMController@editProduct')->name('edit-product');
    Route::post('/crm/product/edit', 'CNX247\Backend\CRMController@saveProductChanges');
    Route::get('/crm/product/delete/{slug}', 'CNX247\Backend\CRMController@deleteProduct')->name('delete-product');
#Bulk SMS
    Route::get('/crm/bulk-sms', 'CNX247\Backend\BulkSmsController@index')->name('bulk-sms');
    Route::post('/crm/bulk-sms/send', 'CNX247\Backend\BulkSmsController@processSMS');
#Email Campaign
    Route::get('/crm/email-campaigns', 'CNX247\Backend\EmailCampaignController@index')->name('email-campaigns');
    Route::get('/crm/email-campaig/new', 'CNX247\Backend\EmailCampaignController@create')->name('new-email-campaign');
    Route::post('/crm/email-campaig/new', 'CNX247\Backend\EmailCampaignController@store');
#Convert client to lead
Route::get('/crm/client/convert-to-lead/{slug}', 'CNX247\Backend\CRMController@convertClientToLead')->name('convert-to-lead');
Route::post('/crm/client/raise-an-invoice', 'CNX247\Backend\CRMController@raiseAnInvoice')->name('raise-an-invoice');
#Social media
Route::get('/facebook/connect-to-facebook', 'CNX247\Backend\FacebookController@connect')->name('connect-to-facebook');
Route::get('/facebook/facebook-timeline', 'CNX247\Backend\FacebookController@facebookTimeline')->name('facebook-timeline');
#Support
Route::get('/support/ticket', 'CNX247\Backend\SupportController@ticket')->name('ticket');
Route::get('/support/ticket-history', 'CNX247\Backend\SupportController@ticketHistory')->name('ticket-history');
Route::get('/support/view-ticket/{slug}', 'CNX247\Backend\SupportController@viewTicket')->name('view-ticket');
#Admin area support
Route::get('/crm/support/tickets', 'CNX247\Backend\SupportController@adminTicketIndex')->name('admin-support');
Route::post('/crm/support/ticket/category/new', 'CNX247\Backend\SupportController@newTicketCategory')->name('new-ticket-category');

#Activity stream routes
Route::get('/activity-stream', 'CNX247\Backend\ActivityStreamController@index')->name('activity-stream');
Route::post('/activity-stream/message', 'CNX247\Backend\ActivityStreamController@sendMessage');
Route::post('/task/new', 'CNX247\Backend\ActivityStreamController@createTask');
Route::post('/event/new', 'CNX247\Backend\ActivityStreamController@createEvent');
Route::post('/announcement/new', 'CNX247\Backend\ActivityStreamController@createAnnouncement');
Route::post('/file/new', 'CNX247\Backend\ActivityStreamController@shareFile');
Route::post('/appreciation/new', 'CNX247\Backend\ActivityStreamController@createAppreciation');
Route::post('/invitation/email', 'CNX247\Backend\ActivityStreamController@sendInvitationByEmail');

#View an employee's profile
Route::get('/activity-stream/profile/{url}', 'CNX247\Backend\ActivityStreamController@viewProfile')
        ->name('view-profile');

#Task routes
Route::get('/task/task-board', 'CNX247\Backend\TaskController@taskBoard')->name('task-board');
Route::get('/task/new', 'CNX247\Backend\TaskController@newTask')->name('new-task');
Route::post('/task/new', 'CNX247\Backend\TaskController@storeTask')->name('new-task');
Route::get('/task/view/{url}', 'CNX247\Backend\TaskController@viewTask')->name('view-task');
Route::get('/task/calendar', 'CNX247\Backend\TaskController@taskCalendar')->name('task-calendar'); //[view]
Route::get('/task-calendar', 'CNX247\Backend\TaskController@getTaskCalendarData'); //[Data source]
Route::get('/task/gantt-chart', 'CNX247\Backend\TaskController@taskGanttChart')->name('task-gantt-chart');
Route::get('/task-gantt-chart', 'CNX247\Backend\TaskController@getTaskGanttChartData');
Route::get('/task/task-analytics', 'CNX247\Backend\TaskController@taskAnalytics')->name('task-analytics');
Route::post('/delete/task', 'CNX247\Backend\TaskController@deleteTask');
Route::get('/task/edit/{url}', 'CNX247\Backend\TaskController@editTask')->name('edit-task');
Route::post('/task/update', 'CNX247\Backend\TaskController@updateTask')->name('update-task');

#Project routes
Route::get('/project/project-board', 'CNX247\Backend\ProjectController@projectBoard')->name('project-board');
Route::get('/project/new', 'CNX247\Backend\ProjectController@newProject')->name('new-project');
Route::post('/project/new', 'CNX247\Backend\ProjectController@storeProject');
Route::get('/project/view/{url}', 'CNX247\Backend\ProjectController@viewProject')->name('view-project');
Route::get('/project/calendar', 'CNX247\Backend\ProjectController@projectCalendar')->name('project-calendar'); //[view]
Route::get('/project-calendar', 'CNX247\Backend\ProjectController@getProjectCalendarData'); //[Data source]
Route::get('/project/gantt-chart', 'CNX247\Backend\ProjectController@projectGanttChart')->name('project-gantt-chart');
Route::get('/project-gantt-chart', 'CNX247\Backend\ProjectController@getProjectGanttChartData');
Route::get('/project/project-analytics', 'CNX247\Backend\ProjectController@projectAnalytics')->name('project-analytics');
Route::post('/delete/task', 'CNX247\Backend\ProjectController@deleteProject');
Route::get('/project/edit/{url}', 'CNX247\Backend\ProjectController@editProject')->name('edit-project');
Route::post('/project/update', 'CNX247\Backend\ProjectController@updateProject')->name('update-project');
Route::post('/project/milestone', 'CNX247\Backend\ProjectController@createProjectMilestone');
#Workgroup routes
Route::get('/workgroups', 'CNX247\Backend\WorkgroupController@index')->name('workgroups');
Route::get('/workgroup/new', 'CNX247\Backend\WorkgroupController@showNewWorkgroupForm')->name('new-workgroup');
Route::get('/workgroup/view/{url}', 'CNX247\Backend\WorkgroupController@viewWorkgroup')->name('view-workgroup');
Route::post('/workgroup/message', 'CNX247\Backend\WorkgroupController@sendMessage');
Route::post('/workgroup/task/new', 'CNX247\Backend\WorkgroupController@createTask')->name('workgroup-task');
Route::post('/workgroup/event/new', 'CNX247\Backend\WorkgroupController@createEvent');
Route::post('/workgroup/announcement/new', 'CNX247\Backend\WorkgroupController@createAnnouncement')->name('workgroup-announcement');
Route::post('/workgroup/file/new', 'CNX247\Backend\WorkgroupController@shareFile')->name('share-file');
Route::post('/workgroup/appreciation/new', 'CNX247\Backend\WorkgroupController@createAppreciation');
Route::post('/workgroup/remove-member', 'CNX247\Backend\WorkgroupController@removeMember');
Route::post('/workgroup/remove-moderator', 'CNX247\Backend\WorkgroupController@removeModerator');
Route::post('/workgroup/send-invitation', 'CNX247\Backend\WorkgroupController@sendWorkgroupInvitation');
Route::get('/workgroup/invitation/{slug}', 'CNX247\Backend\WorkgroupController@viewWorkgroupInvite')->name('view-workgroup-invitation');
Route::post('/workgroup/invitation/action', 'CNX247\Backend\WorkgroupController@workgroupAction')->name('workgroup-action');
//Route::post('/invitation/email', 'CNX247\Backend\ActivityStreamController@sendInvitationByEmail');


#CNX247.Drive routes
Route::get('/cnx247-drive', 'CNX247\Backend\CNX247DriveController@index')->name('cnx247-drive');
#Tutorial
Route::get('/cnx247-drive/show', 'CNX247\Backend\CNX247DriveController@show')->name('show-files');
Route::post('/drive/make-directory', 'CNX247\Backend\CNX247DriveController@createDirectory');
Route::post('/cnx247-drive/upload', 'CNX247\Backend\CNX247DriveController@uploadFile')->name('upload-file');

#Event routes
Route::get('/my-events', 'CNX247\Backend\EventController@myEvents')->name('my-events');
Route::get('/my-new-event', 'CNX247\Backend\EventController@addNewEvent')->name('my-new-event');
Route::post('/my-new-event', 'CNX247\Backend\EventController@storeEvent');
Route::get('/my-event/list', 'CNX247\Backend\EventController@myEventList')->name('my-event-list');
Route::get('/my-event/calendar', 'CNX247\Backend\EventController@eventCalendar')->name('my-event-calendar');
Route::get('/my-event-calendar', 'CNX247\Backend\EventController@getEventCalendarData');
Route::get('/company-calendar', 'CNX247\Backend\EventController@companyCalendar')->name('company-calendar');
Route::get('/company-event-calendar', 'CNX247\Backend\EventController@getCompanyEventData');
#QuickBooks routes
//Route::get('/connect-to-quickbooks', 'CNX247\Backend\QuickBooksController@analyzeBusiness');
Route::get('/connect-to-quickbooks', 'CNX247\Backend\QuickBooksController@connectToQuickBooks')->name('connect-to-quickbooks');
Route::get('/call-quickbooks', 'CNX247\Backend\QuickBooksController@makeAPICall');

#Tenant terms -n privacy routes
Route::get('/cnx247/terms-n-conditions', 'CNX247\Backend\TenantController@termsAndConditions')->name('cnx247-terms-n-conditions');
Route::get('/cnx247/privacy-policy', 'CNX247\Backend\TenantController@privacyPolicy')->name('cnx247-privacy-policy');

#Administration routes
Route::get('/terms-n-conditions', 'CNX247\Backend\AdminController@termsAndConditions')->name('terms-n-conditions');
Route::get('/edit/terms-n-conditions/{id}', 'CNX247\Backend\AdminController@showEditTermsForm')->name('edit-terms-n-conditions');
Route::post('/update-terms-n-conditions', 'CNX247\Backend\AdminController@editTermsAndConditions')->name('update-terms-n-conditions');
Route::get('/privacy-policy', 'CNX247\Backend\AdminController@privacyPolicy')->name('privacy-policy');
Route::get('/edit/privacy-policy/{id}', 'CNX247\Backend\AdminController@showEditPrivacyPolicyForm')->name('edit-privacy-policy');
Route::post('/update-privacy-policy', 'CNX247\Backend\AdminController@editPrivacyPolicy')->name('update-privacy-policy');

#Error routes
Route::get('/404', 'CNX247\Backend\ErrorController@error404')->name('404');
