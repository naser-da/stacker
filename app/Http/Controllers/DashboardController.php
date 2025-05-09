<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now());

        // Get top customers for the selected date range
        $topCustomers = Customer::withCount(['sales' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }])
        ->withSum(['sales' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }], 'total_amount')
        ->orderByDesc('sales_sum_total_amount')
        ->take(5)
        ->get();

        // Prepare data for the customers chart
        $customerLabels = $topCustomers->pluck('name');
        $customerData = $topCustomers->pluck('sales_sum_total_amount');

        // Get monthly revenue data for the current year
        $monthlyRevenue = Sale::whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $monthlyRevenue->map(function ($item) {
            return date('F', mktime(0, 0, 0, $item->month, 1));
        });

        $amountData = $monthlyRevenue->pluck('total');

        return view('dashboard', compact('customerLabels', 'customerData', 'labels', 'amountData'));
    }
} 