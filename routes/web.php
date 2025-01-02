<?php

use App\Http\Controllers\DonateController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('welcome'); // Ana sayfa

    // Oturum açma ve kaydolma rotaları
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/kampanyalar', [CampaignController::class, 'index'])->name('campaigns');
    Route::get('/kampanyalar/{id}', [CampaignController::class, 'show'])->name('campaigns.show');

    Route::post('/kampanya', [CampaignController::class, 'donate'])->name('campaigns.donate'); // Bağış işlemi

    Route::middleware(['auth'])->group(function () {
        // Bildirimleri listeleme sayfası
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

        // Bildirimi okundu olarak işaretle
        Route::get('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

        // Kullanıcı profilini görüntüleme ve düzenleme
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');

        // Profil düzenleme sayfası
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');

        // Profil güncelleme işlemi
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');

        // Kullanıcı bağışlarını listeleme
        Route::get('/donations', [DonateController::class, 'index'])->name('donations');
        Route::post('/donations/{donationId}/refund', [DonateController::class, 'refund'])->name('donations.refund');
    });

    // Diğer işlemler
    Route::post('/campaigns/{id}/report', [ReportController::class, 'store'])->name('campaigns.report');
    Route::get('/hakkimizda', [CampaignController::class, 'about'])->name('about');
    Route::post('/campaigns/{id}/add-comment', [CampaignController::class, 'addComment'])->name('campaigns.addComment');
    Route::post('/campaigns/{campaignId}/feedback', [FeedbackController::class, 'storeFeedback'])->name('feedback.store');
    Route::middleware(['auth', 'admin'])->group(function () {
        // Yeni kampanya ekleme
        Route::get('/admin/kampanya-ekle', [CampaignController::class, 'create'])->name('campaigns.create');
        Route::post('/admin/kampanya-ekle', [CampaignController::class, 'store'])->name('campaigns.store');

        // Kampanya düzenleme
        Route::get('/admin/kampanya-duzenle/{id}', [CampaignController::class, 'edit'])->name('campaigns.edit');
        Route::put('/admin/kampanya-duzenle/{id}', [CampaignController::class, 'update'])->name('campaigns.update');

        // Kampanya silme
        Route::delete('/admin/kampanya-sil/{id}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
    });
});
