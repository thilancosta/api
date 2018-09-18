<?php

namespace App\Http\Controllers;


use App\Addresse;
use App\Company;
use App\Company_Members;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewform(  ) {

		return view( 'companyidinsert' );
	}

    public function getcompanydetails( Request $request ) {
        $id = $request->input( 'company_id' );
        $company = Company::where( 'id',$id )->first();
        $companydirectors = Company_Members::where( 'company_id',$id )->where('designation_type',69)->get();
        $addressarrays=[];
        foreach ($companydirectors as $companydirector){
            $addresse = Addresse::where( 'id',$companydirector->address_id )->first();
            $addressarrays[$companydirector->address_id] = $addresse;
        }




        return view( 'companyidinsert', [ 'company' => $company,'companydirectors' => $companydirectors ,'addressarrays' => $addressarrays] );
    }
}
