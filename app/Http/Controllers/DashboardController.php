<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Tours;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $topThreeTours = Tours::withCount('tickets')->orderBy('tickets_count', 'desc')->take(3)->get();

    $topThreeUsers = User::select('users.id', DB::raw('MAX(users.name) as name'), DB::raw('COUNT(carts.id) as transactions_count'))
        ->join('tickets', 'users.id', '=', 'tickets.id_users')
        ->join('carts', 'tickets.id', '=', 'carts.id_ticket')
        ->where('carts.status', 'success')
        ->groupBy('users.id')
        ->orderByDesc('transactions_count')
        ->take(3)
        ->get();

    $monthlyLabels = [];
    $monthlyTicketsSold = [];

    $startMonth = Carbon::now()->startOfYear();
    $endMonth = Carbon::now()->endOfYear();

    while ($startMonth->lte($endMonth)) {
        $monthLabel = $startMonth->translatedFormat('F');
        $monthlyLabels[] = $monthLabel;

        $ticketsSold = DB::table('carts')
            ->join('tickets', 'carts.id_ticket', '=', 'tickets.id')
            ->where('carts.status', 'success')
            ->whereYear('carts.created_at', $startMonth->year)
            ->whereMonth('carts.created_at', $startMonth->month)
            ->sum('tickets.tickets_count');

        $monthlyTicketsSold[] = $ticketsSold;

        $startMonth->addMonth();
    }

    $latestTransactions = DB::table('carts')
        ->join('tickets', 'carts.id_ticket', '=', 'tickets.id')
        ->join('users', 'tickets.id_users', '=', 'users.id')
        ->join('tours', 'tickets.id_tours', '=', 'tours.id')
        ->select('users.name as user_name', 'tours.name as tour_name', 'tickets.date', 'carts.status')
        ->orderBy('carts.created_at', 'desc')
        ->take(3)
        ->get();

    return view('home', [
        'topThreeTours' => $topThreeTours,
        'monthlyLabels' => $monthlyLabels,
        'monthlyTicketsSold' => $monthlyTicketsSold,
        'latestTransactions' => $latestTransactions,
    ]);
}

}
