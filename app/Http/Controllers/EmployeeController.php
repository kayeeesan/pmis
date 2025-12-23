<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $employees = Employee::paginate(10);

            return response()->json([
                'success' => true,
                'data' => $employees->items(),
                'meta' => [
                    'current_page' => $employees->currentPage(),
                    'last_page' => $employees->lastPage(),
                    'per_page' => $employees->perPage(),
                    'total' => $employees->total(),
                    'from' => $employees->firstItem(),
                    'to' => $employees->lastItem(),
                ],
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

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'message' => 'Employee has been successfully deleted.'
        ]);
    }

}
