@extends('layouts.main')
@section('title','Patients')
@section ('style')
<link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />

@endsection 
@section('content')
    @include('layouts.mobileSideMenu')
    <div class="flex mt-[4.7rem] md:mt-0">
        @include('layouts.sideMenu')
                <!-- BEGIN: Content -->
                <div class="content">
                    @include('layouts.topBar')
                    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button onclick="window.location='{{ url("Patient") }}'" class="btn btn-primary shadow-md mr-2">Add Patient</button>
                    </div>
                </div>
                <!-- BEGIN: HTML Table Data -->
                <div class="intro-y box p-5 mt-5">
                    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                        <form id="tbPatient-html-filter-form" class="xl:flex sm:mr-auto" >
                        @csrf
                            <div class="sm:flex items-center sm:mr-4">
                                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Field</label>
                                <select id="tbPatient-html-filter-field" class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                                    <option value="hcNo">Register No</option>
                                    <option value="name">Name</option>
                                    <option value="phoneNo">Phone No</option>
                                </select>
                            </div>
                            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Type</label>
                                <select id="tbPatient-html-filter-type" class="form-select w-full mt-2 sm:mt-0 sm:w-auto" >
                                    <option value="like" selected>like</option>
                                    <option value="=">=</option>
                                </select>
                            </div>
                            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                                <input id="tbPatient-html-filter-value" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                            </div>
                            <div class="mt-2 xl:mt-0">
                                <button id="tbPatient-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16" >Go</button>
                                <button id="tbPatient-html-filter-reset" type="button" class="btn btn-dark w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1" >Reset</button>
                            </div>
                        </form>
                        <div class="flex mt-5 sm:mt-0">
                            <button id="tbPatient-print" class="btn btn-primary w-1/2 sm:w-auto mr-2"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </button>
                            <div class="dropdown w-1/2 sm:w-auto">
                                <button id="tbPatient-export-xlsx" class="btn btn-primary w-full sm:w-auto"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export as xlsx </button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto scrollbar-hidden">
                        <div id="tbPatient" class="mt-5 table-report table-report--tbPatient"></div>
                    </div>
                </div>
            </div>
                <!-- BEGIN: Modal Delete Patient --> 
                <div id="delete-modal-preview" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true"> 
                    <div class="modal-dialog"> <div class="modal-content"> 
                        <div class="modal-body p-0"> <div class="p-5 text-center"> 
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">Do you really want to delete these patient?</div> 
                            <div id="divHcNo" class="text-slate-500 mt-2">Patient Registered Number : <span></span></div> 
                        </div> 
                        <div class="px-5 pb-8 text-center">
                        <input id="txtUser" name="userId" value="{{ session('userId') }}" type="hidden" class="form-control" disabled>
                        <input id="txtId" name="id" type="hidden" class="form-control" disabled>
                                <button id="btnDelPatient" type="button" class="btn btn-danger w-24">Delete</button>
                             <button type="button" data-tw-dismiss="modal" class="btn btn-dark w-24 mr-1">Cancel</button>
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <!-- END: Modal Delete Patient --> 
            <!-- BEGIN: Error Modal Content --> 
 <div id="divPatientErrorModal" class="modal" tabindex="-1" aria-hidden="true"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-body p-0"> 
                <div class="p-5 text-center"> <i data-lucide="x-circle" class="w-16 h-16 text-warning mx-auto mt-3"></i> 
                <div id="divErrorHead"class="text-3xl mt-5"><span></span></div> 
                <div id="divErrorMsg" class="text-slate-500 mt-2"><span></span></div> </div> 
                <div class="px-5 pb-8 text-center"> 
                    <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> <!-- END: Error Modal Content --> 
     <!-- BEGIN: Modal View Patient --> 
     <div id="divViewPatient" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true"> 
        <div class="modal-dialog" style="width: 750px"> 
            <div class="modal-content">  
            <!--Close Button-->
            <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x-circle" class="w-8 h-8 text-danger"></i> </a>
            <!-- BEGIN: Modal Header -->
            <div class="modal-header"> 
                <h2 class="text-lg font-medium mr-auto">View</h2> 
                <!-- <button id="tbPrintPatient" class="btn btn-primary w-1/2 sm:w-auto mr-2"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </button> -->
                </div> 
                <!-- END: Modal Header -->
                 <!-- BEGIN: Modal Body --> 
                 <div class="modal-body box p-5">
                    <table id="tbViewPatient" class="table table-striped">
                        <tr><td>
                        <label for="lblHcNo" class="form-label sm:w-20">Register No : </label> 
                        </td><td  text-align: left;>
                        <label id="lblHcNo" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblName" class="form-label sm:w-20">Name : </label> 
                        </td><td  text-align: left;>
                        <label id="lblName" class="form-label sm:w-20"></label> 
                        </td></tr>
                        
                        <tr><td>
                        <label for="lblPhoneNo" class="form-label sm:w-20">Phone No : </label> 
                        </td><td>
                        <label id="lblPhoneNo" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblEmail" class="form-label sm:w-20">Email : </label> 
                        </td><td>
                        <label id="lblEmail" class="form-label sm:w-20"></label> 
                        </td></tr>

                        <tr><td>
                        <label for="lblDob" class="form-label sm:w-20">DOB : </label> 
                        </td><td>
                        <label id="lblDob" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblAge" class="form-label sm:w-20">Age : </label> 
                        </td><td>
                        <label id="lblAge" class="form-label sm:w-20"></label>  
                        </td></tr>
                        
                        <tr><td>
                        <label for="lblGender" class="form-label sm:w-20">Gender : </label> 
                        </td><td>
                        <label id="lblGender" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblBloodGrp" class="form-label sm:w-20">Blood Group: </label> 
                        </td><td>
                        <label id="lblBloodGrp" class="form-label sm:w-20"></label>  
                        </td></tr>

                        <tr><td>
                        <label for="lblMartialStatus" class="form-label sm:w-20">Martial Status : </label> 
                        </td><td>
                        <label id="lblMartialStatus" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblHeight" class="form-label sm:w-20">Patient Height : </label> 
                        </td><td>
                        <label id="lblHeight" class="form-label sm:w-20"></label>  
                        </td></tr>

                        <tr><td>
                        <label for="lblWeight" class="form-label sm:w-20">Patient Weight : </label> 
                        </td><td>
                        <label id="lblWeight" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblAddress" class="form-label sm:w-20">Address : </label> 
                        </td><td>
                        <label id="lblAddress" class="form-label sm:w-20"></label>  
                        </td></tr>

                        <tr><td>
                        <label for="lblCity" class="form-label sm:w-20">City : </label> 
                        </td><td>
                        <label id="lblCity" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblState" class="form-label sm:w-20">State : </label> 
                        </td><td>
                        <label id="lblState" class="form-label sm:w-20"></label>  
                        </td></tr>

                        <tr><td>
                        <label for="lblPincode" class="form-label sm:w-20">Pincode : </label> 
                        </td><td>
                        <label id="lblPincode" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblReason" class="form-label sm:w-20">Reason : </label> 
                        </td><td>
                        <label id="lblReason" class="form-label sm:w-20"></label>
                        </td></tr>                       

                        <tr><td>
                        <label for="lblSpouseName" class="form-label sm:w-20">Spouse Name : </label> 
                        </td><td>
                        <label id="lblSpouseName" class="form-label sm:w-20"></label> 
                        </td><td>
                        <label for="lblSpousePhNo" class="form-label sm:w-20">Spouse PhoneNo : </label> 
                        </td><td>
                        <label id="lblSpousePhNo" class="form-label sm:w-20"></label> 
                        </td></tr>

                    </table>
                 </div> 
                 <!-- END: Modal Body -->
              </div> 
            </div> 
        </div>
                <!-- END: Modal View Patient --> 
    </div>
@endsection

        @push('js')
        <script type="module" src="{{ asset('dist/js/app.js')}}"></script>
        @endpush



