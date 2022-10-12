<?php

namespace App\Http\Controllers\Web\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applications;
use App\Models\ApplicationStatus;
use App\Models\References;
use App\Models\CoApplicantDetails;
use App\Models\Vehicles;
use App\Models\DisbursementDetail;
use App\Models\Member;
use Admin;

class SOSFormsController extends Controller
{
    //

    public function firstForm() {
        $members = Member::get();
        return view('web.v1.forms.FirstForm', compact('members'));
    }

    public function getMemberData(Request $request) {
        $member = Member::whereId($request->memberId)->with('team','branch')->first();
        $member['fullName'] = Admin::memberFullName($request->memberId);
        
        if($member) {
            return response()->json(['success'=>'Data found successfully.', 'member'=>$member]);
        } else {
            return response()->json(['error'=> 'Something went wrong!', 'member'=>array()]);
        }
    }

    public function submitFirstForm(Request $request){

        $application['application_code'] = Admin::applicationCode($request->member_id,$request->team_id,$request->branch_id);
        $application['system_date'] = $request->system_date ?? NULL;
        $application['member_id'] = $request->member_id;
        $application['team_id'] = $request->team_id;
        $application['branch_id'] = $request->branch_id;

        //source
        $application['source_type'] = $request->source_type ?? NULL;
        $application['source_name'] = $request->source_name ?? NULL;
        $application['source_email'] = $request->source_email ?? NULL;
        $application['source_gst_no'] = $request->source_gst_no ?? NULL;
        $application['source_contact'] = $request->source_contact ?? NULL;

        //business details
        $application['b_bank_type'] = $request->b_bank_type ?? NULL;
        $application['b_profile_type'] = $request->b_profile_type ?? NULL;
        $application['b_other_dd_type'] = $request->b_other_dd_type ?? NULL;
        $application['b_company_name'] = $request->b_company_name ?? NULL;
        $application['b_company_type'] = $request->b_company_type ?? NULL;

        //person details
        $application['applicant_name'] = $request->applicant_name ?? NULL;
        $application['applicant_designation_type'] = $request->applicant_designation_type ?? NULL;
        $application['applicant_contact_person'] = $request->applicant_contact_person ?? NULL;
        $application['applicant_contact'] = $request->applicant_contact ?? NULL;
        $application['applicant_other_contact'] = $request->applicant_other_contact ?? NULL;
        $application['applicant_email'] = $request->applicant_email ?? NULL;
        $application['applicant_dob'] = $request->applicant_dob ?? NULL;
        
        //resident details
        $application['resident_type'] = $request->resident_type ?? NULL;

        // current address
        $application['rc_address'] = $request->rc_address ?? NULL;
        $application['rc_area'] = $request->rc_area ?? NULL;
        $application['rc_city'] = $request->rc_city ?? NULL;
        $application['rc_state'] = $request->rc_state ?? NULL;

        //permanant address
        $application['rp_address'] = $request->rp_address ?? NULL;
        $application['rp_area'] = $request->rp_area ?? NULL;
        $application['rp_city'] = $request->rp_city ?? NULL;
        $application['rp_state'] = $request->rp_state ?? NULL;

        //office details
        $application['o_company_name'] = $request->o_company_name ?? NULL;
        $application['o_address'] = $request->o_address ?? NULL;
        $application['o_area'] = $request->o_area ?? NULL;
        $application['o_city'] = $request->o_city ?? NULL;
        $application['o_state'] = $request->o_state ?? NULL;
        $application['o_landmark'] = $request->o_landmark ?? NULL;
        $application['o_pincode'] = $request->o_pincode ?? NULL;

        //product
        $application['product_type'] = $request->product_type ?? NULL;
        $application['autoloan_type'] = $request->autoloan_type ?? NULL;
        $application['homeloan_type'] = $request->homeloan_type ?? NULL;

        $response = Applications::insertGetId($application);
        if($response) {

            $appStatus['application_id'] = $response;
            $appStatus['status'] = "pending";
            ApplicationStatus::insertGetId($appStatus);

            if(isset($request->ref_name) && !empty($request->ref_name)) {
                $ref_name = $request->ref_name;
                $ref_address = $request->ref_address;
                $ref_mobile = $request->ref_mobile;
                $ref_relationship = $request->ref_relationship;

                foreach($ref_name as $key => $row) {
                    if(isset($row) && !empty($row)) {
                        $ref['application_id'] = $response;
                        $ref['name'] = $row ?? NULL;
                        $ref['address'] = $ref_address[$key] ?? NULL;
                        $ref['mobile'] = $ref_mobile[$key] ?? NULL;
                        $ref['relationship'] = $ref_relationship[$key] ?? NULL;

                        References::insertGetId($ref);
                    }
                }
            }

            if(isset($request->co_applicant) && !empty($request->co_applicant)) {
                $co_applicant = $request->co_applicant;
                $co_applicant_name = $request->co_applicant_name;
                $co_applicant_address = $request->co_applicant_address;
                $co_applicant_mobile = $request->co_applicant_mobile;
                $co_applicant_relationship = $request->co_applicant_relationship;
                $co_applicant_company_name = $request->co_applicant_company_name;
                $co_applicant_company_address = $request->co_applicant_company_address;
                $co_applicant_area = $request->co_applicant_area;
                $co_applicant_city = $request->co_applicant_city;
                $co_applicant_state = $request->co_applicant_state;
                $co_applicant_landmark = $request->co_applicant_landmark;
                $co_applicant_pincode = $request->co_applicant_pincode;

                foreach($co_applicant as $key => $row) {
                    if(isset($row) && !empty($row) && $row == "yes") {
                        $coapp['application_id'] = $response;
                        $coapp['co_applicant'] = $row ?? NULL;
                        $coapp['name'] = $co_applicant_name[$key] ?? NULL;
                        $coapp['address'] = $co_applicant_address[$key] ?? NULL;
                        $coapp['mobile'] = $co_applicant_mobile[$key] ?? NULL;
                        $coapp['relationship'] = $co_applicant_relationship[$key] ?? NULL;
                        $coapp['company_name'] = $co_applicant_company_name[$key] ?? NULL;
                        $coapp['company_address'] = $co_applicant_company_address[$key] ?? NULL;
                        $coapp['area'] = $co_applicant_area[$key] ?? NULL;
                        $coapp['city'] = $co_applicant_city[$key] ?? NULL;
                        $coapp['state'] = $co_applicant_state[$key] ?? NULL;
                        $coapp['landmark'] = $co_applicant_landmark[$key] ?? NULL;
                        $coapp['pincode'] = $co_applicant_pincode[$key] ?? NULL;

                        CoApplicantDetails::insertGetId($coapp);
                    } 
                }
            }

            if(isset($request->make) && !empty($request->make)) {
                $vehicle['application_id'] = $response;
                    $vehicle['make'] = $request->make ?? NULL;
                    $vehicle['vehicle_type'] = $request->vehicle_type ?? NULL;
                    $vehicle['model'] = $request->model ?? NULL;
                    $vehicle['variant'] = $request->variant ?? NULL;
                    $vehicle['year_of_manufacturing'] = $request->year_of_manufacturing ?? NULL;
                    $vehicle['valuation'] = $request->valuation ?? NULL;
                    $vehicle['finance_amount'] = $request->finance_amount ?? NULL;
                    $vehicle['margin'] = $request->margin ?? NULL;
                    $vehicle['funding'] = $request->funding ?? NULL;
                    $vehicle['scheme_applied'] = $request->scheme_applied ?? NULL;
                    $vehicle['months'] = $request->months ?? NULL;
                    $vehicle['emi_amount'] = $request->emi_amount ?? NULL;
                    $vehicle['customer_irr'] = $request->customer_irr ?? NULL;

                    $vehicle['registration_no'] = $request->registration_no ?? NULL;                    
                    $vehicle['engine_no'] = $request->engine_no ?? NULL;
                    $vehicle['chasis_no'] = $request->chasis_no ?? NULL;
                    $vehicle['insurance_company_name'] = $request->insurance_company_name ?? NULL;
                    $vehicle['idv'] = $request->idv ?? NULL;
                    $vehicle['policy_no'] = $request->policy_no ?? NULL;
                    $vehicle['insurance_policy_start_date'] = $request->insurance_policy_start_date ?? NULL;

                    Vehicles::insertGetId($vehicle);
            }

            return response()->json(['success'=>'Application registered successfully.','applicationId'=>$response]);
        } else {
            return response()->json(['error'=> 'Something went wrong!']);
        }
    }

