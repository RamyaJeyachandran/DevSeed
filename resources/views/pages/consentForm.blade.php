@extends('layouts.main')
@section('title','Consent Form')
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
                    <input id="txtHospital" name="hostpialId" value="8" type="hidden" class="form-control">
                    <input id="txtBranch" name="branchId" type="hidden" class="form-control">
                    <div class="intro-y box p-5 mt-5">
                    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2 font-bold">Patient Registered Number </label>
                                <input id="txtRegNo" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0">
                            </div>
                            <div class="mt-2 xl:mt-0">
                                <button id="btnGo" type="button" class="btn btn-primary w-full sm:w-16" >Go</button>
                            </div>
                    </div>
                </div>

                    <!-- BEGIN: Profile Info -->
                <div id="divProfile" class=" hidden intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">Arnold Schwarzenegger</div>
                                <div class="text-slate-500">Backend Engineer</div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
                            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i> arnoldschwarzenegger@left4code.com </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="instagram" class="w-4 h-4 mr-2"></i> Instagram Arnold Schwarzenegger </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Twitter Arnold Schwarzenegger </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Twitter Arnold Schwarzenegger </div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-5">Sales Growth</div>
                            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i> arnoldschwarzenegger@left4code.com </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="instagram" class="w-4 h-4 mr-2"></i> Instagram Arnold Schwarzenegger </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Twitter Arnold Schwarzenegger </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Twitter Arnold Schwarzenegger </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Profile Info -->
                
                <div id="divFormList" class="hidden intro-y chat grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Side Menu -->
                    <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
                    <div class="intro-x cursor-pointer box relative flex items-center p-5 ">
                                    <div class="ml-2 overflow-hidden">
                                        <button id="btnSaveConsent" type="button" class="btn btn-primary" ><i data-lucide="save" class="w-4 h-4 mr-2"></i>Save Consent Form</button>
                                            <button id="btnPrintConsent" type="button" class="btn btn-primary" ><i data-lucide="printer" class="w-4 h-4 mr-2"></i>Print</button>
                                        </div>
                                    </div>
                        <div class="tab-content">
                            <div id="chats" class="tab-pane active" role="tabpanel" aria-labelledby="chats-tab">
                                <div id="divFormNameList" class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                                    <!-- Consent Form list begin -->
                                   
                                    <!-- Consent Form list End -->
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- END:  Side Menu -->
                    <!-- BEGIN: Chat Content -->
                    <div id="divFormContent" class="intro-y col-span-12 lg:col-span-8 2xl:col-span-9">
                        <div class="chat__box box">
                            <!-- BEGIN: Form Active -->
                            <div class="hidden h-full flex flex-col">
                                <div class="flex flex-col sm:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit relative">
                                            <i data-lucide="file" class="w-8 h-8 sm:w-10 sm:h-10 block bg-primary text-white rounded-full flex-none flex items-center justify-center mr-5"></i> 
                                        </div>
                                        <div class="ml-3 mr-auto">
                                            <div class="font-medium text-base"><span>Form - 1</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="divConsentContent" class="overflow-y-scroll scrollbar px-5 pt-5 flex-1">
                                   <!-- consent Form content -->
                                   <h1 style="text-align: center; margin: 4.25pt 59.75pt .0001pt 59.85pt;"><span style="font-family: 'Times New Roman',serif;">FORM<span style="letter-spacing: .05pt;"> </span>6</span></h1>
