<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     return view("welcome");
   //  return redirect('/admin/login');
});

Route::get('/service-invoice/create', [App\Http\Controllers\InvoiceController::class, 'create'])->name('service.invoice.create');
Route::post('/service-invoice', [App\Http\Controllers\InvoiceController::class, 'store']);
Route::get('/service-invoice/{order}/print', [App\Http\Controllers\InvoiceController::class, 'show'])->name('print.order');

Route::get('/medical-invoice/create', [App\Http\Controllers\MedicalInvoiceController::class, 'create'])->name('medical.invoice.create');
Route::post('/medical-invoice', [App\Http\Controllers\MedicalInvoiceController::class, 'store']);
Route::get('/medical-invoice/{order}/print', [App\Http\Controllers\MedicalInvoiceController::class, 'show'])->name('medical.print.order');

