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
        $address = Addresse::where( 'id',$company->address_id )->first();
        $addressarrays=[];


        foreach ($companydirectors as $companydirector){
            $addresse = Addresse::where( 'id',$companydirector->address_id )->first();
            $addressarrays[$companydirector->address_id] = $addresse;

        }


        $createDate = new \DateTime($company->created_at);
        $strip = $createDate->format('Y-m-d');
        $num = str_replace('-', '', $strip);
        $incoDate = (int) $num;

        $companytypeid = $company->type_id;

        $checksum = $incoDate+$companytypeid;


        $xml = new \DOMDocument("1.0","UTF-8");

        $container = $xml->createElement("CompanyRegistrationDetailsMessage");
        $container = $xml->appendChild($container);

            $header = $xml->createElement("Header");
            $container->appendChild($header);

                $username = $xml->createElement("username","username");
                $header->appendChild($username);

                $password = $xml->createElement("password","password");
                $header->appendChild($password);

                $checksum = $xml->createElement("checksum",$checksum);
                $header->appendChild($checksum);

            $SendRegisteredCompanyFile = $xml->createElement("SendRegisteredCompanyFile");
            $container->appendChild($SendRegisteredCompanyFile);

                $maindetails = $xml->createElement("MainDetails");
                $SendRegisteredCompanyFile->appendChild($maindetails);

                    $ROCNumber = $xml->createElement("ROCNumber");
                    $maindetails->appendChild($ROCNumber);

                    $Salutation = $xml->createElement("Salutation");
                    $maindetails->appendChild($Salutation);

        $CompanyName = $xml->createElement("CompanyName");
        $maindetails->appendChild($CompanyName);

        $CompanyType = $xml->createElement("CompanyType");
        $maindetails->appendChild($CompanyType);

        $DateOfIncorporation = $xml->createElement("DateOfIncorporation");
        $maindetails->appendChild($DateOfIncorporation);

        $DateofCommencement = $xml->createElement("DateofCommencement");
        $maindetails->appendChild($DateofCommencement);

        $xml->FormatOutput = true;
        $xml->saveXML();

        $xml->save("example.xml");
        $xml->load("example.xml");

        dd($xml);







        return view( 'companyidinsert', [ 'company' => $company,'companydirectors' => $companydirectors ,'address' => $address,'addressarrays' => $addressarrays] );
    }
}
