@extends('layouts.main')
@section('title','Hospital Information')
@section('username','User Name')
@section ('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}" />

@endsection 
@section('content')
    @include('layouts.mobileSideMenu')
    <div class="flex mt-[4.7rem] md:mt-0">
        @include('layouts.sideMenu')
                <!-- BEGIN: Content -->
                <div class="content">
                    @include('layouts.topBar')
                    <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box">
                            <div id="input" class="p-5">
                                <div class="preview">
                                    <div>
                                        <label for="txtHospitalName" class="form-label">Hospital Name</label>
                                        <input id="txtHospitalName" type="text" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="txtAddress" class="form-label">Address</label>
                                        <textarea id="txtAddress" class="form-control" minlength="10"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="txtPhoneNo" class="form-label">Phone No</label>
                                        <input id="txtPhoneNo" type="text" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="txtEmail" class="form-label">Email Id</label>
                                        <input id="txtEmail" type="text" class="form-control" placeholder="example@gmail.com">
                                    </div>
                                    <div class="mt-3">
                                        <label for="txtContact" class="form-label">Contact Person</label>
                                        <input id="txtContact" type="text" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="txtContactPhNo" class="form-label">Contact Person Phone No</label>
                                        <input id="txtContactPhNo" type="text" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <button id="btnSavePatient" type=submit class="btn btn-primary w-24 ml-2">Register</button>
                                        <button class="btn btn-dark w-24 ">Cancel</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Input -->
                        
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Login Form -->
                        <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">
                                    Login Information
                                </h2>
                            </div>
                            <div id="vertical-form" class="p-5">
                                <div class="preview">
                                    <div>
                                        <label for="txtUserName" class="form-label">User Name</label>
                                        <input id="txtUserName" type="text" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="txtPassword" class="form-label">Password</label>
                                        <input id="txtPassword" name="password" type="password" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="txtConfirmPassword" class="form-label">Confirm Password</label>
                                        <input id="txtConfirmPassword" name="password" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Vertical Form -->
                    </div>
                </div>
                <!-- END: Content -->
    </div></div>
@endsection

        @push('js')
        <script src="{{ asset('js/app.js')}}"></script>
        @endpush



