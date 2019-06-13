<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;

class EmployeeController extends Controller
{

    public function saveEmployeeData (Request $request){

        $employee = new Employee();
        $employee->company_id = $request->input('companyId');
        $employee->first_name = $request->input('firstName');
        $employee->last_name = $request->input('lastName');
        $employee->email = $request->input('email');
        $employee->phone_number = $request->input('phoneNo');
        $employee->save();

        return response()->json([
            'status' =>true,
            'message' => 'sucess',            
        ], 200);
    }

    public function getEmployeeData (Request $request, $id){

        $employeeDetails = Employee::where('id', $id)->first();
        if(isset($employeeDetails)) {
            return response()->json([
                'status' =>true,
                'message' => 'sucess',
                'employee'     => $employeeDetails,
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t find a registered employee',                
            ], 400);
        }
    }

    public function loadAllEmployees (Request $request, $id){

        $companyEmployees = Employee::where('company_id', $id)->get();
        if(isset($companyEmployees)) {
            return response()->json([
                'status' => true,
                'message' => 'sucess',
                'data'   => array(
                                'employee'     => $companyEmployees,
                            )
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t find a registered employees',                
            ], 400);
        }
    }

    public function updateEmployeeData (Request $request, $id){

        $newEmployee = Employee::where('id', $id)
                              ->update(['first_name' => $request->input('firstName'),
                                        'last_name' => $request->input('lastName'),
                                        'email' => $request->input('email'),
                                        'phone_number' => $request->input('phoneNo')]);     
        if(isset($newEmployee)) {
            return response()->json([
                'status' => true,
                'message' => 'Sucess',
                'isUpdated'     => $newEmployee
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t update the employee',                
            ], 400);
        }
    }

    public function deleteEmployee (Request $request, $id){

        $deleteEmployee = Employee::where('id', $id)->delete();
        if(isset($deleteEmployee)) {
            return response()->json([
                'status' => true,
                'message' => 'sucess',
                'isDeleted'     => $deleteEmployee,
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t delete the employee',               
            ], 400);
        }
    }

}