<p style="text-align: center; margin: 6.05pt 61.6pt .0001pt 59.85pt;"><strong><span style="font-size: 10.0pt;">[See<span style="letter-spacing: -.05pt;"> </span>rule<span style="letter-spacing: -.05pt;"> </span>13(f)<span style="letter-spacing: -.1pt;"> </span>(i)<span style="letter-spacing: -.05pt;"> </span>]</span></strong></p>
<h1 style="text-align: center; margin: 6.05pt 60.2pt .0001pt 59.85pt;"><span style="font-family: 'Times New Roman',serif;">Consent<span style="letter-spacing: -.1pt;"> </span>Form<span style="letter-spacing: -.3pt;"> </span>to be<span style="letter-spacing: -.05pt;"> </span>Signed by<span style="letter-spacing: -.05pt;"> </span>the<span style="letter-spacing: -.05pt;"> </span>Couple<span style="letter-spacing: -.05pt;"> </span>or<span style="letter-spacing: -.1pt;"> </span>Woman</span></h1>
<p style="tab-stops: 44.7pt 88.15pt 151.2pt 188.05pt; margin: 5.65pt .2pt .0001pt 0cm;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style="text-align: center; tab-stops: 44.7pt 88.15pt 151.2pt 188.05pt; margin: 5.65pt .2pt .0001pt 0cm;">I/We&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; have&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; requested&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; clinic <strong><span style="color: red;">HOSPITAL NAME AND ADDRESS </span></strong>&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p style="margin-right: 60.05pt;">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..&hellip;&hellip;&hellip;&hellip;.<span style="letter-spacing: .8pt;"> </span>(name<span style="letter-spacing: .8pt;"> </span>and<span style="letter-spacing: .85pt;"> </span>address<span style="letter-spacing: .75pt;"> </span>of<span style="letter-spacing: .7pt;"> </span>clinic)<span style="letter-spacing: .85pt;"> </span>to<span style="letter-spacing: .85pt;"> </span>provide<span style="letter-spacing: .8pt;"> </span>us<span style="letter-spacing: -2.35pt;"> </span>with<span style="letter-spacing: -.1pt;"> </span>treatment<span style="letter-spacing: -.05pt;"> </span>services<span style="letter-spacing: -.05pt;"> </span>to<span style="letter-spacing: .05pt;"> </span>help<span style="letter-spacing: .15pt;"> </span>us<span style="letter-spacing: -.05pt;"> </span>bear<span style="letter-spacing: -.05pt;"> </span>a child.</p>
<p style="margin-top: 6.05pt;">We<span style="letter-spacing: -.15pt;"> </span>understand<span style="letter-spacing: -.05pt;"> </span>and<span style="letter-spacing: -.05pt;"> </span>accept<span style="letter-spacing: -.2pt;"> </span>(as<span style="letter-spacing: -.15pt;"> </span>applicable)<span style="letter-spacing: -.05pt;"> </span>that:</p>
<p style="tab-stops: 44.7pt 88.15pt 151.2pt 188.05pt; margin: 5.65pt .2pt .0001pt 0cm;">&nbsp;</p>
<ol>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">The ***** that are used to stimulate the ovaries for ovulation induction have temporary side- effects **** nausea,<span style="letter-spacing: .05pt;"> </span>headaches<span style="letter-spacing: .05pt;"> </span>and<span style="letter-spacing: .05pt;"> </span>abdominal<span style="letter-spacing: .05pt;"> </span><span style="letter-spacing: .05pt;"> </span>Only<span style="letter-spacing: .05pt;"> </span>in<span style="letter-spacing: .05pt;"> </span>a<span style="letter-spacing: .05pt;"> </span>small<span style="letter-spacing: .05pt;"> </span>proportion<span style="letter-spacing: .05pt;"> </span>of<span style="letter-spacing: .05pt;"> </span>cases,<span style="letter-spacing: .05pt;"> </span>a<span style="letter-spacing: .05pt;"> </span>condition<span style="letter-spacing: .05pt;"> </span>called<span style="letter-spacing: .05pt;"> </span>ovarian<span style="letter-spacing: .05pt;"> </span>hyperstimulation occurs where there is ** exaggerated ******* response.<span style="letter-spacing: .05pt;"> </span>Such cases can be identified ***** of<span style="letter-spacing: .05pt;"> </span>time *** only to a limited extent.<span style="letter-spacing: .05pt;"> </span>Further, at times the ovarian response is poor or absent in spite of using a high<span style="letter-spacing: .05pt;"> </span>dose<span style="letter-spacing: -.05pt;"> </span>of<span style="letter-spacing: -.1pt;"> </span>drugs.<span style="letter-spacing: 2.45pt;"> </span>Under these circumstances, the<span style="letter-spacing: -.05pt;"> </span>treatment<span style="letter-spacing: -.05pt;"> </span>cycle<span style="letter-spacing: .1pt;"> </span>will<span style="letter-spacing: -.05pt;"> </span>be<span style="letter-spacing: -.05pt;"> </span>cancelled.</span></li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">There<span style="letter-spacing: -.1pt;"> </span>is<span style="letter-spacing: -.15pt;"> </span>no<span style="letter-spacing: -.05pt;"> </span>guarantee<span style="letter-spacing: -.1pt;"> </span>that:</span>
        <ul>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">The<span style="letter-spacing: -.1pt;"> </span>oocytes will<span style="letter-spacing: -.15pt;"> </span>be<span style="letter-spacing: -.1pt;"> </span>retrieved<span style="letter-spacing: -.05pt;"> </span>in<span style="letter-spacing: -.1pt;"> </span>all<span style="letter-spacing: -.1pt;"> </span></span></li>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">The<span style="letter-spacing: -.15pt;"> </span>oocytes will<span style="letter-spacing: -.2pt;"> </span>be<span style="letter-spacing: .05pt;"> </span></span></li>
            <li><span style="font-size: 10.0pt; line-height: 151%;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt; line-height: 151%;">Even<span style="letter-spacing: -.2pt;"> </span>if<span style="letter-spacing: -.2pt;"> </span>there<span style="letter-spacing: .05pt;"> </span>were<span style="letter-spacing: .05pt;"> </span>fertilization,<span style="letter-spacing: -.1pt;"> </span>the<span style="letter-spacing: -.1pt;"> </span>resulting<span style="letter-spacing: -.15pt;"> </span>embryos<span style="letter-spacing: -.05pt;"> </span>would<span style="letter-spacing: .05pt;"> </span>be<span style="letter-spacing: -.1pt;"> </span>of<span style="letter-spacing: -.2pt;"> </span>suitable<span style="letter-spacing: -.1pt;"> </span>quality<span style="letter-spacing: -.3pt;"> </span>to<span style="letter-spacing: -.05pt;"> </span>be<span style="letter-spacing: -.1pt;"> </span><span style="letter-spacing: -2.4pt;"> </span>All<span style="letter-spacing: -.1pt;"> </span>these unforeseen<span style="letter-spacing: -.1pt;"> </span>situations<span style="letter-spacing: .1pt;"> </span>will<span style="letter-spacing: -.05pt;"> </span>result<span style="letter-spacing: -.1pt;"> </span>in<span style="letter-spacing: -.05pt;"> </span>the cancellation of<span style="letter-spacing: -.1pt;"> </span>any<span style="letter-spacing: -.2pt;"> </span>treatment.</span></li>
        </ul>
    </li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">I/ We fully consent to these procedures and to the ************** of such drugs and anesthetics as may be<span style="letter-spacing: .05pt;"> </span> We also consent to any ***** operative measures, ***** may be found to be necessary in the<span style="letter-spacing: .05pt;"> </span>course<span style="letter-spacing: -.05pt;"> </span>of<span style="letter-spacing: -.1pt;"> </span>the treatment.</span></li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">I/<span style="letter-spacing: -.15pt;"> </span>We<span style="letter-spacing: -.1pt;"> </span>have<span style="letter-spacing: -.05pt;"> </span>been<span style="letter-spacing: -.15pt;"> </span>told of<span style="letter-spacing: -.2pt;"> </span>the<span style="letter-spacing: -.05pt;"> </span>risks<span style="letter-spacing: -.15pt;"> </span>of ultrasound<span style="letter-spacing: -.05pt;"> </span>directed follicle<span style="letter-spacing: -.1pt;"> </span></span></li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">I/ We are aware that we *** free to ******** or **** the ***** of **** consent until the gametes and/ or<span style="letter-spacing: .05pt;"> </span>embryos have been used in ********** with my/ *** wishes. I am aware that this will have to be a written<span style="letter-spacing: .05pt;"> </span>request</span></li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">There ** no certainty that a pregnancy will result from these ********** even in cases ***** **** quality<span style="letter-spacing: .05pt;"> </span>embryos<span style="letter-spacing: -.1pt;"> </span>are transferred.</span></li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">If a ******** ********* does result from assisted conception treatment, I/ ** understand ***** is an accepted<span style="letter-spacing: .05pt;"> </span>risk of multiple pregnancy, an ectopic pregnancy or of a miscarriage. I/ We understand that as ** natural<span style="letter-spacing: .05pt;"> </span>conception,<span style="letter-spacing: -.05pt;"> </span>there is<span style="letter-spacing: -.05pt;"> </span>a small<span style="letter-spacing: -.05pt;"> </span>risk<span style="letter-spacing: -.05pt;"> </span>of<span style="letter-spacing: .05pt;"> </span>fetal abnormality.</span></li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">Medical<span style="letter-spacing: .45pt;"> </span>and<span style="letter-spacing: .55pt;"> </span>scientific<span style="letter-spacing: .6pt;"> </span>staff<span style="letter-spacing: .4pt;"> </span>can<span style="letter-spacing: .45pt;"> </span>give<span style="letter-spacing: .5pt;"> </span>no<span style="letter-spacing: .5pt;"> </span>assurance<span style="letter-spacing: .5pt;"> </span>that<span style="letter-spacing: .45pt;"> </span>any<span style="letter-spacing: .55pt;"> </span>pregnancy<span style="letter-spacing: .55pt;"> </span>will<span style="letter-spacing: .45pt;"> </span>result<span style="letter-spacing: .4pt;"> </span>in<span style="letter-spacing: .4pt;"> </span>the<span style="letter-spacing: .5pt;"> </span>delivery<span style="letter-spacing: .3pt;"> </span>of<span style="letter-spacing: .4pt;"> </span>a<span style="letter-spacing: .6pt;"> </span>normal<span style="letter-spacing: -2.35pt;"> </span>living<span style="letter-spacing: -.1pt;"> </span></span></li>
    <li><span style="font-size: 10.0pt; line-height: 150%;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt; line-height: 150%;">The<span style="letter-spacing: -.1pt;"> </span>uncertainty<span style="letter-spacing: -.3pt;"> </span>of<span style="letter-spacing: -.2pt;"> </span>the<span style="letter-spacing: -.1pt;"> </span>outcome<span style="letter-spacing: -.1pt;"> </span>of<span style="letter-spacing: -.2pt;"> </span>the<span style="letter-spacing: -.1pt;"> </span>procedure<span style="letter-spacing: -.1pt;"> </span>has<span style="letter-spacing: -.15pt;"> </span>been<span style="letter-spacing: -.15pt;"> </span>fully<span style="letter-spacing: -.15pt;"> </span>explained<span style="letter-spacing: -.05pt;"> </span>to<span style="letter-spacing: .05pt;"> </span>me/ us.<span style="letter-spacing: -2.35pt;"> </span>I/<span style="letter-spacing: -.1pt;"> </span>We fully<span style="letter-spacing: -.1pt;"> </span>understand<span style="letter-spacing: .05pt;"> </span>the risks<span style="letter-spacing: -.1pt;"> </span>of<span style="letter-spacing: -.1pt;"> </span>treatment<span style="letter-spacing: -.1pt;"> </span>including;</span>
        <ul>
            <li><span style="font-size: 10.0pt; line-height: 152%;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt; line-height: 152%;">it<span style="letter-spacing: -.15pt;"> </span>is<span style="letter-spacing: -.15pt;"> </span>not<span style="letter-spacing: -.15pt;"> </span>possible<span style="letter-spacing: -.05pt;"> </span>to<span style="letter-spacing: -.05pt;"> </span>guarantee<span style="letter-spacing: -.1pt;"> </span>that<span style="letter-spacing: -.1pt;"> </span>a<span style="letter-spacing: -.05pt;"> </span>follicle will<span style="letter-spacing: -.15pt;"> </span>develop<span style="letter-spacing: -.05pt;"> </span>in<span style="letter-spacing: -.15pt;"> </span>a<span style="letter-spacing: .05pt;"> </span>given<span style="letter-spacing: -.15pt;"> </span>cycle<span style="letter-spacing: -.1pt;"> </span>and<span style="letter-spacing: -.05pt;"> </span>that<span style="letter-spacing: -2.35pt;"> </span>occasionally<span style="letter-spacing: -.25pt;"> </span>cycles<span style="letter-spacing: -.05pt;"> </span>have<span style="letter-spacing: -.05pt;"> </span>to<span style="letter-spacing: .05pt;"> </span>be abandoned before egg<span style="letter-spacing: -.1pt;"> </span></span></li>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">there<span style="letter-spacing: -.1pt;"> </span>is<span style="letter-spacing: -.15pt;"> </span>a<span style="letter-spacing: -.1pt;"> </span>risk<span style="letter-spacing: -.15pt;"> </span>that spontaneous<span style="letter-spacing: -.15pt;"> </span>ovulation<span style="letter-spacing: -.15pt;"> </span>can<span style="letter-spacing: -.1pt;"> </span>happen<span style="letter-spacing: -.15pt;"> </span>prior<span style="letter-spacing: -.1pt;"> </span>to/or<span style="letter-spacing: -.1pt;"> </span>during<span style="letter-spacing: -.15pt;"> </span>the<span style="letter-spacing: -.1pt;"> </span>egg<span style="letter-spacing: -.15pt;"> </span></span></li>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">an<span style="letter-spacing: -.15pt;"> </span>egg<span style="letter-spacing: -.1pt;"> </span>is<span style="letter-spacing: -.05pt;"> </span>not<span style="letter-spacing: -.1pt;"> </span>always<span style="letter-spacing: -.15pt;"> </span>recovered from<span style="letter-spacing: -.3pt;"> </span>a<span style="letter-spacing: -.05pt;"> </span>follicle<span style="letter-spacing: -.1pt;"> </span>at<span style="letter-spacing: -.05pt;"> </span>the<span style="letter-spacing: -.1pt;"> </span>time<span style="letter-spacing: -.05pt;"> </span>of<span style="letter-spacing: -.05pt;"> </span>egg<span style="letter-spacing: -.1pt;"> </span></span></li>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">any<span style="letter-spacing: -.3pt;"> </span>eggs<span style="letter-spacing: .05pt;"> </span>may<span style="letter-spacing: -.3pt;"> </span>be<span style="letter-spacing: -.05pt;"> </span>collected and<span style="letter-spacing: .05pt;"> </span>fertilization<span style="letter-spacing: -.1pt;"> </span>of<span style="letter-spacing: .05pt;"> </span>any<span style="letter-spacing: -.1pt;"> </span>collected<span style="letter-spacing: -.05pt;"> </span>eggs<span style="letter-spacing: .05pt;"> </span>will<span style="letter-spacing: -.1pt;"> </span>occur</span></li>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">is<span style="letter-spacing: 1.1pt;"> </span>a<span style="letter-spacing: 1.2pt;"> </span>risk<span style="letter-spacing: 1.1pt;"> </span>that<span style="letter-spacing: 1.2pt;"> </span>the<span style="letter-spacing: 1.2pt;"> </span>cycle<span style="letter-spacing: 1.3pt;"> </span>will<span style="letter-spacing: 1.2pt;"> </span>be<span style="letter-spacing: 1.2pt;"> </span>abandoned<span style="letter-spacing: 1.25pt;"> </span>before<span style="letter-spacing: 1.2pt;"> </span>Embryo<span style="letter-spacing: 1.2pt;"> </span>Transfer<span style="letter-spacing: 1.25pt;"> </span>if<span style="letter-spacing: 1.1pt;"> </span>there<span style="letter-spacing: 1.15pt;"> </span>is<span style="letter-spacing: 1.2pt;"> </span>failure<span style="letter-spacing: 1.2pt;"> </span>of<span style="letter-spacing: 1.2pt;"> </span>fertilization,<span style="letter-spacing: -2.35pt;"> </span>abnormal<span style="letter-spacing: -.05pt;"> </span>fertilization<span style="letter-spacing: -.05pt;"> </span>or failure<span style="letter-spacing: -.05pt;"> </span>of<span style="letter-spacing: -.1pt;"> </span>the embryo<span style="letter-spacing: .05pt;"> </span>** cleave(divide)</span></li>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">a<span style="letter-spacing: -.1pt;"> </span>pregnancy<span style="letter-spacing: -.05pt;"> </span>may<span style="letter-spacing: -.3pt;"> </span>result from<span style="letter-spacing: -.3pt;"> </span></span></li>
            <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">treatment<span style="letter-spacing: 1.35pt;"> </span>may<span style="letter-spacing: 1.15pt;"> </span>be<span style="letter-spacing: 1.25pt;"> </span>abandoned<span style="letter-spacing: 1.35pt;"> </span>at<span style="letter-spacing: 1.25pt;"> </span>any<span style="letter-spacing: 1.2pt;"> </span>time<span style="letter-spacing: 1.25pt;"> </span>if<span style="letter-spacing: 1.2pt;"> </span>there<span style="letter-spacing: 1.25pt;"> </span>are<span style="letter-spacing: 1.25pt;"> </span>problems<span style="letter-spacing: 1.25pt;"> </span>in<span style="letter-spacing: 1.2pt;"> </span>the<span style="letter-spacing: 1.25pt;"> </span>laboratory<span style="letter-spacing: 1.1pt;"> </span>or<span style="letter-spacing: 1.4pt;"> </span>with<span style="letter-spacing: 1.2pt;"> </span>the<span style="letter-spacing: 1.25pt;"> </span>culture<span style="letter-spacing: -2.35pt;"> </span>system</span></li>
        </ul>
    </li>
    <li><span style="font-size: 10.0pt;"><span style="font: 7.0pt 'Times New Roman';"> </span></span><span style="font-size: 10.0pt;">I/ We have been ***** ******** of *** that is involved **** the IVF/ICSI technique and have been advised<span style="letter-spacing: .05pt;"> </span>regarding<span style="letter-spacing: .05pt;"> </span>the<span style="letter-spacing: .05pt;"> </span>chances<span style="letter-spacing: .05pt;"> </span>of<span style="letter-spacing: .05pt;"> </span>success,<span style="letter-spacing: .05pt;"> </span>the<span style="letter-spacing: .05pt;"> </span>possibility<span style="letter-spacing: .05pt;"> </span>of<span style="letter-spacing: .05pt;"> </span>multiple<span style="letter-spacing: .05pt;"> </span>pregnancy<span style="letter-spacing: .05pt;"> </span>occurring<span style="letter-spacing: .05pt;"> </span>and<span style="letter-spacing: .05pt;"> </span>other<span style="letter-spacing: .05pt;"> </span>possible<span style="letter-spacing: .05pt;"> </span>complications of treatment by the doctor. I/ We have also ******** *********** relating ** treatment by these<span style="letter-spacing: .05pt;"> </span>techniques<span style="letter-spacing: -.1pt;"> </span>in<span style="letter-spacing: -.05pt;"> </span>***** to<span style="letter-spacing: .05pt;"> </span>assist<span style="letter-spacing: -.1pt;"> </span>us<span style="letter-spacing: .05pt;"> </span>to become<span style="letter-spacing: .15pt;"> </span>more<span style="letter-spacing: -.05pt;"> </span>fully<span style="letter-spacing: -.05pt;"> </span>aware<span style="letter-spacing: -.05pt;"> </span>of<span style="letter-spacing: .05pt;"> </span>what<span style="letter-spacing: -.1pt;"> </span>is<span style="letter-spacing: -.05pt;"> </span></span></li>
