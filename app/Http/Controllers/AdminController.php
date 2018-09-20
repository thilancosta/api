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

                    $CompanyName = $xml->createElement("CompanyName",$company->name);
                    $maindetails->appendChild($CompanyName);

                    $CompanyType = $xml->createElement("CompanyType",$company->type_id);
                    $maindetails->appendChild($CompanyType);

                    $DateOfIncorporation = $xml->createElement("DateOfIncorporation",$company->created_at);
                    $maindetails->appendChild($DateOfIncorporation);

                    $DateofCommencement = $xml->createElement("DateofCommencement");
                    $maindetails->appendChild($DateofCommencement);

                    $BAC = $xml->createElement("BAC");
                    $maindetails->appendChild($BAC);

                    $PreferredLanguage = $xml->createElement("PreferredLanguage");
                    $maindetails->appendChild($PreferredLanguage);

                    $PreferredModeOfCommunication = $xml->createElement("PreferredModeOfCommunication");
                    $maindetails->appendChild($PreferredModeOfCommunication);

                    $BOIRegistered = $xml->createElement("BOIRegistered");
                    $maindetails->appendChild($BOIRegistered);

                    $BOIStartDate = $xml->createElement("BOIStartDate");
                    $maindetails->appendChild($BOIStartDate);

                    $BOIEndDate = $xml->createElement("BOIEndDate");
                    $maindetails->appendChild($BOIEndDate);

                    $PurposeOfRegistration = $xml->createElement("PurposeOfRegistration");
                    $maindetails->appendChild($PurposeOfRegistration);

                    $OtherPurposeOfRegistration = $xml->createElement("OtherPurposeOfRegistration");
                    $maindetails->appendChild($OtherPurposeOfRegistration);

                    $OtherPurposeOfRegistration = $xml->createElement("OtherPurposeOfRegistration");
                    $maindetails->appendChild($OtherPurposeOfRegistration);

                $ForeignCompany = $xml->createElement("ForeignCompany");
                $SendRegisteredCompanyFile->appendChild($ForeignCompany);

                    $DateofIncorporation = $xml->createElement("DateofIncorporation");
                    $ForeignCompany->appendChild($DateofIncorporation);

                    $CountryOfOrigin = $xml->createElement("CountryOfOrigin");
                    $ForeignCompany->appendChild($CountryOfOrigin);

                $GroupOfCompanies = $xml->createElement("GroupOfCompanies");
                $SendRegisteredCompanyFile->appendChild($GroupOfCompanies);

                    $ParentCompanyExists = $xml->createElement("ParentCompanyExists");
                    $GroupOfCompanies->appendChild($ParentCompanyExists);

                    $LocalParentCompany = $xml->createElement("LocalParentCompany");
                    $GroupOfCompanies->appendChild($LocalParentCompany);

                    $ParentCompanyReference = $xml->createElement("ParentCompanyReference");
                    $GroupOfCompanies->appendChild($ParentCompanyReference);

                    $ParentCompanyReferenceID = $xml->createElement("ParentCompanyReferenceID");
                    $GroupOfCompanies->appendChild($ParentCompanyReferenceID);

                    $ParentCompanyName = $xml->createElement("ParentCompanyName");
                    $GroupOfCompanies->appendChild($ParentCompanyName);

                    $ParentCompanyAddress = $xml->createElement("ParentCompanyAddress");
                    $GroupOfCompanies->appendChild($ParentCompanyAddress);

                    $CountryOfIncorporation = $xml->createElement("CountryOfIncorporation");
                    $GroupOfCompanies->appendChild($CountryOfIncorporation);

                    $DateOfIncorporation = $xml->createElement("DateOfIncorporation");
                    $GroupOfCompanies->appendChild($DateOfIncorporation);

                $Address = $xml->createElement("Address");
                $SendRegisteredCompanyFile->appendChild($Address);

                    $RegisteredAddress = $xml->createElement("RegisteredAddress",$address->address1 ." ". $address->address2 ." ". $address->city);
                    $Address->appendChild($RegisteredAddress);

                    $Province = $xml->createElement("Province",$address->province);
                    $Address->appendChild($Province);

                    $District = $xml->createElement("District",$address->district);
                    $Address->appendChild($District);

                    $DivisionalSecretariat = $xml->createElement("DivisionalSecretariat");
                    $Address->appendChild($DivisionalSecretariat);

                    $GramaNiladhariDivisions = $xml->createElement("GramaNiladhariDivisions");
                    $Address->appendChild($GramaNiladhariDivisions);

                $Contact = $xml->createElement("Contact");
                $SendRegisteredCompanyFile->appendChild($Contact);

                    $Mobile = $xml->createElement("Mobile");
                    $Contact->appendChild($Mobile);

                    $Office = $xml->createElement("Office");
                    $Contact->appendChild($Office);

                    $Fax = $xml->createElement("Fax");
                    $Contact->appendChild($Fax);

                    $EmailAddress = $xml->createElement("EmailAddress",$company->email);
                    $Contact->appendChild($EmailAddress);

                    $ContactPersonName = $xml->createElement("ContactPersonName");
                    $Contact->appendChild($ContactPersonName);

                $DirectorList = $xml->createElement("DirectorList");
                $SendRegisteredCompanyFile->appendChild($DirectorList);

                $i = 0;
                    foreach($companydirectors as $companydirector) {

                        $i = $i + 1;
                        $Director = $xml->createElement("Director");
                        $DirectorList->appendChild($Director);

                            $DirectorReferenceType = $xml->createElement("DirectorReferenceType","NIC");
                            $Director->appendChild($DirectorReferenceType);

                            $DirectorReferenceNumber = $xml->createElement("DirectorReferenceNumber",$companydirector->nic);
                            $Director->appendChild($DirectorReferenceNumber);

                            $DirectorName = $xml->createElement("DirectorName",$companydirector->first_name." ".$companydirector->last_name);
                            $Director->appendChild($DirectorName);

                            $Salutation = $xml->createElement("Salutation",$companydirector->title);
                            $Director->appendChild($Salutation);

                            $IssuanceCountryOfPassport = $xml->createElement("IssuanceCountryOfPassport",$companydirector->passport_issued_country);
                            $Director->appendChild($IssuanceCountryOfPassport);

                            $DateOfBirth = $xml->createElement("DateOfBirth",$companydirector->dob);
                            $Director->appendChild($DateOfBirth);

                            $DirectorAddress = $xml->createElement("DirectorAddress",$addressarrays[$companydirector->address_id]->address1." ".$addressarrays[$companydirector->address_id]->address2." ".$addressarrays[$companydirector->address_id]->city);
                            $Director->appendChild($DirectorAddress);

                            $DirectorContact = $xml->createElement("DirectorContact");
                            $Director->appendChild($DirectorContact);

                                $Mobile = $xml->createElement("Mobile",$companydirector->mobile);
                                $DirectorContact->appendChild($Mobile);

                                $Office = $xml->createElement("Office",$companydirector->telephone);
                                $DirectorContact->appendChild($Office);

                                $Fax = $xml->createElement("Fax");
                                $DirectorContact->appendChild($Fax);

                                $EmailAddress = $xml->createElement("EmailAddress",$companydirector->email);
                                $DirectorContact->appendChild($EmailAddress);

                                $ContactPersonName = $xml->createElement("ContactPersonName");
                                $DirectorContact->appendChild($ContactPersonName);

                    }

        $xml->FormatOutput = true;
        $xml->saveXML();

        $xml->save("example.xml");








        return view( 'companyidinsert', [ 'company' => $company,'companydirectors' => $companydirectors ,'address' => $address,'addressarrays' => $addressarrays] );
    }
}
