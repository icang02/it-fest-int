<?php

use App\Http\Controllers\ResetPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Dashboard\Admin\User\Edit as UserEdit;
use App\Http\Livewire\Dashboard\Admin\User\Index as UserIndex;
use App\Http\Livewire\Dashboard\Event\Event;
use App\Http\Livewire\Dashboard\Event\EventDetail;
use App\Http\Livewire\Dashboard\Event\EventOrder;
use App\Http\Livewire\Dashboard\Event\EventOrderDetail;
use App\Http\Livewire\Dashboard\Event\PengelolaAdd;
use App\Http\Livewire\Dashboard\Event\PengelolaDetail;
use App\Http\Livewire\Dashboard\Event\PengelolaEdit;
use App\Http\Livewire\Dashboard\Event\PengelolaIndex;
use App\Http\Livewire\Home\Wisata\Index as WisataIndex;
use App\Http\Livewire\Dashboard\Index;
use App\Http\Livewire\Dashboard\Order;
use App\Http\Livewire\Dashboard\OrderDetail;
use App\Http\Livewire\Dashboard\OrderList;
use App\Http\Livewire\Dashboard\Profile;
use App\Http\Livewire\Dashboard\Wisata;
use App\Http\Livewire\Dashboard\Wisata\WisataAdd;
use App\Http\Livewire\Dashboard\Wisata\WisataEdit;
use App\Http\Livewire\Dashboard\WisataDetail;
use App\Http\Livewire\Home\Event\Detail as DetailEvent;
use App\Http\Livewire\Home\Event\Index as EventIndex;
use App\Http\Livewire\Home\Index as HomeIndex;
use App\Http\Livewire\Home\Wisata\Detail as DetailWisata;
use App\Http\Livewire\Home\Wisata\OrderPage;
use App\Http\Livewire\Home\Event\OrderPage as OrderEventPage;
use App\Http\Livewire\Home\Order\Index as OrderIndex;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/seed', function () {
  Artisan::call('migrate:fresh --seed');
  return redirect('/dashboard');
});

Route::post('/invoice/{id}/{jenis}', function ($id, $jenis) {

  if ($jenis == 'wisata')
    $order = App\Models\UserOrder::find($id);
  else
    $order = App\Models\UserEventOrder::find($id);

  $pdf = Pdf::loadView('invoice', [
    'order' => $order,
    'jenis' => $jenis,
  ]);
  return $pdf->download("invoice-$order->no_order-$jenis.pdf");
});

// Route::get('/coba/{id}', function ($id) {
//   $order = App\Models\UserOrder::find($id);
//   return view('invoice', [
//     'order' => $order,
//   ]);
// });


Route::get('/semua-wisata', WisataIndex::class);
Route::get('/semua-wisata/{wisataId}', DetailWisata::class);
Route::get('/semua-wisata/order/{wisataId}', OrderPage::class)->can('pengunjung');

Route::get('/semua-event', EventIndex::class);
Route::get('/semua-event/{eventId}', DetailEvent::class);
Route::get('/semua-event/order/{eventId}', OrderEventPage::class)->can('pengunjung');

// Home Pengunjung - Halaman Order
Route::get('/semua-order', OrderIndex::class)->can('pengunjung');

// Dashboard Pengelola - Halaman Event
Route::get('/pengelola-event', PengelolaIndex::class);
Route::get('/pengelola-event/add', PengelolaAdd::class);
Route::get('/pengelola-event/{eventId}', PengelolaDetail::class);
Route::get('/pengelola-event/edit/{eventId}', PengelolaEdit::class);




// ===============================================================

Route::get('/', HomeIndex::class)->name('home');
Route::get('dashboard', Index::class)->name('dashboard')->middleware('auth');

Route::get('profile', Profile::class)->name('profile')->middleware('auth');

// Wisata
Route::get('wisata', Wisata::class)->middleware('auth')->name('wisata');
Route::get('wisata/{id}', WisataDetail::class)->middleware('auth')->name('wisata.detail')->can('pengunjung');
Route::get('wisata/order/{id}', Order::class)->middleware('auth')->can('pengunjung');

Route::get('wisata-add', WisataAdd::class)->middleware('auth')->name('wisata.add')->can('pengelola');
Route::get('wisata-edit/{id}', WisataEdit::class)->middleware('auth')->name('wisata.edit')->can('pengelola');

// Event
Route::get('event', Event::class)->middleware('auth')->name('event');
Route::get('event/{id}', EventDetail::class)->middleware('auth');
Route::get('event/order/{id}', EventOrder::class)->middleware('auth')->can('pengunjung');
Route::get('order/event/{orderId}', EventOrderDetail::class)->middleware('auth');

Route::get('order', OrderList::class)->middleware('auth')->name('orderList');
Route::get('order/{orderId}', OrderDetail::class)->middleware('auth');
Route::get('order-success', function () {
  return view('page-order-success', [
    'title' => 'Order Success',
  ]);
})->can('pengunjung')->middleware('auth')->name('order.success');

Route::get('login', Login::class)->name('login')->middleware('guest');
Route::get('register', Register::class)->name('register')->middleware('guest');

// Forgot Password
// Route::get('forgot-password', ForgetPassword::class)->name('password.request')->middleware('guest');
Route::get('forgot-password', [ResetPassword::class, 'index'])->name('password.request')->middleware('guest');
Route::post('forgot-password', [ResetPassword::class, 'sendLink']);

Route::get('/reset-password/{token}', [ResetPassword::class, 'showForm'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [ResetPassword::class, 'resetPassword'])->middleware('guest')->name('password.update');

Route::get('{role:name}', UserIndex::class)->middleware('auth')->can('admin');
Route::get('{role:name}/{user:username}/edit', UserEdit::class)->middleware('auth')->can('admin');
