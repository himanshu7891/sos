@extends('web.v1.common.app')

@section('content')

    <div class="container">
        <div id="ajax-msg"></div>
        <div class="card container">
            <div class="row">
                <ul class="nav justify-content-center nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#new-application">Application</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#person-details">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#loan-details">Loan Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#vehicle-details">Vehicle Details</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('firstForm.submit') }}" method="post" class="py-2" id="first-form">
                @csrf
                <div class="row">
                    <div class="col-md-12" id="new-application">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Date</label>
                                <span class="required">*</span>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="date" class="form-control"
                                            name="system_date"
                                            id="system_date" placeholder="Date" 
                                            value="<?php echo date('Y-m-d'); ?>" 
                                            aria-label="Date" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Member Code:</label>
                                <span class="required">*</span>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select class="form-control form-select"
                                            name="member_id"
                                            id="member_id">
                                            <option value="">Select Member</option>
                                            @if(isset($members) && !empty($members))
                                                @foreach($members as $key => $row)
                                                    <option value="{{$row->id}}">{{$row->member_code}} ({{Admin::memberFullName($row->id)}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <label for="">Member Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="member_name" name="member_name" class="form-control"
                                            placeholder="Member Name" aria-label="Member Name" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <label for="">Team Code:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="team_code" name="team_code" class="form-control"
                                            placeholder="Team Code" aria-label="Team Code" readonly />
                                        <input type="hidden" name="team_id" id="team_id">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <label for="">Branch Code:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="branch_code" name="branch_code" class="form-control"
                                            placeholder="Branch Code" aria-label="Branch Code" readonly />
                                        <input type="hidden" name="branch_id" id="branch_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Source Start -->
                    <div class="col-md-12">
                        <h3>Source (DD-1)</h3>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Source DD:</label>
                                <span class="required">*</span>
                                <div class="mb-3">
                                    <select class="form-control form-select"
                                        name="source_type"
                                        id="source_type">
                                        <option value="telecaller">Telecaller</option>
                                        <option value="broker">Broker</option>
                                        <option value="direct">Direct</option>
                                        <option value="refferal">Refferal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="source_name" name="source_name" class="form-control"
                                            placeholder="Name" aria-label="Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Email:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="source_email" name="source_email" class="form-control"
                                            placeholder="Email" aria-label="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">GST NO: (If have)</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="source_gst_no" name="source_gst_no" class="form-control"
                                            placeholder="GST No" aria-label="GST No" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Contact No:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="source_contact" name="source_contact" class="form-control"
                                            placeholder="Contact No" aria-label="Contact No" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Source End -->
                    <hr />
                    <!-- Business Detail Start -->
                    <div class="col-md-12">
                        <h5><u>Buisness Details</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Finance/Bank Type:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="b_bank_type"
                                            placeholder="Finance/Bank Type:" name="b_bank_type" aria-label="Finance/Bank Type:" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label for="">Profile Type:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select class="form-control form-select"
                                            name="b_profile_type"
                                            id="b_profile_type">
                                            <option value="self_employed">Self Employed</option>
                                            <option value="salaried">Salaried</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3" id="other-dd">
                                <label for="">Other DD:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select class="form-control form-select"
                                            name="b_other_dd_type"
                                            id="b_other_dd_type">
                                            <option value="">Select DD</option>
                                            <option value="proprietor">Proprietor</option>
                                            <option value="partner">Partner</option>
                                            <option value="agriculture">Agriculture</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Company Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            id="b_company_name" placeholder="Company Name"
                                            name="b_company_name"
                                            aria-label="Company Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Company Type:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select class="form-control form-select" name="b_company_type"
                                            id="b_company_type">
                                            <option value="private_limited">Private Limited</option>
                                            <option value="limited">Limited</option>
                                            <option value="llp">
                                                Limited Liability Partnership (Llp)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Business Detail End -->
                    <hr />
                    <!-- Person Detail Start -->
                    <div class="col-md-12" id="person-details">
                        <h5><u>Person Details</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Main Applicant:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="applicant_name"
                                            id="applicant_name"
                                            placeholder="Main Application" aria-label="Main Application" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Designation Type:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select class="form-control form-select" name="applicant_designation_type"
                                            id="applicant_designation_type">
                                            <option value="">Select Type</option>
                                            <option value="proprietor">Proprietor</option>
                                            <option value="partner">Partner</option>
                                            <option value="agriculture">Agriculture</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Contact Person:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="applicant_contact_person"
                                            id="applicant_contact_person" placeholder="Contact Person"
                                            aria-label="Contact Person" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Contact No:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="applicant_contact"
                                            id="applicant_contact" placeholder="Contact No"
                                            aria-label="Contact No" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Other Contact No:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            id="applicant_other_contact"
                                            name="applicant_other_contact"
                                            placeholder="Other Contact No" aria-label="Other Contact No" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Email ID:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="email" class="form-control"
                                            name="applicant_email"
                                            id="applicant_email" placeholder="Email"
                                            aria-label="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Date Of Birth:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="date" class="form-control"
                                            name="applicant_dob"
                                            id="applicant_dob" placeholder="Date Of Birth"
                                            aria-label="Date Of Birth" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Person Detail End -->
                    <hr />
                    <!-- Resident Detail Start -->
                    <div class="col-md-12">
                        <h5><u>Resident Details</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Resident Type:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="resident_type" class="form-control form-select"
                                            id="resident_type">
                                            <option value="owned">Owned</option>
                                            <option value="rented">Rented</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5><u>Current Address</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="rc_address"
                                            id="rc_address"
                                            placeholder="Current Address" aria-label="Current Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Area:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="rc_area"
                                            id="rc_area" placeholder="Area"
                                            aria-label="Area" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">City:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="rc_city"
                                            id="rc_city" placeholder="City"
                                            aria-label="City" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">State:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="rc_state"
                                            id="rc_state" placeholder="State"
                                            aria-label="State" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5><u>Permant Address</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="rp_address"
                                            id="rp_address" placeholder="Permanent Address"
                                            aria-label="Permanent Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Area:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="rp_area"
                                            id="rp_area" placeholder="Area"
                                            aria-label="Area" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">City:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="rp_city"
                                            id="rp_city" placeholder="City"
                                            aria-label="City" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">State:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="rp_state"
                                            id="rp_state" placeholder="State"
                                            aria-label="State" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Resident Detail End -->
                    <hr />
                    <!-- Office Details Start -->
                    <div class="col-md-12" id="office-details">
                        <h5><u>Office Details</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Company Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="o_company_name"
                                            id="o_company_name" placeholder="Company Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Office Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="o_address"
                                            id="o_address" placeholder="Office Address"
                                            aria-label="Office Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Area:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="o_area"
                                            id="o_area" placeholder="Area"
                                            aria-label="Area" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">City:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="o_city"
                                            id="o_city" placeholder="City"
                                            aria-label="City" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">State:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="o_state"
                                            id="o_state" placeholder="State"
                                            aria-label="State" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Landmark:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="o_landmark"
                                            id="o_landmark" placeholder="Landmark"
                                            aria-label="Landmark" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Pincode:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="o_pincode"
                                            id="o_pincode" placeholder="Pincode"
                                            aria-label="Pincode" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Office Details End -->
                    <hr />
                    <!-- Product Start -->
                    <div class="col-md-12" id="loan-details">
                        <h5><u>Loan Details</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Loan Type:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="product_type" id="product_type"
                                            class="form-select">
                                            <option value="auto_loan">Auto Loan</option>
                                            <option value="commercial_vehicle">Commercial Vehicle</option>
                                            <option value="home_loan">Home Loan</option>
                                            <option value="personal_loan">Personal Loan</option>
                                            <option value="business_loan">Business Loan</option>
                                            <option value="gold_loan">Gold Loan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6" id="auto-loan">
                                <label for="">Auto Loan:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="autoloan_type" id="autoloan_type"
                                            class="form-select">
                                            <option value="new">New</option>
                                            <option value="used">Used</option>
                                            <option value="refinance">Refinance</option>
                                            <option value="purchased">Purchased</option>
                                            <option value="bt">BT</option>
                                            <option value="bt_topup">BT Top Up</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6" id="home-loan">
                                <label for="">Home Loan:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="homeloan_type" id="homeloan_type"
                                            class="form-select">
                                            <option value="lap">LAP</option>
                                            <option value="bt_topup">BT Top Up</option>
                                            <option value="hl">HL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product End -->
                    <hr />
                    <!-- References (Used/broker ref) Start -->
                    <div class="col-md-12">
                        <h5><u>References (Used/broker ref)</u></h5>
                        <h5><u>Option 1</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ref_name[0]"
                                        name="ref_name[0]"
                                            placeholder="Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            name="ref_address[0]"
                                            id="ref_address[0]" placeholder="Address"
                                            aria-label="Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Mobile No:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="ref_mobile[0]"
                                            id="ref_mobile[0]" placeholder="Mobile No"
                                            aria-label="Mobile No" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Relationship:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="ref_relationship[0]" id="ref_relationship[0]"
                                            class="form-select">
                                            <option value="">Select Relationship</option>
                                            <option value="husbund">Husbund</option>
                                            <option value="wife">Wife</option>
                                            <option value="son">Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="uncle">Uncle</option>
                                            <option value="father">Father</option>
                                            <option value="mother">Mother</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h5><u>Option 2</u></h5>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Name:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="ref_name[1]"
                                            name="ref_name[1]"
                                                placeholder="Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Address:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                name="ref_address[1]"
                                                id="ref_address[1]" placeholder="Address"
                                                aria-label="Address" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Mobile No:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="ref_mobile[1]"
                                                id="ref_mobile[1]" placeholder="Mobile No"
                                                aria-label="Mobile No" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Relationship:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <select name="ref_relationship[1]" id="ref_relationship[1]"
                                                class="form-select">
                                                <option value="">Select Relationship</option>
                                                <option value="husbund">Husbund</option>
                                                <option value="wife">Wife</option>
                                                <option value="son">Son</option>
                                                <option value="daughter">Daughter</option>
                                                <option value="uncle">Uncle</option>
                                                <option value="father">Father</option>
                                                <option value="mother">Mother</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-xs-12 col-md-6">
                                <button class="btn btn-primary">+</button>
                            </div> --}}
                        </div>
                    </div>
                    <!-- References (Used/broker ref) End -->
                    <hr />
                    <!-- Co- applicant Details Start -->
                    <div class="col-md-12" id="co-applicant-details">
                        <h5><u>Co-applicant Details</u></h5>
                        <h5><u>Option 1</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Co-applicant:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="co_applicant[0]" class="form-select co-applicant0"
                                            id="co_applicant[0]">
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_name[0]"
                                            id="co_applicant_name[0]" placeholder="Name"
                                            aria-label="Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_address[0]"
                                            id="co_applicant_address[0]" placeholder="Address"
                                            aria-label="Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Mobile No:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_mobile[0]"
                                            id="co_applicant_mobile[0]" placeholder="Mobile No"
                                            aria-label="Mobile No" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Relationship:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="co_applicant_relationship[0]" id="co_applicant_relationship[0]"
                                            class="form-select co-applicant-option0">
                                            <option value="">Select Relationship</option>
                                            <option value="husbund">Husbund</option>
                                            <option value="wife">Wife</option>
                                            <option value="son">Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="uncle">Uncle</option>
                                            <option value="father">Father</option>
                                            <option value="mother">Mother</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Company Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_company_name[0]"
                                            id="co_applicant_company_name[0]" placeholder="Company Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Company Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_company_address[0]"
                                            id="co_applicant_company_address[0]" placeholder="Company Address"
                                            aria-label="Company Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Area:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_area[0]"
                                            id="co_applicant_area[0]" placeholder="Area"
                                            aria-label="Area" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">City:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_city[0]"
                                            id="co_applicant_city[0]" placeholder="City"
                                            aria-label="City" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">State:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_state[0]"
                                            id="co_applicant_state[0]" placeholder="State"
                                            aria-label="State" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Landmark:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_landmark[0]"
                                            id="co_applicant_landmark[0]" placeholder="Landmark"
                                            aria-label="Landmark" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option0">
                                <label for="">Pincode:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option0" name="co_applicant_pincode[0]"
                                            id="co_applicant_pincode[0]" placeholder="Pincode"
                                            aria-label="Pincode" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5><u>Option 2</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Co-applicant:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="co_applicant[1]" class="form-select co-applicant1"
                                            id="co_applicant[1]">
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_name[1]"
                                            id="co_applicant_name[1]" placeholder="Name"
                                            aria-label="Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_address[1]"
                                            id="co_applicant_address[1]" placeholder="Address"
                                            aria-label="Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Mobile No:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_mobile[1]"
                                            id="co_applicant_mobile[1]" placeholder="Mobile No"
                                            aria-label="Mobile No" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Relationship:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="co_applicant_relationship[1]" id="co_applicant_relationship[1]"
                                            class="form-select co-applicant-option1">
                                            <option value="">Select Relationship</option>
                                            <option value="husbund">Husbund</option>
                                            <option value="wife">Wife</option>
                                            <option value="son">Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="uncle">Uncle</option>
                                            <option value="father">Father</option>
                                            <option value="mother">Mother</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Company Name:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_company_name[1]"
                                            id="co_applicant_company_name[1]" placeholder="Company Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Company Address:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_company_address[1]"
                                            id="co_applicant_company_address[1]" placeholder="Company Address"
                                            aria-label="Company Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Area:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_area[1]"
                                            id="co_applicant_area[1]" placeholder="Area"
                                            aria-label="Area" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">City:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_city[1]"
                                            id="co_applicant_city[1]" placeholder="City"
                                            aria-label="City" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">State:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_state[1]"
                                            id="co_applicant_state[1]" placeholder="State"
                                            aria-label="State" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Landmark:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_landmark[1]"
                                            id="co_applicant_landmark[1]" placeholder="Landmark"
                                            aria-label="Landmark" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 co-applicant-option1">
                                <label for="">Pincode:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control co-applicant-option1" name="co_applicant_pincode[1]"
                                            id="co_applicant_pincode[1]" placeholder="Pincode"
                                            aria-label="Pincode" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Co- applicant Details End -->
                    <hr />
                    <!-- Vehicle Details Start -->
                    <div class="col-md-12" id="vehicle-details">
                        <h5><u>Vehicle Details</u></h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="">Make:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="make"
                                            id="make" placeholder="Make" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Vehicle Type:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="vehicle_type" id="vehicle_type"
                                            class="form-select">
                                            <option value="">Select Type</option>
                                            <option value="two_wheeler">Two Wheeler</option>
                                            <option value="three_wheeler">Three Wheeler</option>
                                            <option value="four_wheeler">Four Wheeler</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Model:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="model" 
                                            id="model" placeholder="Model" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Variant:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="variant"
                                            id="variant" placeholder="Variant" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Year of Manufacturing:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="year_of_manufacturing"
                                            id="year_of_manufacturing"
                                            placeholder="Year Of Manufacturing" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Valuation/Quotation:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="valuation"
                                            id="valuation" placeholder="Valuation/Quotation" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Finance Amount:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="finance_amount"
                                            id="finance_amount" placeholder="Finance Amount" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Margin:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="margin"
                                            id="margin" placeholder="Margin" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Funding in % :</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="funding"
                                            id="funding" placeholder="Funding in %" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Scheme Applied :</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="scheme applied"
                                            id="scheme_applied" placeholder="Scheme Applied" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Months:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="months" id="months"
                                            class="form-select">
                                            <option value="">Select months</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">EMI Account:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="emi_amount"
                                            id="emi_amount" placeholder="EMI Account" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="">Customer IRR:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="customer_irr"
                                            id="customer_irr" placeholder="Customer IRR" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Vehicle Details End -->
                        <hr />
                        <!-- Vehicle Registration Details Start -->
                        <div class="col-md-12">
                            <h5><u>Vehicle Registration</u></h5>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Regisration No:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="registration_no"
                                                id="registration_no"
                                                placeholder="Regisration No" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Engine No:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="engine_no"
                                                id="engine_no" placeholder="Engine No" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Chasis No:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="chasis_no"
                                                id="chasis_no" placeholder="Chasis No" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Insurance Company Name:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="insurance_company_name"
                                                id="insurance_company_name"
                                                placeholder="Insurance Company Name:" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">IDV:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="idv"
                                                id="idv" placeholder="IDV:" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Cover Note/ Policy No:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="policy_no"
                                                id="policy_no"
                                                placeholder="Cover Note/ Policy No:" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="">Insurance Policy Start
                                        Date:</label>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="insurance_policy_start_date"
                                                id="insurance_policy_start_date"
                                                placeholder="Insurance Policy Start Date:" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Vehicle Registration Details End -->
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><button type="submit" class="btn btn-primary  btn-sm">Next</button></div>                        
                    </div>
                </div>                           
            </form>
        </div>
        <a id="back-to-top" href="#" class="btn btn-success btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>
    </div>