</ol>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 0cm;">&nbsp;</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 0cm;">&nbsp;</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 0cm;">&nbsp;</p>
<p style="text-align: center; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;"><strong>Endorsement ** the ART clinic</strong></p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">I/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; we&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; have&nbsp;&nbsp;&nbsp;&nbsp; personally&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; explained&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to &hellip;&hellip;<strong><span style="color: red;">PATIENT NAME</span></strong> &hellip; and</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;"><strong><span style="color: red;">SPOUSE NAME</span></strong>&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip; *** details and implications of *** / her / their signing this consent / approval form, and made **** to the extent ******* possible that he /she /they understand ***** details and implications.</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">&nbsp;</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">This ******* would hold **** for *** the cycles performed at the clinic.</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">Name and Signature of the couple (husband and wife) ** Woman</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">Name, Address &amp;Signature of *** Witness from *** Clinic</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">Name and Signature of the Doctor</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">**** and Address of the ART Clinic</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 72.0pt;">Dated: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 0cm;">&nbsp;</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 0cm;">&nbsp;</p>
<p style="text-align: justify; tab-stops: 96.05pt; text-autospace: none; margin: 5.9pt 60.2pt .0001pt 0cm;">&nbsp;</p>

                                   <!--consent form end-->
                                </div>
                            </div>
                            <!-- END: Chat Active -->
                            <!-- BEGIN: Chat Default -->
                            <div class="h-full flex items-center">
                                <div class="mx-auto text-center">
                                    <div class="w-16 h-16 flex-none image-fit rounded-full overflow-hidden mx-auto">
                                    <i data-lucide="file" class="w-8 h-8 sm:w-10 sm:h-10 block bg-primary text-white rounded-full flex-none flex items-center justify-center mr-5"></i> 
                                    </div>
                                    <div class="mt-3">
                                        <div class="font-medium">Please click the form to view</div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Chat Default -->
                        </div>
                    </div>
                    <!-- END: Chat Content -->
                </div>
            </div>
            <!-- END: Content -->
                        <!-- BEGIN: Error Modal Content --> 
 <div id="divConsentErrorModal" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true"> 
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

            </div>
@endsection

        @push('js')
        <script src="{{ asset('dist/js/app.js')}}"></script>
        @endpush
