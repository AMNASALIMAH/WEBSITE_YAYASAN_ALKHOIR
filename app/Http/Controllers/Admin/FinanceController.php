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
        $income = FinanceIncome::with('user')->latest()->take(10)->get();
        $totalIncome = FinanceIncome::where('status', 'completed')->sum('amount');
        $pendingPayments = FinanceIncome::where('status', 'pending')->count();
        $totalTransactions = FinanceIncome::count();
        
        return view('admin.management.finance.finance', compact('income', 'totalIncome', 'pendingPayments', 'totalTransactions'));
    }

    public function getManagementFinancePemasukan()
    {
        $income = FinanceIncome::with('user')->latest()->paginate(15);
        return view('admin.management.finance.pemasukan', compact('income'));
    }

    public function getManagementFinancePengeluaran()
    {
        $expenses = FinanceExpense::with(['user', 'approver'])->latest()->paginate(15);
        return view('admin.management.finance.pengeluaran', compact('expenses'));
    }

    // Income CRUD
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

    // Expense CRUD
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
