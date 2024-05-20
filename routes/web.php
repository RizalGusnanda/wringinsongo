<?php

use App\Helper\Midtrans;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\MenuWisataController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\ExportPermissionController;
use App\Http\Controllers\RoleAndPermission\ExportRoleController;
use App\Http\Controllers\RoleAndPermission\ImportPermissionController;
use App\Http\Controllers\RoleAndPermission\ImportRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ReservasiWisataController;
use App\Http\Controllers\PendapatanWisataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\DetailWisataController;
use App\Http\Controllers\KonfirmasiTiketController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ReservasiUserController;
use App\Http\Controllers\TestimonisController;
use App\Http\Controllers\ToursVirtualController;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Models\Category;

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

Route::get('/', [LandingController::class, 'show']);

Route::middleware('not_super_admin')->group(function () {
    Route::get('/wisata', [ToursController::class, 'index']);
    Route::get('/detail-wisata/{id}', [ToursController::class, 'detail']);

    Route::get('/contact-us', [ContactController::class, 'index']);

    Route::post('/contact-us/send', [ContactController::class, 'send']);

    Route::get('/virtual-tour', [ToursVirtualController::class, 'index']);

    Route::get('/virtual-tour/{id}', [ToursVirtualController::class, 'show']);
});

Route::middleware('guest')->group(function () {

    Route::get('/log-in', function () {
        return view('auth/login');
    });

    Route::get('/about-us', function () {
        return view('layout-users/about');
    });
});

Route::post('/reservation/{tour_id}', [ToursController::class, 'storeReservation'])
    ->middleware(['auth', 'verified', 'profile.complete'])
    ->name('reservation.store');

Route::group(['middleware' => ['auth', 'verified', 'role:user']], function () {

    Route::get('/landing', [LandingController::class, 'show']);

    Route::get('/profile-user', [ProfilesController::class, 'profile'])->name('profile.index');
    Route::post('/profile-user', [ProfilesController::class, 'update'])->name('profile.update');

    Route::get('/reservasi-user', [ReservasiUserController::class, 'index']);

    Route::get('/transaksi-user/{id}', [CartController::class, 'show'])->name('cart.show');
    Route::post('/transaksi-user', [CartController::class, 'store'])->name('cart.store');
    Route::get('/transaksi-user', [CartController::class, 'index'])->name('transaksi.user');

    Route::get('/testimoni', [TestimonisController::class, 'index']);
    Route::post('/testimoni/store', [TestimonisController::class, 'store']);

    Route::post('/payment/initiate', [MidtransController::class, 'initiatePayment'])->name('payment.initiate');
    Route::post('/payment/callback', [MidtransController::class, 'paymentCallback'])->name('payment.callback');
});

Route::group(['middleware' => ['auth', 'verified', 'role:super-admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/profileAdmin', [ProfileAdminController::class, 'index']);
    Route::post('/profileAdmin/update', [ProfileAdminController::class, 'update'])->name('profileadmin.update');

    Route::prefix('user-management')->group(function () {
        Route::resource('user', UserController::class);
        Route::post('import', [UserController::class, 'import'])->name('user.import');
        Route::get('export', [UserController::class, 'export'])->name('user.export');
        Route::get('demo', DemoController::class)->name('user.demo');
    });

    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::resource('menu-item', MenuItemController::class);
    });

    Route::prefix('wisata-management')->group(function () {
        Route::resource('menu-wisata', MenuWisataController::class);
        Route::post('menu-wisata/delete-image', [MenuWisataController::class, 'deleteImage'])->name('menu-wisata.delete-image');
        Route::post('menu-wisata/delete-virtual-tour-image', [MenuWisataController::class, 'deleteVirtualTourImage'])->name('menu-wisata.delete-virtual-tour-image');
        Route::post('menu-wisata/import', [MenuWisataController::class, 'import'])->name('menu-wisata.import');
        Route::post('/check-tour-name', [MenuWisataController::class, 'checkTourName'])->name('check-tour-name');
        Route::post('/check-maps', [MenuWisataController::class, 'checkMaps'])->name('check-maps');
        Route::get('pendapatan-wisata', [PendapatanWisataController::class, 'index'])->name('pendapatan-wisata.index');
        Route::get('/pendapatan-wisata/export', [PendapatanWisataController::class, 'export'])->name('pendapatan-wisata.export');
    });

    Route::prefix('tiket-management')->group(function () {
        Route::resource('konfirmasi-tiket', KonfirmasiTiketController::class);
        Route::patch('/konfirmasi-tiket/{id}/confirm', [KonfirmasiTiketController::class, 'confirm'])->name('konfirmasi-tiket.confirm');
        Route::resource('reservasi-wisata', ReservasiWisataController::class);
    });

    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::get('role/export', ExportRoleController::class)->name('role.export');
        Route::post('role/import', ImportRoleController::class)->name('role.import');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::get('permission/export', ExportPermissionController::class)->name('permission.export');
        Route::post('permission/import', ImportPermissionController::class)->name('permission.import');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');

        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assing-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
    });
});
