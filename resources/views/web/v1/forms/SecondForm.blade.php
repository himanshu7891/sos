@extends('layouts.app')

@section('content')

<style>
    label.error {
        color: red;
    }
    span.required {
        color: red;
    }
</style>

<div class="container">

    <div id="ajax-msg"></div>

    <div class="card container">
        <form action="{{ route('secondForm.submit') }}" method="post" class="py-2" id="second-form">
            @csrf
            <div class="row">
                <!-- Source Start -->
                <div class="col-md-12">
                    <h3>Disbursement Details</h3>    
                </div>
                <input type="hidden" id="applicantion_id" name="application_id" value="{{ $data->id }}">
                <div class="col-xs-12 col-md-6">
                    <label for="">Name of the bank:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{ $data->b_bank_type ?? '' }}"
                                placeholder="Name of the bank" aria-label="Name of the bank" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-6">
                    <label for="">Vehicle No:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="vehicle_no" name="vehicle_no" class="form-control" value="{{ $data['vehicle']['registration_no'] ?? '' }}"
                                placeholder="Vehicle No" aria-label="Vehicle No" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Customer Mobile No:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="customer_mobile" name="customer_mobile" class="form-control" value="{{ $data->applicant_contact ?? '' }}"
                                placeholder="Customer Mobile No" aria-label="Customer Mobile No" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Customer Confirmation:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <select name="customer_confirmation" class="form-select co-applicant"
                                id="customer_confirmation">
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Vehicle Type:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <select name="vehicle_type" id="vehicle_type"
                                class="form-select">
                                <option value="" {{ $data['vehicle']['vehicle_type'] == NULL ? "selected" : "" }}>Select Type</option>
                                <option value="two_wheeler" {{ $data['vehicle']['vehicle_type'] == "two_wheeler" ? "selected" : "" }}>Two Wheeler</option>
                                <option value="three_wheeler" {{ $data['vehicle']['vehicle_type'] == "three_wheeler" ? "selected" : "" }}>Three Wheeler</option>
                                <option value="four_wheeler" {{ $data['vehicle']['vehicle_type'] == "four_wheeler" ? "selected" : "" }}>Four Wheeler</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Make</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="make" name="make" class="form-control" value="{{ $data['vehicle']['make'] ?? '' }}"
                                placeholder="Make" aria-label="Make" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Model</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="model" name="model" class="form-control" value="{{ $data['vehicle']['model'] ?? '' }}"
                                placeholder="Model" aria-label="Model" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Variant</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="variant" name="variant" class="form-control" value="{{ $data['vehicle']['variant'] ?? '' }}"
                                placeholder="Variant" aria-label="Variant" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Year of Manufacturing</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="year_of_manufacturing" name="year_of_manufacturing" class="form-control" value="{{ $data['vehicle']['year_of_manufacturing'] ?? '' }}"
                                placeholder="Year of Manufacturing" aria-label="Year of Manufacturing" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Loan Amount:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="loan_amount" name="loan_amount" class="form-control" value="{{ $data['vehicle']['finance_amount'] ?? '' }}"
                                placeholder="Loan Amount" aria-label="Loan Amount" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Loan Variation Amount</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="loan_variation_amount" name="loan_variation_amount" class="form-control"
                                placeholder="Loan Variation Amount" aria-label="Loan Variation Amount" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">EMI Month:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <select class="form-control form-select"
                            name="emi_month"
                            id="emi_month">
                            <option value="">Select Months</option>
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
                <div class="col-xs-12 col-md-6">
                    <label for="">EMI Amount:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="emi_amount" name="emi_amount" class="form-control"
                                placeholder="EMI Amount" aria-label="EMI Amount" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">EMI Starting Date:</label>
                    <span class="required">*</span>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="date" id="emi_starting_date" name="emi_starting_date" class="form-control"
                                placeholder="EMI Starting Date" aria-label="EMI Starting Date" />
                        </div>
                    </div>
                </div>
                
                
                <div class="col-xs-12 col-md-6">
                    <label for="">SMS Send option</label>
                    <div class="mb-3">
                        <select class="form-control form-select"
                            name="sms_send_option"
                            id="sms_send_option">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Processing Fee:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="processing_fee" name="processing_fee" class="form-control"
                                placeholder="Processing Fee" aria-label="Processing Fee" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Stamp Duty:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="stamp_duty" name="stamp_duty" class="form-control"
                                placeholder="Stamp Duty" aria-label="Stamp Duty" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Document Charge:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="document_charge" name="document_charge" class="form-control"
                                placeholder="Document Charge" aria-label="Document Charge"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">PDD Charge:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="pdd_charge" name="pdd_charge" class="form-control"
                                placeholder="PDD Charge" aria-label="PDD Charge"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Other Charge:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="other_charge" name="other_charge" class="form-control"
                                placeholder="Other Charge" aria-label="Other Charge"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Valuation:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="valuation" name="valuation" class="form-control"
                                placeholder="Valuation" aria-label="Valuation"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Loan Suraksha (Insurance)</label>
                    <div class="mb-3">
                        <select class="form-control form-select"
                            name="insurance"
                            id="insurance">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Loan Suraksha Amount:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="insurance_amount" name="insurance_amount" class="form-control"
                                placeholder="Loan Suraksha Amount" aria-label="Loan Suraksha Amount"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">M I Funding (Insurance):</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="insurance_funding" name="insurance_funding" class="form-control"
                                placeholder="M I Funding (Insurance)" aria-label="M I Funding (Insurance)"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Payment Receivable From Bank:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="payment_receivable" name="payment_receivable" class="form-control"
                                placeholder="Payment Receivable From Bank" aria-label="Payment Receivable From Bank"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">RTO Tax:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="rto_tax" name="rto_tax" class="form-control"
                                placeholder="RTO Tax" aria-label="RTO Tax"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">RTO Charges:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="rto_charges" name="rto_charges" class="form-control"
                                placeholder="RTO Charges" aria-label="RTO Charges"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">RTO Paper Status:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="rto_paper_status" name="rto_paper_status" class="form-control"
                                placeholder="RTO Paper Status" aria-label="RTO Paper Status"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">NET Payment:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="net_payment" name="net_payment" class="form-control"
                                placeholder="NET Payment" aria-label="NET Payment"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for=""> Payment FAVOUR Of:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="payment_favour" name="payment_favour" class="form-control"
                                placeholder="Payment FAVOUR Of" aria-label="Payment FAVOUR Of"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">Commission To:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="commision_to" name="commision_to" class="form-control"
                                placeholder="Commision To" aria-label="Commision To"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="">With GST/Without GST:</label>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="gst" name="gst" class="form-control"
                                placeholder="With GST/Without GST" aria-label="With GST/Without GST"/>
                        </div>
                    </div>
                </div>

            </div> 
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-md-6"><button type="submit" class="btn btn-primary  btn-sm">Submit</button></div>                        
                </div>
            </div>                           
        </form>
    </div>
