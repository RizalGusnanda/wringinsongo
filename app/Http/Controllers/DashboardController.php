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
        $roleUser = Role::where('name', 'user')->first();
        $totalUsersWithRole = $roleUser ? $roleUser->users()->count() : 0;

        $totalTours = Tours::count();

        $totalTransactions = Carts::where('status', 'success')->count();

        $totalRevenue = Carts::where('status', 'success')->sum('total_price');

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

        return view('home', [
            'totalUsersWithRole' => $totalUsersWithRole,
            'totalTours' => $totalTours,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'topThreeTours' => $topThreeTours,
            'topThreeUsers' => $topThreeUsers,
            'monthlyLabels' => $monthlyLabels,
            'monthlyTicketsSold' => $monthlyTicketsSold,
        ]);
    }

}
