<?php

use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollmentController;
use App\Http\Controllers\Admin\TrainingController as AdminTrainingController;
use App\Http\Controllers\Admin\TrainingSessionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\BlogController as PublicBlogController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\LocaleController;
use App\Http\Controllers\Public\TrainingController as PublicTrainingController;
use App\Models\BlogPost;
use App\Models\Training;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $locale = session('locale', 'fr');

    return redirect()->route('public.home', ['locale' => $locale]);
});

Route::get('/sitemap.xml', function () {
    $trainings = Training::published()->get();
    $posts = BlogPost::published()->get();

    return response()->view('public.sitemap', compact('trainings', 'posts'))->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nSitemap: ".route('sitemap'), 200, [
        'Content-Type' => 'text/plain',
    ]);
});

Route::post('/locale/{locale}', [LocaleController::class, 'update'])->name('locale.update');

Route::prefix('{locale}')->where(['locale' => 'fr|en'])->group(function () {
    Route::get('/', HomeController::class)->name('public.home');

    Route::get('/formations', [PublicTrainingController::class, 'index'])->name('public.trainings.index.fr');
    Route::get('/formations/{slug}', [PublicTrainingController::class, 'show'])->name('public.trainings.show.fr');
    Route::get('/formations/{slug}/sessions', [PublicTrainingController::class, 'sessions'])->name('public.trainings.sessions.fr');

    Route::get('/trainings', [PublicTrainingController::class, 'index'])->name('public.trainings.index.en');
    Route::get('/trainings/{slug}', [PublicTrainingController::class, 'show'])->name('public.trainings.show.en');
    Route::get('/trainings/{slug}/sessions', [PublicTrainingController::class, 'sessions'])->name('public.trainings.sessions.en');

    Route::get('/blog', [PublicBlogController::class, 'index'])->name('public.blog.index');
    Route::get('/blog/{slug}', [PublicBlogController::class, 'show'])->name('public.blog.show');

    Route::get('/contact', [ContactController::class, 'create'])->name('public.contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('public.contact.store');
});

Route::middleware(['auth', 'verified', 'active', 'track.activity'])->group(function () {
    Route::post('/sessions/{session}/enroll', [PublicTrainingController::class, 'enroll'])->name('public.enrollments.store');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('users', UserController::class)->middleware('permission:manage users')->except(['show']);
        Route::resource('categories', CategoryController::class)->middleware('permission:manage categories')->except(['show']);
        Route::resource('trainings', AdminTrainingController::class)->middleware('permission:manage trainings')->except(['show']);
        Route::resource('sessions', TrainingSessionController::class)->middleware('permission:manage sessions')->parameters(['sessions' => 'session'])->except(['show']);
        Route::resource('enrollments', AdminEnrollmentController::class)->middleware('permission:manage enrollments')->parameters(['enrollments' => 'enrollment'])->except(['show']);
        Route::post('enrollments/secure/{encryptedId}/{status}', [AdminEnrollmentController::class, 'secureStatus'])
            ->middleware('permission:manage enrollments')
            ->name('enrollments.secure-status');
        Route::resource('posts', BlogPostController::class)->middleware('permission:manage blog')->parameters(['posts' => 'post'])->except(['show']);
        Route::resource('messages', ContactMessageController::class)->middleware('permission:view reports')->only(['index', 'show', 'destroy'])->parameters(['messages' => 'message']);
    });
});

require __DIR__.'/auth.php';
