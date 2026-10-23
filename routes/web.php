<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Bangladeshi Skincare Business Suite
|--------------------------------------------------------------------------
*/

// Public Frontend Pages
Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/features', [PublicPageController::class, 'features'])->name('features');
Route::get('/pricing', [PublicPageController::class, 'pricing'])->name('pricing');
Route::get('/skin-quiz', [PublicPageController::class, 'skinQuiz'])->name('skin-quiz');
Route::get('/shop', [PublicPageController::class, 'shop'])->name('shop');
Route::get('/landing/{slug}', [PublicPageController::class, 'landing'])->name('landing');
Route::get('/order-success/{orderNumber}', [PublicPageController::class, 'orderSuccess'])->name('order.success');
Route::get('/demo', [PublicPageController::class, 'demo'])->name('demo');
Route::get('/docs', [PublicPageController::class, 'docs'])->name('docs');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');

// E-commerce & Landing Page Checkout Actions
Route::post('/quick-checkout', [StoreController::class, 'quickCheckout'])->name('order.quick-checkout');

// Instant 1-Click Demo Login
Route::get('/demo-login/{role}', [StoreController::class, 'demoLogin'])->name('demo.login');

// Unicode Bengali PDF Generation & Thermal POS Receipts
Route::get('/pdf/order/{order}/invoice', [PdfController::class, 'invoice'])->name('order.pdf.invoice');
Route::get('/pdf/order/{order}/receipt', [PdfController::class, 'receipt'])->name('order.pdf.receipt');
Route::get('/pdf/transfer/{transfer}/challan', [PdfController::class, 'challan'])->name('transfer.pdf.challan');
