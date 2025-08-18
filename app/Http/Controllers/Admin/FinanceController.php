<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FinanceIncomeRequest;
use App\Http\Requests\FinanceExpenseRequest;
use App\Http\Requests\FinanceSppSettingRequest;
use App\Models\FinanceIncome;
use App\Models\FinanceExpense;
use App\Models\FinanceSppSetting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FinanceController extends Controller
{
    public function getManagementFinanceContent()
    {
        $income = FinanceIncome::latest()->take(10)->get();
        $totalIncome = FinanceIncome::where('status', 'completed')->sum('amount');
        $pendingPayments = FinanceIncome::where('status', 'pending')->count();
        $totalTransactions = FinanceIncome::count();
        
        return view('admin.management.finance.finance', compact('income', 'totalIncome', 'pendingPayments', 'totalTransactions'));
    }

    public function getManagementFinancePemasukan()
    {
        $income = FinanceIncome::latest()->paginate(15);
        
        // Check if this is an AJAX request for content
        if (request()->ajax() && request()->is('*/content')) {
            return view('admin.management.finance.pemasukan', compact('income'))->render();
        }
        
        return view('admin.management.finance.pemasukan', compact('income'));
    }

    public function getManagementFinancePengeluaran()
    {
        $expenses = FinanceExpense::latest()->paginate(15);
        
        // Check if this is an AJAX request for content
        if (request()->ajax() && request()->is('*/content')) {
            return view('admin.management.finance.pengeluaran', compact('expenses'))->render();
        }
        
        return view('admin.management.finance.pengeluaran', compact('expenses'));
    }

    // Simple Laravel CRUD for Income (without JavaScript)
    public function createIncome()
    {
        return view('admin.management.finance.income.create');
    }

    public function storeIncomeSimple(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
            'receipt_number' => 'required|string|max:255',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        
        FinanceIncome::create($data);
        
        return redirect()->route('admin.management.finance.pemasukan')
            ->with('success', 'Data pemasukan berhasil disimpan');
    }

    public function editIncome(FinanceIncome $income)
    {
        return view('admin.management.finance.income.edit', compact('income'));
    }

    public function updateIncomeSimple(Request $request, FinanceIncome $income)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
            'receipt_number' => 'required|string|max:255',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $income->update($request->all());
        
        return redirect()->route('admin.management.finance.pemasukan')
            ->with('success', 'Data pemasukan berhasil diperbarui');
    }

    public function showIncomeSimple(FinanceIncome $income)
    {
        return view('admin.management.finance.income.show', compact('income'));
    }

    public function deleteIncomeSimple(FinanceIncome $income)
    {
        $income->delete();
        
        return redirect()->route('admin.management.finance.pemasukan')
            ->with('success', 'Data pemasukan berhasil dihapus');
    }

    // Simple Laravel CRUD for Expense (without JavaScript)
    public function createExpense()
    {
        return view('admin.management.finance.expense.create');
    }

    public function storeExpenseSimple(Request $request)
    {
        $request->validate([
            'expense_title' => 'required|string|max:255',
            'category' => 'required|in:operasional,gaji,utilitas,maintenance,pendidikan,lainnya',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'receipt_number' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'description' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['category'] = strtolower($data['category']);
        $data['created_by'] = auth()->user()->name;
        
        FinanceExpense::create($data);
        
        return redirect()->route('admin.management.finance.pengeluaran')
            ->with('success', 'Data pengeluaran berhasil disimpan');
    }

    public function editExpense(FinanceExpense $expense)
    {
        return view('admin.management.finance.expense.edit', compact('expense'));
    }

    public function updateExpenseSimple(Request $request, FinanceExpense $expense)
    {
        $request->validate([
            'expense_title' => 'required|string|max:255',
            'category' => 'required|in:operasional,gaji,utilitas,maintenance,pendidikan,lainnya',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'receipt_number' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'description' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['category'] = strtolower($data['category']);

        $expense->update($data);
        
        return redirect()->route('admin.management.finance.pengeluaran')
            ->with('success', 'Data pengeluaran berhasil diperbarui');
    }

    public function showExpenseSimple(FinanceExpense $expense)
    {
        return view('admin.management.finance.expense.show', compact('expense'));
    }

    public function deleteExpenseSimple(FinanceExpense $expense)
    {
        $expense->delete();
        
        return redirect()->route('admin.management.finance.pengeluaran')
            ->with('success', 'Data pengeluaran berhasil dihapus');
    }

    // Income CRUD (AJAX - existing)
    public function showIncome(FinanceIncome $income): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $income
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeIncome(FinanceIncomeRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->name;
            
            $income = FinanceIncome::create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Data pemasukan berhasil disimpan',
                'data' => $income
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateIncome(FinanceIncomeRequest $request, FinanceIncome $income): JsonResponse
    {
        try {
            $data = $request->validated();
            $income->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Data pemasukan berhasil diperbarui',
                'data' => $income
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteIncome(FinanceIncome $income): JsonResponse
    {
        try {
            $income->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data pemasukan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Expense CRUD (AJAX - existing)
    public function showExpense(FinanceExpense $expense): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $expense
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeExpense(FinanceExpenseRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->name;
            
            $expense = FinanceExpense::create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Data pengeluaran berhasil disimpan',
                'data' => $expense
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateExpense(FinanceExpenseRequest $request, FinanceExpense $expense): JsonResponse
    {
        try {
            $data = $request->validated();
            $expense->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Data pengeluaran berhasil diperbarui',
                'data' => $expense
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteExpense(FinanceExpense $expense): JsonResponse
    {
        try {
            $expense->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data pengeluaran berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approveExpense(Request $request, FinanceExpense $expense): JsonResponse
    {
        try {
            $expense->update([
                'status' => 'approved',
                'approved_by' => auth()->user()->name
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Pengeluaran berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // SPP Settings CRUD
    public function getSppSettings(): JsonResponse
    {
        try {
            $settings = FinanceSppSetting::where('is_active', true)->get();
            
            return response()->json([
                'success' => true,
                'data' => $settings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeSppSetting(FinanceSppSettingRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->name;
            
            $setting = FinanceSppSetting::create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Pengaturan SPP berhasil disimpan',
                'data' => $setting
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateSppSetting(FinanceSppSettingRequest $request, FinanceSppSetting $setting): JsonResponse
    {
        try {
            $data = $request->validated();
            $setting->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Pengaturan SPP berhasil diperbarui',
                'data' => $setting
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteSppSetting(FinanceSppSetting $setting): JsonResponse
    {
        try {
            $setting->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Pengaturan SPP berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Dashboard Statistics
    public function getFinanceStats(): JsonResponse
    {
        try {
            $currentMonth = now()->format('Y-m');
            $lastMonth = now()->subMonth()->format('Y-m');
            
            $currentMonthIncome = FinanceIncome::where('status', 'completed')
                ->whereRaw("DATE_FORMAT(payment_date, '%Y-%m') = ?", [$currentMonth])
                ->sum('amount');
                
            $lastMonthIncome = FinanceIncome::where('status', 'completed')
                ->whereRaw("DATE_FORMAT(payment_date, '%Y-%m') = ?", [$lastMonth])
                ->sum('amount');
                
            $pendingAmount = FinanceIncome::where('status', 'pending')->sum('amount');
            $totalExpenses = FinanceExpense::where('status', 'approved')->sum('amount');
            
            $growthPercentage = $lastMonthIncome > 0 ? 
                (($currentMonthIncome - $lastMonthIncome) / $lastMonthIncome) * 100 : 0;
            
            return response()->json([
                'success' => true,
                'data' => [
                    'current_month_income' => $currentMonthIncome,
                    'last_month_income' => $lastMonthIncome,
                    'growth_percentage' => round($growthPercentage, 1),
                    'pending_amount' => $pendingAmount,
                    'total_expenses' => $totalExpenses,
                    'net_income' => $currentMonthIncome - $totalExpenses
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
