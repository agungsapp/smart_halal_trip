<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/home');
});


Route::get('home', App\Livewire\Pages\HomePage::class)->name('home');
Route::get('wisata', App\Livewire\Pages\WisataPage::class)->name('wisata');
Route::get('restoran', App\Livewire\Pages\RestoranPage::class)->name('restoran');
