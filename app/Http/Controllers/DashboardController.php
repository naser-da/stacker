<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get monthly sales data for the current year
        $monthlySales = Sale::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total_amount) as total_amount')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('year', 'month')
        ->orderBy('month')
        ->get()
        ->keyBy('month');

        // Initialize data for all months
        $labels = [];
        $amountData = [];
        
        // Get current year
        $currentYear = now()->year;

        // Fill in data for all months
        for ($month = 1; $month <= 12; $month++) {
            $date = \DateTime::createFromFormat('Y-m', $currentYear . '-' . $month);
            $labels[] = $date->format('M');
            $amountData[] = $monthlySales->get($month, (object)['total_amount' => 0])->total_amount;
        }

        // Get top customers data
        $period = $request->get('customer_period', 'year'); // Default to year
        $query = Sale::select(
            'customers.name',
            DB::raw('SUM(sales.total_amount) as total_amount')
        )
        ->join('customers', 'sales.customer_id', '=', 'customers.id')
        ->groupBy('customers.id', 'customers.name')
        ->orderBy('total_amount', 'desc')
        ->limit(5);

        // Apply period filter
        switch ($period) {
            case 'month':
                $query->whereMonth('sales.created_at', now()->month)
                      ->whereYear('sales.created_at', now()->year);
                break;
            case 'quarter':
                $query->whereYear('sales.created_at', now()->year)
                      ->whereRaw('QUARTER(sales.created_at) = QUARTER(NOW())');
                break;
            case 'year':
            default:
                $query->whereYear('sales.created_at', now()->year);
                break;
        }

        $topCustomers = $query->get();

        // Format customer data for pie chart
        $customerLabels = $topCustomers->pluck('name');
        $customerData = $topCustomers->pluck('total_amount');

        return view('dashboard', compact('labels', 'amountData', 'customerLabels', 'customerData', 'period'));
    }
} 