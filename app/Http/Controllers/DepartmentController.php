<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\Department as ResourcesDepartment;
use App\Models\Department;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $departments = Department::where('name', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $departments = Department::paginate(10);
        }

        return ResourcesDepartment::collection($departments);
    }


    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department();
            $department->name = ucwords($request->name);
            $department->code = Str::upper($request->code);
            $department->save();

            return response()->json(['message' => 'Department has been successfully saved.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function update($uuid, DepartmentRequest $request)
    {
        try {
            $department = Department::findOrFail($uuid);
            $department->name = ucwords($request->name);
            $department->code = Str::upper($request->code);
            $department->update();

            return response()->json(['message' => 'Department has been successfully updated.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function destroy($uuid)
    {
        Department::findOrFail($uuid)->delete();
        return response()->json(['message' => 'Department has been successfully deleted.']);
    }
}