</div>
@endsection

@section("scripts")

<script>

    var secondForm = $("#second-form");
    secondForm.submit(function(e) {
        e.preventDefault();
        secondForm.validate({
            rules: {
                bank_name: {
                    required: true
                },
                vehicle_no: {
                    required: true,
                    number: true
                },
                customer_mobile: {
                    required:true,
                    number: true
                },
                vehicle_type: {
                    required: true
                },
                make: {
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
                loan_amount: {
                    required: true,
                    number: true
                },
                loan_variation_amount: {
                    required: true,
                    number: true
                },
                emi_month: {
                    required: true
                },
                emi_amount: {
                    required: true,
                    number: true
                },
                emi_starting_date: {
                    required: true
                },
                processing_fee: {
                    number: true
                },
                document_charge: {
                    number: true
                },
                pdd_charge: {
                    number: true
                },
                other_charge: {
                    number: true
                },
                valuation: {
                    number: true
                },
                insurance_amount: {
                    number: true
                },
                insurance_funding: {
                    number: true
                },
                rto_charges: {
                    number: true
                },
                net_payment: {
                    number: true
                }
            },
            messages: {
                bank_name: {
                    required: "Bank Name is required."
                },
                vehicle_no: {
                    required: "Vehicle No. is required.",
                    number: "Please enter a valid vehicle no."
                },
                customer_mobile: {
                    required: "Customer Mobile No. is required.",
                    number: "Please enter a valid customer mobile no."
                },
                vehicle_type: {
                    required: "Vehicle Type is required."
                },
                make: {
                    required: "Make is required."
                },
                model: {
                    required: "Model is required."
                },
                variant: {
                    required: "Variant is required."
                },
                year_of_manufacturing: {
                    required: "Year of Manufacturing is required.",
                    digits : "Please enter a valid year.",
                    minlength: "It accepts only 4 digits.",
                    maxlength: "It accepts only 4 digits.",
                },
                loan_amount: {
                    required: "Loan Amount is required.",
                    number: "Please enter a valid loan amount."
                },
                loan_variation_amount: {
                    required: "Loan Variation Amount is required.",
                    number: "Please enter a valid loan variation amount."
                },
                emi_month: {
                    required: "EMI Month is required."
                },
                emi_amount: {
                    required: "EMI Amount is required.",
                    number: "Please enter a valid EMI amount."
                },
                emi_starting_date: {
                    required: "EMI Starting Date is required."
                },
                processing_fee: {
                    number: "Please enter a valid processing fee."
                },
                document_charge: {
                    number: "Please enter a valid document charge."
                },
                pdd_charge: {
                    number: "Please enter a valid PDD charge."
                },
                other_charge: {
                    number: "Please enter a valid other charge."
                },
                valuation: {
                    number: "Please enter a valid valuation."
                },
                insurance_amount: {
                    number: "Please enter a valid insurance amount."
                },
                insurance_funding: {
                    number: "Please enter a valid insurance funding."
                },
                rto_charges: {
                    number: "Please enter a valid RTO charges."
                },
                net_payment: {
                    number: "Please enter a valid NET payment."
                }
            },errorPlacement: function(error, element)
            {
                error.insertAfter( element.parent() );
            }
        });
        
        if(secondForm.valid()) {
            $.ajax({
                url: "{{ route('secondForm.submit') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: $('#second-form').serialize(),
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
                        $('html, body').animate({
                            scrollTop: "0px"
                        }, 800);
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