@endsection

@section("scripts")

@include("web.v1.common.js")

<script>

    $(document).ready(function() {
        
        $("#other-dd").hide();
        $("#b_profile_type").trigger('change');

        $(".co-applicant-option0").hide();   
        $(".co-applicant0").trigger('change');

        $(".co-applicant-option1").hide();
        $(".co-applicant1").trigger('change');

        $("#auto-loan").hide();
        $("#home-loan").hide();
        $("#product_type").trigger('change');
    });

    $(document).on("change","#b_profile_type", function(e) {
        if($(this).val() == "self_employed") {
            $("#other-dd").show();
        } else {
            $("#other-dd").hide();
        }
    });

    $(document).on("change",".co-applicant0", function(e) {
        if($(this).val() == "yes") {
            $(".co-applicant-option0").show();
        } else {
            $(".co-applicant-option0").hide();
        }
    });

    $(document).on("change",".co-applicant1", function(e) {
        if($(this).val() == "yes") {
            $(".co-applicant-option1").show();
        } else {
            $(".co-applicant-option1").hide();
        }
    });

    $(document).on("change","#product_type", function(e) {
        if($(this).val() == "auto_loan") {
            $("#auto-loan").show();
            $("#home-loan").hide();
        } else if($(this).val() == "home_loan") {
            $("#auto-loan").hide();
            $("#home-loan").show();
        } else {
            $("#auto-loan").hide();
            $("#home-loan").hide();
        }
    });

    $(document).on("change","#member_id", function(e) {
        var memberId = $(this).val();
        if(memberId) {
            $.ajax({
                url: "{{ route('get.member.data') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: {
                    memberId: memberId
                },
                success: function(data) {
                    console.log('data',data);
                    console.log('data1',data.member.member_code);
                    if($.isEmptyObject(data.error)) {
                        $("#member_name").val(data.member.fullName);
                        $("#team_code").val(data.member.team.team_code);
                        $("#team_id").val(data.member.team_id);
                        $("#branch_code").val(data.member.branch.branch_code);
                        $("#branch_id").val(data.member.branch_id);
                    }
                }
            });
        } else {
            $("#member_name").val('');
            $("#team_code").val('');
            $("#team_id").val('');
            $("#branch_code").val('');
            $("#branch_id").val('');
        }
    });

    var firstForm = $("#first-form");
    firstForm.submit(function(e) {
        e.preventDefault();
        firstForm.validate({
            rules: {
                system_date: {
                    required: true
                },
                member_id: {
                    required: true
                },
                team_id: {
                    required: true
                },
                branch_id: {
                    required: true
                },

                source_type: {
                    required: true
                },
                source_name: {
                    required: true
                },
                source_email: {
                    required: true,
                    email: true
                },
                source_contact: {
                    required: true,
                    number: true
                },

                b_bank_type: {
                    required: true
                },
                b_profile_type: {
                    required: true
                },
                b_other_dd_type: {
                    required: function(element){
                        return $("#b_profile_type").val()=="self_employed";
                    }
                },
                b_company_name: {
                    required: true
                },
                b_company_type: {
                    required: true
                },

                applicant_name: {
                    required: true
                },
                applicant_designation_type: {
                    required: true
                },
                applicant_contact_person: {
                    required: true
                },
                applicant_contact: {
                    required: true,
                    number: true
                },
                applicant_other_contact: {
                    number: true
                },
                applicant_email: {
                    required: true,
                    email: true
                },

                resident_type: {
                    required: true
                },
                rc_address: {
                    required: true
                },
                rc_area: {
                    required: true
                },
                rc_city: {
                    required: true
                },
                rc_state: {
                    required: true
                },
                rp_address: {
                    required: true
                },
                rp_area: {
                    required: true
                },
                rp_city: {
                    required: true
                },
                rp_state: {
                    required: true
                },

                o_company_name: {
                    required: true
                },
                o_address: {
                    required: true
                },
                o_area: {
                    required: true
                },
                o_city: {
                    required: true
                },
                o_state: {
                    required: true
                },
                o_pincode: {
                    required: true,
                    number: true
                },

                ref_mobile: {
                    number: true
                },

                co_applicant_mobile: {
                    number: true
                },
                co_applicant_pincode: {
                    number: true
                },

                make: {
                    required: true
                },
                vehicle_type: {
                    required: true
                },
                model: {
                    required: true
                },
                variant: {
                    required: true
                },
                year_of_manufacturing: {
                    required: true,
                    digits: true,
                    minlength: 4,
                    maxlength: 4
                },
                valuation: {
                    required: true,
                    number: true
                },
                finance_amount: {
                    required: true,
                    number: true
                },
                margin: {
                    required: true,
                    number: true
                },
                funding: {
                    required: true,
                    number: true
                },
                months: {
                    required: true
                },
                emi_amount: {
                    required: true,
                    number: true
                },

                registration_no: {
                    required: true,
                    number: true
                },
                engine_no: {
                    required: true,
                    number: true
                },
                chasis_no: {
                    required: true,
                    number: true
                },
                insurance_company_name: {
                    required: true
                },
                idv: {
                    required: true
                },
                policy_no: {
                    required: true
                },
                insurance_policy_start_date: {
                    required: true
                }
            },
            messages: {
                system_date: {
                    required: "Date is required."
                },
                member_id: {
                    required: "Member Code is required."
                },
                team_id: {
                    required: "Team Code is required."
                },
                branch_id: {
                    required: "Branch Code is required."
                },

                source_type: {
                    required: "Source DD is required."
                },
                source_name: {
                    required: "Name is required."
                },
                source_email : {
                    required: "Email is required.",
                    email : "Please enter a valid email address."
                },
                source_contact : {
                    required: "Contact no. is required.",
                    number : "Please enter a valid conatct no."
                },

                b_bank_type: {
                    required: "Finance/Bank Type is required."
                },
                b_profile_type: {
                    required: "Profile Type is required."
                },
                b_other_dd_type: {
                    required: "Other DD is required."
                },
                b_company_name: {
                    required: "Company Name is required."
                },
                b_company_type: {
                    required: "Company Type is required."
                },
                
                applicant_name: {
                    required: "Main Applicant is required."
                },
                applicant_designation_type: {
                    required: "Designation Type is required."
                },
                applicant_contact_person: {
                    required: "Contact Person is required."
                },
                applicant_contact : {
                    required: "Contact no. is required.",
                    number : "Please enter a valid conatct no."
                },
                applicant_other_contact : {
                    number : "Please enter a valid conatct no."
                },
                applicant_email : {
                    required: "Email Id is required.",
                    email : "Please enter a valid email address."
                },

                resident_type: {
                    required: "Resident Type is required."
                },
                rc_address: {
                    required: "Address is required."
                },
                rc_area: {
                    required: "Area is required."
                },
                rc_city: {
                    required: "City is required."
                },
                rc_state: {
                    required: "State is required."
                },
                rp_address: {
                    required: "Address is required."
                },
                rp_area: {
                    required: "Area is required."
                },
                rp_city: {
                    required: "City is required."
                },
                rp_state: {
                    required: "State is required."
                },

                o_company_name: {
                    required: "Company Name is required."
                },
                o_address: {
                    required: "Address is required."
                },
                o_area: {
                    required: "Area is required."
                },
                o_city: {
                    required: "City is required."
                },
                o_state: {
                    required: "State is required."
                },
                o_pincode: {
                    required: "Pincode is required.",
                    number: "Please enter a valid pincode."
                },

                ref_mobile: {
                    number: "Please enter a valid Mobile no."
                },

                co_applicant_mobile: {
                    number: "Please enter a valid Mobile no."
                },
                co_applicant_pincode: {
                    number: "Please enter a valid pincode."
                },

                make: {
                    required: "Make is required."
                },
                vehicle_type: {
                    required: "Vehicle Type is required."
                },
                model: {
                    required: "Model is required."
                },
                variant: {
                    required: "Variant is required."
                },
                year_of_manufacturing : {
                    required: "Year of Manufacturing is required.",
                    digits : "Please enter a valid year.",
                    minlength: "It accepts only 4 digits.",
                    maxlength: "It accepts only 4 digits.",
                },
                valuation : {
                    required: "Valuation is required.",
                    number : "Please enter a valid valuation."
                },
                finance_amount : {
                    required: "Finance Amount is required.",
                    number : "Please enter a valid finance amount."
                },
                margin : {
                    required: "Margin is required.",
                    number : "Please enter a valid margin."
                },
                funding: {
                    required: "Funding is required.",
                    number: "Please enter a valid funding in."
                },
                months: {
                    required: "Months is required."
                },
                emi_amount : {
                    required: "EMI Amount is required.",
                    number : "Please enter a valid EMI amount."
                },

                registration_no: {
                    required: "Registration no. is required.",
                    number: "Please enter a valid registration no."
                },
                engine_no: {
                    required: "Engine no. is required.",
                    number: "Please enter a valid engine no."
                },
                chasis_no: {
                    required: "Chasis no. is required.",
                    number: "Please enter a valid chasis no."
                },
                insurance_company_name: {
                    required: "Insurance Company Name is required."
                },
                idv: {
                    required: "IdV is required."
                },
                policy_no: {
                    required: "Cover Note/ Policy No. is required."
                },
                insurance_policy_start_date: {
                    required: "Insurance Policy Start Date is required."
                }
            },errorPlacement: function(error, element)
            {
                error.insertAfter( element.parent() );
            }
        });

        if(firstForm.valid()) {
            $.ajax({
                url: "{{ route('firstForm.submit') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: $('#first-form').serialize(),
                success: function(data) {
                    console.log('data',data);
                    if($.isEmptyObject(data.error)) {
                        var html = '';
                        html += '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                        html += '<strong>'+data.success+'</strong>';
                        html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        html += '</div>';
                        $("#ajax-msg").html(html);
                        $("form").trigger("reset");
                        var url = "{{ route('SecondForm') }}";
                        url += "/"+data.applicationId;
                        window.location.href = url;
                        $('html, body').animate({
                            scrollTop: "0px",
                        }, 1000);
                    } else {
                        var html = '';
                        html += '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        html += '<strong>'+data.error+'</strong>';
                        html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        html += '</div>';
                        $("#ajax-msg").html(html);
                        $('html, body').animate({
                            scrollTop: "0px"
                        }, 800);
                    }
                }
            });
        }
    });

</script>

@endsection
