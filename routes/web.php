<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MailServiceController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SMTPConfigureController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\StatisticsController;


Route::get('/', [WelcomeController::class, 'show'])->name('home');
Route::get('/about_us', [WelcomeController::class, 'about_us'])->name('about_us');
Route::get('/faq', [WelcomeController::class, 'faq'])->name('faq');
Route::get('/testimonial', [WelcomeController::class, 'testimonial'])->name('testimonial');
Route::get('/privacy_policy', [WelcomeController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/contact_us', [WelcomeController::class, 'contact_us'])->name('contact_us');

Route::group(['middleware' => 'auth'], function ($router) {

    $router->get('/home', [MailServiceController::class, 'index']);
    $router->get('/mail-service', [MailServiceController::class, 'index']);

    $router->get('/template', [TemplateController::class, 'index']);
    $router->get('/template/add/{id?}', [TemplateController::class, 'template_add']);
    $router->get('/template/delete/{id}', [TemplateController::class, 'template_delete']);
    $router->get('template/set_default/{id}', [TemplateController::class, 'set_default']);
    $router->get('template/set_admin_default/{id}', [TemplateController::class, 'set_admin_default']);
    $router->post('save_template', [TemplateController::class, 'save_template'])->name('save_template');

    $router->get('/smtp-configure', [SMTPConfigureController::class, 'index']);
    $router->get('/extra-mail-field', [TemplateController::class, 'extra_mail_field']);
    $router->post('/save-extra-field-frm', [TemplateController::class, 'save_extra_mail_field']);
    $router->post('/delete-extra-field-frm', [TemplateController::class, 'delete_extra_mail_field']);
    $router->post('/sorted-extra-field-frm', [TemplateController::class, 'sorted_extra_field_frm']);
    $router->get('/company-info', [CompanyInfoController::class, 'index']);
    $router->post('save_company_info', [CompanyInfoController::class, 'save_company_info'])->name('save_company_info');
    $router->get('send_ticket_mail', [MailServiceController::class, 'send_ticket_mail'])->name('send_ticket_mail');
    $router->post('save_mail_service', [MailServiceController::class, 'save_mail_service'])->name('save_mail_service');
    $router->post('save_smpt_settings', [SMTPConfigureController::class, 'save_smpt_settings'])->name('save_smpt_settings');
    $router->get('/oauth/gmail', [SMTPConfigureController::class, 'gmail_login']);
    $router->get('remove-google-account', [SMTPConfigureController::class, 'remove_google_account']);
    $router->get('/oauth/gmail/callback', [SMTPConfigureController::class, 'save_googlesmtp_settings']);
    $router->get('/google-inbox', [SMTPConfigureController::class, 'google_inbox']);
    $router->get('/g-send-mail', [MailServiceController::class, 'g_sent_mails']);
    $router->get('/g-send-mail-search', [MailServiceController::class, 'g_sent_mails_search'])->name('g-send-mail-search');
    $router->get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
    $router->post('/ajax_email_sent', [StatisticsController::class, 'ajax_email_sent'])->name('ajax_email_sent');
    $router->post('/ajax_revenue_graphs', [StatisticsController::class, 'ajax_revenue_graphs'])->name('ajax_revenue_graphs');
    $router->post('/ajax_customer_conversation', [StatisticsController::class, 'ajax_customer_conversation'])->name('ajax_customer_conversation');
    $router->post('/ajax_popular_origin', [StatisticsController::class, 'ajax_popular_origin'])->name('ajax_popular_origin');
    $router->post('/ajax_popular_destination', [StatisticsController::class, 'ajax_popular_destination'])->name('ajax_popular_destination');
    $router->post('/ajax_avg_cost_per_pound', [StatisticsController::class, 'ajax_avg_cost_per_pound'])->name('ajax_avg_cost_per_pound');
    

    $router->post('/mail_reply', [MailServiceController::class, 'mail_reply']);
    $router->post('/update_send_mail_status', [MailServiceController::class, 'update_send_mail_status']);
    $router->get('/google/mail/details/{id}/{title}', [SMTPConfigureController::class, 'gmail_mail_detail']);
    $router->get('/g-sent-mail-details/{id}', [MailServiceController::class, 'g_sent_mail_details']);


});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear'); 
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});


Route::get('storage-link', function(){
	$target = storage_path('app/public');
	$link = public_path('storage');
	symlink($target, $link);
	echo 'success';
});



// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
