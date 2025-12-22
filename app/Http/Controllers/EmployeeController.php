<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::limit(10)->get();

            return response()->json([
                'success' => true,
                'data' => $employees,
                'count' => $employees->count(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error connecting to legacy DB: ' . $e->getMessage(),
            ], 500);
            }
    }

    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            if ($employee) {
                return response()->json([
                    'success' => true,
                    'data' => $employee,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving employee: ' . $e->getMessage(),
            ], 500);
        }
    }

    
}
