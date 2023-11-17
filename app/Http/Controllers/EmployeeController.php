<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $resources = Employee::all();

        if ($resources->isEmpty()) {
            return response()->json([
                'message' => 'Data is empty'
            ], 200);
        }
    
        return response()->json([
            'message' => 'Get All Resource',
            'data' => $resources
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ], [
            'required' => 'Field :attribute harus diisi.',
            'email' => 'Field :attribute harus berupa alamat email yang valid.',
        ]);
    
        try {
            $resource = Employee::create($validatedData);
    
            return response()->json([
                'message' => 'Resource is added successfully',
                'data' => $resource
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data'
            ], 400);
        }
    }

    public function show($id)
    {
        $resource = Employee::find($id);
    
        if ($resource) {
            return response()->json([
                'message' => 'Get Detail Resource',
                'data' => $resource
            ], 200);
        } else {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $resource = Employee::find($id);
    
        if (!$resource) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }
    
        $resource->update($request->all());
    
        return response()->json([
            'message' => 'Resource is updated successfully',
            'data' => $resource
        ], 200);
    }

    public function destroy($id)
    {
        $resource = Employee::find($id);
    
        if (!$resource) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }
    
        $resource->delete();
    
        return response()->json([
            'message' => 'Resource is deleted successfully'
        ], 200);
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('name');

    $resources = Employee::where('name', 'like', "%$searchTerm%")->get();

    if ($resources->isEmpty()) {
        return response()->json([
            'message' => 'Resource not found'
        ], 404);
    }

    return response()->json([
        'message' => 'Get searched resource',
        'data' => $resources
    ], 200);
}

public function getActiveResources()
{
    $activeEmployees = Employee::whereHas('details', function ($query) {
        $query->where('status', 'active');
    })->get();

    $totalActiveEmployees = $activeEmployees->count();

    if ($totalActiveEmployees === 0) {
        return response()->json([
            'message' => 'No active employees found',
            'total' => 0,
            'data' => []
        ], 404);
    }

    return response()->json([
        'message' => 'Get active employees',
        'total' => $totalActiveEmployees,
        'data' => $activeEmployees
    ], 200);
}

public function getInactiveResources()
{
    $inactiveEmployees = Employee::whereHas('details', function ($query) {
        $query->where('status', 'inactive');
    })->get();

    $totalInactiveEmployees = $inactiveEmployees->count();

    if ($totalInactiveEmployees === 0) {
        return response()->json([
            'message' => 'No inactive employees found',
            'total' => 0,
            'data' => []
        ], 404);
    }

    return response()->json([
        'message' => 'Get inactive employees',
        'total' => $totalInactiveEmployees,
        'data' => $inactiveEmployees
    ], 200);
}

public function getTerminatedResources()
{
    $terminatedEmployees = Employee::whereHas('details', function ($query) {
        $query->where('status', 'terminated');
    })->get();

    $totalTerminatedEmployees = $terminatedEmployees->count();

    if ($totalTerminatedEmployees === 0) {
        return response()->json([
            'message' => 'No terminated employees found',
            'total' => 0,
            'data' => []
        ], 404);
    }

    return response()->json([
        'message' => 'Get terminated employees',
        'total' => $totalTerminatedEmployees,
        'data' => $terminatedEmployees
    ], 200);
}
}
