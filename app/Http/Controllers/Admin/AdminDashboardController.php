<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KirimPesan;
use App\Models\News;
use App\Models\FinanceExpense;
use App\Models\FinanceIncome;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Student;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        $pesan = KirimPesan::all();
        $news = News::all();
        $financeEx = FinanceExpense::all();
        $financeIn = FinanceIncome::all();
        $teacher = Teacher::all();
        $user = User::all();
        $student = Student::all();
        
        // Calculate statistics for monitoring
        $totalIncome = $financeIn->sum('amount');
        $totalExpense = $financeEx->sum('amount');
        $netIncome = $totalIncome - $totalExpense;
        $unreadMessages = $pesan->where('is_read', false)->count();
        $recentNews = $news->take(5)->sortByDesc('created_at');
        $recentExpenses = $financeEx->take(5)->sortByDesc('created_at');
        $recentIncome = $financeIn->take(5)->sortByDesc('created_at');
        
        // Monthly data for charts
        $monthlyIncome = $this->getMonthlyData($financeIn, 'amount');
        $monthlyExpense = $this->getMonthlyData($financeEx, 'amount');
        
        return view('dashboard', compact(
            'pesan', 'news', 'financeEx', 'financeIn', 'teacher', 'user', 'student',
            'totalIncome', 'totalExpense', 'netIncome', 'unreadMessages',
            'recentNews', 'recentExpenses', 'recentIncome',
            'monthlyIncome', 'monthlyExpense'
        ));
    }
    
    private function getMonthlyData($collection, $field)
    {
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M');
            $monthlyData[$month] = $collection->filter(function ($item) use ($i) {
                return $item->created_at->month === now()->subMonths($i)->month;
            })->sum($field);
        }
        return $monthlyData;
    }
}
