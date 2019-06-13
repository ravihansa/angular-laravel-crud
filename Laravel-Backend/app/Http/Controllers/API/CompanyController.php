<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class CompanyController extends Controller
{

    public function saveCompanyData (Request $request){

        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->web_site = $request->input('webSite');
        $company->save();

        return response()->json([
            'status' =>true,
            'message' => 'sucess',            
        ], 200);
    }

    public function getCompanyData (Request $request, $id){

        $companyDetails = Company::where('id', $id)->first();
        if(isset($companyDetails)) {
            return response()->json([
                'status' =>true,
                'message' => 'sucess',
                'company'     => $companyDetails,
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t find a registered company',                
            ], 400);
        }
    }

    public function loadAllCompanies (Request $request){

        $allCompanies = Company::get();
        if(isset($allCompanies)) {
            return response()->json([
                'status' => true,
                'message' => 'sucess',
                'data'   => array(
                                'company'     => $allCompanies,
                            )
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t find a registered companies',                
            ], 400);
        }
    }

    public function updateCompanyData (Request $request){

        $newCompany = Company::where('id', $request->id)
                            ->update(['name' => $request->input('name'),
                                      'email' => $request->input('email'),
                                      'web_site' => $request->input('webSite')]);     
        if(isset($newCompany)) {
            return response()->json([
                'status' => true,
                'message' => 'Sucess',
                'isUpdated'     => $newCompany
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t update the company',                
            ], 400);
        }
    }

    public function deleteCompany (Request $request, $id){

        $deleteCompany = Company::where('id', $id)->delete();
        if(isset($deleteCompany)) {
            return response()->json([
                'status' => true,
                'message' => 'sucess',
                'isDeleted'     => $deleteCompany,
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t delete the company',               
            ], 400);
        }
    }

}
