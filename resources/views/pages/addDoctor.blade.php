@extends('layouts.main')
@section('title','Doctor Information')
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
                    <form id="frmDoctor" method="POST" enctype="multipart/form-data">
                    <div class="intro-y box p-5 mt-5">
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    
                    <input id="txtHospital" name="hostpialId" value="1" type="hidden" class="form-control">
                    <input id="txtBranch" name="branchId" type="hidden" class="form-control">
                    <input id="txtUser" name="userId" value="1" type="hidden" class="form-control">
                            <div class="intro-y col-span-12  form-control">
                                <label for="txtProfileImage" class="form-label">Profile Image </label>
                                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                    <img id="imgProfileImage" class="rounded-full" src="dist/images/profile-11.jpg">
                                </div>
                                <input id="txtProfileImage" name="profileImage" accept="image/*" type="file" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4 form-control">
                                <label for="txtName" class="form-label">Doctor Name <span class="text-danger mt-2"> *</span></label>
                                <input id="txtName" name="name" type="text" class="form-control" required>
                            </div>
                            
                            <div class="intro-y col-span-12 sm:col-span-4 form-control">
                                <label for="txtPhoneNo" class="form-label">Phone No <span class="text-danger mt-2"> *</span></label>
                                <input id="txtPhoneNo" name="phoneNo" type="text" class="form-control" required>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4 form-control">
                                <label for="txtEmail" class="form-label">Email Id <span class="text-danger mt-2"> *</span></label>
                                <input id="txtEmail" name="email" type="email" class="form-control" placeholder="example@gmail.com" required>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4 form-control">
                                <label for="txtPassword" class="form-label">Password</label>
                                <input id="txtPassword" name="password" type="password" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="txtDOB" class="form-label">Date of Birth</label>
                                <input id="txtDOB"name="dob" type="text" class="datepicker form-control " data-single-mode="true"> 
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="ddlGender" class="form-label">Gender</label>
                                <select id="ddlGender" name="gender" class="form-select" required>
                                    <option value='0'>Select Gender</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="ddlBloodGrp" class="form-label">Blood Group</label>
                                <select id="ddlBloodGrp" name="bloodGrp" class="form-select">
                                    <option value='0'>Select Blood Group</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="txteducation" class="form-label">Eductation</label>
                                <input id="txteducation" name="education" type="text" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="txtdesignation" class="form-label">Designation</label>
                                <input id="txtdesignation" name="designation" type="text" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="ddlDepartment" class="form-label">Department</label>
                                <select id="ddlDepartment" name="department" class="form-select">
                                    <option value='0'>Select Department</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="txtExperience" class="form-label">Experience</label>
                                <input id="txtExperience" name="experience" type="text" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-4">
                                <label for="txtAddress" class="form-label">Address</label>
                                <textarea id="txtAddress" name="address" class="form-control" minlength="10"></textarea>
                            </div>
                                                       
                            <div class="intro-y col-span-12 justify-center sm:justify-end mt-5">
                                <button id="btnSaveDoctor" type=submit class="btn btn-primary w-24 ml-2">Register</button>
                                <button id="btnCancelDoctor" type="reset" class="btn btn-dark w-24">Cancel</button> 
                            </div>
                        </div></div></div>
                        </div></div>
                        </form>
                      
                      <div id="failed-notification-content" class="toastify-content hidden flex" >
                                        <i class="text-danger" data-lucide="x-circle"></i> 
                                        <div class="ml-4 mr-4">
                                            <div class="font-medium">Error</div>
                                            <div class="text-slate-500 mt-1"> Please enter the required field marked as *. </div>
                                        </div>
                                    </div>
                                    <!-- END: Failed Notification Content -->
</div>
                <!-- END: Content -->
    </div>
    <!-- BEGIN: Success Modal Content --> 
        <div id="success-modal-preview" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true"> 
            <div class="modal-dialog"> <div class="modal-content"> <div class="modal-body p-0"> 
                <div class="p-5 text-center"> <i data-lucide="check-circle" class="w-16 h-16 text-success mx-auto mt-3"></i>
                 <div id="divDrMsg" class="text-3xl mt-5"><span></span></div> <div id="divDoctorCodeNo" class="text-slate-500 mt-2"><span></span></div>
                 <div id="divDrLogin" class="text-slate-500 mt-2"><span></span></div> </div>
                  <div class="px-5 pb-8 text-center"> <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Ok</button>
                 </div> 
                </div> 
            </div> 
        </div> 
    </div> 
<!-- END: Success Modal Content --> 
 <!-- BEGIN: Error Modal Content --> 
 <div id="divDoctorErrorModal" class="modal" tabindex="-1" aria-hidden="true"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-body p-0"> 
                <div class="p-5 text-center"> <i data-lucide="x-circle" class="w-16 h-16 text-warning mx-auto mt-3"></i> 
                <div id="divDrErrorHead"class="text-3xl mt-5"><span></span></div> 
                <div id="divDrErrorMsg" class="text-slate-500 mt-2"><span></span></div> </div> 
                <div class="px-5 pb-8 text-center"> 
                    <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> <!-- END: Error Modal Content --> 
@endsection

        @push('js')
        <script type="module" src="{{ asset('dist/js/app.js')}}"></script>
        @endpush