    public function secondForm($applicationId) {
        
        $data = Applications::whereId($applicationId)
                ->with('status','references','coapplicants','vehicle')
                ->first();

        return view('web.v1.forms.SecondForm', compact('data'));
    }

    public function submitSecondForm(Request $request) {
        
        $dd['application_id'] = $request->application_id ?? NULL;
        $dd['bank_name'] = $request->bank_name ?? NULL;
        $dd['vehicle_no'] = $request->vehicle_no ?? NULL;
        $dd['customer_mobile'] = $request->customer_mobile ?? NULL;
        $dd['customer_confirmation'] = $request->customer_confirmation ?? NULL;
        $dd['vehicle_type'] = $request->vehicle_type ?? NULL;
        $dd['make'] = $request->make ?? NULL;
        $dd['model'] = $request->model ?? NULL;
        $dd['variant'] = $request->variant ?? NULL;
        $dd['year_of_manufacturing'] = $request->year_of_manufacturing ?? NULL;
        $dd['loan_amount'] = $request->loan_amount ?? NULL;
        $dd['loan_variation_amount'] = $request->loan_variation_amount ?? NULL;
        $dd['emi_month'] = $request->emi_month ?? NULL;
        $dd['emi_amount'] = $request->emi_amount ?? NULL;
        $dd['emi_starting_date'] = $request->emi_starting_date ?? NULL;
        $dd['sms_send_option'] = $request->sms_send_option ?? NULL;
        $dd['processing_fee'] = $request->processing_fee ?? NULL;
        $dd['stamp_duty'] = $request->stamp_duty ?? NULL;
        $dd['document_charge'] = $request->document_charge ?? NULL;
        $dd['pdd_charge'] = $request->pdd_charge ?? NULL;
        $dd['other_charge'] = $request->other_charge ?? NULL;
        $dd['valuation'] = $request->valuation ?? NULL;
        $dd['insurance'] = $request->insurance ?? NULL;
        $dd['insurance_amount'] = $request->insurance_amount ?? NULL;
        $dd['insurance_funding'] = $request->insurance_funding ?? NULL;
        $dd['payment_receivable'] = $request->payment_receivable ?? NULL;
        $dd['rto_tax'] = $request->rto_tax ?? NULL;
        $dd['rto_charges'] = $request->rto_charges ?? NULL;
        $dd['rto_paper_status'] = $request->rto_paper_status ?? NULL;
        $dd['net_payment'] = $request->net_payment ?? NULL;
        $dd['payment_favour'] = $request->payment_favour ?? NULL;
        $dd['commision_to'] = $request->commision_to ?? NULL;
        $dd['gst'] = $request->gst ?? NULL;

        $response = DisbursementDetail::insertGetId($dd);
        if($response) {
            return response()->json(['success'=>'Disbursement details registered successfully.']);
        } else {
            return response()->json(['error'=> 'Something went wrong!']);
        }
    }

}
