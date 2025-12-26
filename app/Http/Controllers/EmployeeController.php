<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Employee as ResourcesEmployee;
use App\Models\Employee;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $employees = Employee::paginate(10);

            return response()->json([
                'success' => true,
                'data' => ResourcesEmployee::collection($employees),
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



    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $employee->update($request->only([
                'FirstName',
                'LastName',
                'MiddleName',
                'Address',
                'PhoneNo',
                'Status',
            ]));

            return response()->json([
            'success' => true,
            'message' => 'Employee has been successfully updated.',
            'data' => new ResourcesEmployee($employee),
        ]);
        } catch (\Exception $e) {
            return response()->json([
            'success' => false,
            'message' => $e->getMessage()
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
