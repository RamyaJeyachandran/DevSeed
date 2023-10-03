import xlsx from "xlsx";
import { createIcons, icons } from "lucide";
import Tabulator from "tabulator-tables";

(function () {
    "use strict";
    window.onbeforeunload = function() {
        window.scrollTo(0, 0);
    };
   
window.addEventListener("load", (e) => {
    e.preventDefault();
    
    var pathname = window.location.pathname;
    var base_url = window.location.origin;

    var searchPatient="showPatient";
    if(pathname.indexOf(searchPatient) != -1){
        pathname=searchPatient;
    }
    var SearchDoctor="showDoctor";
    if(pathname.indexOf(SearchDoctor) != -1){
        pathname=SearchDoctor;
    }
    var SearchHospital="showHospital";
    if(pathname.indexOf(SearchHospital) != -1){
        pathname=SearchHospital;
    }
    var SearchBranch="showBranch";
    if(pathname.indexOf(SearchBranch) != -1){
        pathname=SearchBranch;
    }

    function setMenu($lnkControl,$ulControl){
        $($lnkControl).addClass("side-menu--active");
        $($ulControl).addClass("side-menu__sub-open");
    }
    function setMobileMenu($lnkMobile,$ulMobile,$aMobile,$asMobile,$search){
        $($lnkMobile).addClass("menu--active");
        $($ulMobile).addClass("menu__sub-open");
        if($search==1){
            $($asMobile).addClass("menu--active");
        }else{
            $($aMobile).addClass("menu--active");
        }
    }
    console.log(pathname);
    switch(pathname){
        case '/login':
        case '/Hospital':
            sessionDetails();
            setMenu("[id*=lnkHospital]","[id*=ulHospital]");
            setMobileMenu("[id*=lnkMobileHospital]","[id*=ulMobileHospital]","[id*=aMobileHospital]","[id*=aMobileHpSearch]",0);
            $("#imgLogo").on('change',function() {
                $(imgLogo).attr("src",$(txtLogo).val());
            });
                break;
        case '/SearchHospital':
            setMenu("[id*=lnkHospital]","[id*=ulHospital]");
            setMobileMenu("[id*=lnkMobileHospital]","[id*=ulMobileHospital]","[id*=aMobileHospital]","[id*=aMobileHpSearch]",1);
            setHospitalTabulator();
            break;
        case 'showHospital':
            setMenu("[id*=lnkHospital]","[id*=ulHospital]");
            setMobileMenu("[id*=lnkMobileHospital]","[id*=ulMobileHospital]","[id*=aMobileHospital]","[id*=aMobileHpSearch]",0);
            $("#imgLogo").on('change',function() {
                $(imgLogo).attr("src",$(txtLogo).val());
                $("#isImageChanged").val(1);
            });
            break;
        case '/Doctor':
            $("#txtDOB").val('');
            setMenu("[id*=lnkDoctor]","[id*=ulDoctor]");
            setMobileMenu("[id*=lnkMobileDoctor]","[id*=ulMobileDoctor]","[id*=aMobileDoctor]","[id*=aMobileDrSearch]",0);
            $("#txtProfileImage").on('change',function() {
                $(imgProfileImage).attr("src",$(txtProfileImage).val());
            
            });
            addDoctorLoadEvent(base_url);
            break;
        case '/SearchDoctor':
            setMenu("[id*=lnkDoctor]","[id*=ulDoctor]");
            setMobileMenu("[id*=lnkMobileDoctor]","[id*=ulMobileDoctor]","[id*=aMobileDoctor]","[id*=aMobileDrSearch]",1);
            setDoctorTabulator();
            break;
        case "showDoctor":
            setMenu("[id*=lnkDoctor]","[id*=ulDoctor]");
            setMobileMenu("[id*=lnkMobileDoctor]","[id*=ulMobileDoctor]","[id*=aMobileDoctor]","[id*=aMobileDrSearch]",0);
            $("#txtProfileImage").on('change',function() {
                $(imgProfileImage).attr("src",$(txtProfileImage).val());
                $("#isImageChanged").val(1);
            });
            break;
        case '/Patient':
            setMenu("[id*=lnkPatient]","[id*=ulPatient]");
            setMobileMenu("[id*=lnkMobilePatient]","[id*=ulMobilePatient]","[id*=aMobilePatients]","[id*=aMobilePatientSearch]",0);
            addPatientLoadEvent(pathname,base_url);
            break;
        case '/SearchPatient':
            setMenu("[id*=lnkPatient]","[id*=ulPatient]");
            setMobileMenu("[id*=lnkMobilePatient]","[id*=ulMobilePatient]","[id*=aMobilePatients]","[id*=aMobilePatientSearch]",1);
                setTabulator();
            break;
        case 'showPatient':
            setMenu("[id*=lnkPatient]","[id*=ulPatient]");
            setMobileMenu("[id*=lnkMobilePatient]","[id*=ulMobilePatient]","[id*=aMobilePatients]","[id*=aMobilePatientSearch]",0);
            if($( "#ddlRefferedBy" ).val()=='Doctor'){
                $( "#divDocName" ).show();
                $( "#divDocHpName" ).show();
                $( "#divDocName" ).focus();
            }else{
                $( "#divDocName" ).hide();
                $( "#divDocHpName" ).hide();
            }
        break;
        case '/Branch':
            setMenu("[id*=lnkBranch]","[id*=ulBranch]");
            setMobileMenu("[id*=lnkMobileBranch]","[id*=ulMobileBranch]","[id*=aMobileBranch]","[id*=aMobileBrSearch]",0);
            addBranchLoadEvent(base_url);
            $("#imgLogo").on('change',function() {
                $(imgLogo).attr("src",$(txtLogo).val());
            });
            break;
        case '/SearchBranch':
            setMenu("[id*=lnkBranch]","[id*=ulBranch]");
            setMobileMenu("[id*=lnkMobileBranch]","[id*=ulMobileBranch]","[id*=aMobileBranch]","[id*=aMobileBrSearch]",1);
            setBranchTabulator();
            break;
        case 'showBranch':
            setMenu("[id*=lnkBranch]","[id*=ulBranch]");
            setMobileMenu("[id*=lnkMobileBranch]","[id*=ulMobileBranch]","[id*=aMobileBranch]","[id*=aMobileBrSearch]",0);
            $("#imgLogo").on('change',function() {
                $(imgLogo).attr("src",$(txtLogo).val());
                $("#isImageChanged").val(1);
            });
            break;
        case "/ConsentForm":
            $("[id*=lnkConsentForm]").addClass("side-menu--active");
            $("[id*=lnkMobileConsent]").addClass("menu--active");
            consentFormOnLoad();
            break;
        case "/subscribe":
            $("[id*=lnkSubscribe]").addClass("side-menu--active");
            $("[id*=lnkMobileSubscribe]").addClass("menu--active");
            break;

    }
    return;
  });
  /* ------------------------------------------ Add Patient Begin -----------------------*/
  function addPatientLoadEvent(pathname,base_url){
    if(pathname=='/Patient')
    {
        $("#txtDOB").val('');
        $( "#divDocName" ).hide();
        $( "#divDocHpName" ).hide();
    }
        let options = {
            method: 'GET'
        }
        var url=base_url+'/api/getCommonData';
        fetch(url,options)
                .then(response => response.json())
                .then(function (result) {
                    var listCity=result.cities;
                    listCity.forEach(function(value, key) {
                        $("#ddlState").append($("<option></option>").val(value.city_state).html(value.city_state)); 
                    });
    
                    var listGender=result.gender;
                    listGender.forEach(function(value, key) {
                        $("#ddlGender").append($("<option></option>").val(value.name).html(value.name)); 
                    });
    
                    var listMartialStatus=result.martialStatus;
                    listMartialStatus.forEach(function(value, key) {
                        $("#ddlmartialStatus").append($("<option></option>").val(value.name).html(value.name)); 
                    });
    
                    var listRefferedBy=result.refferedBy;
                    listRefferedBy.forEach(function(value, key) {
                        $("#ddlRefferedBy").append($("<option></option>").val(value.name).html(value.name)); 
                    });
    
                    var listBloodGrp=result.bloodGrp;
                     listBloodGrp.forEach(function(value, key) {
                        $("#ddlBloodGrp").append($("<option></option>").val(value.name).html(value.name)); 
                    });
                });         
       
}
/* ------------------------------------------ Add Patient END -----------------------*/

/*--------------------------------------Edit patient Begins------------------------------*/
const patientEditform = document.getElementById('frmEditPatient');
if(patientEditform!=null){
patientEditform.addEventListener("submit", (epf) => {
    epf.preventDefault();
    console.log("called");
     const patientdata = new FormData(patientEditform);
     const params=new URLSearchParams(patientdata);
     
     let options = {
         method: "POST",
         body: params
     };
     var base_url = window.location.origin;
     var url=base_url+'/api/updatePatient';
     console.log(url);
     fetch(url, options)
         .then(function(response){ 
             return response.json(); 
         })
         .then(function(data){ 
             console.log(data);
             if(data.Success=='Success'){
                 $('#divMsg span').text(data.Message);
                 $('#divHcNo span').text(data.hcNo);
                 if (data.ShowModal==1) {
                    const successEditModal = tailwind.Modal.getInstance(document.querySelector("#success-redirect-modal-preview"));
                     successEditModal.show();    
                 }                   
             }else{
                 $('#divErrorHead span').text(data.Success);
                 $('#divErrorMsg span').text(data.Message);
                 if (data.ShowModal==1) {
                     errorModal.show();
                 }
             }
         })
         .catch(function(error){
             $('#divErrorHead span').text('Error');
             $('#divErrorMsg span').text(error);
             errorModal.show();
         });       
 });      
}
/*-------------------------------------------------Edit patient Ends -----------------------------*/

/*------------------------------------ Search Patient Begin ----------------------------*/
  function setTabulator(){
    // Tabulator
    if ($("#tbPatient").length) {
        console.log( window.location.origin);
        // Setup Tabulator
        let table = new Tabulator("#tbPatient", {
            ajaxURL: window.location.origin+"/api/patientList",
            ajaxParams: {"hospitalId": "1","branchId":"0"},
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    hozAlign: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "REGISTERED NO",
                    minWidth: 50,
                    field: "hcNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "NAME",
                    minWidth: 100,
                    field: "name",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Blood Type",
                    minWidth: 50,
                    field: "bloodGrp",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "PHONE NO",
                    minWidth: 100,
                    field: "phoneNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    responsive:2
                },
                {
                    title: "Email",
                    minWidth: 100,
                    field: "email",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "ACTIONS",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a =
                            $(`<div class="flex lg:justify-center items-center text-info">
                            <a class="view flex items-center mr-3" href="javascript:;">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="edit flex items-center mr-3 text-primary" href="javascript:;">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="delete flex items-center text-danger" href="javascript:;">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> 
                            </a>
                        </div>`);
                        $(a)
                        .find(".view")
                        .on("click", function () {
                            viewPatient(cell.getData().id);
                        });
                        $(a)
                            .find(".edit")
                            .on("click", function () {
                                window.location.href="showPatient/"+cell.getData().id;
                            });
                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                const deleteModal = tailwind.Modal.getInstance(document.querySelector("#delete-modal-preview"));
                                deleteModal.show();
                                $('#txtId').val(cell.getData().id);
                                $('#divHcNo span').text(cell.getData().hcNo);
                                console.log(cell.getData().id);
                                $( "#btnDelPatient" ).on( "click", function() {
                                    deletePatient(cell.getData().id,1);
                                });
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "REGISTERED NO",
                    field: "hcNo",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "NAME",
                    field: "name",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "BLOOD TYPE",
                    field: "bloodGrp",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "PHONE NO",
                    field: "phoneNo",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "EMAIL",
                    field: "email",
                    visible: false,
                    print: true,
                    download: true,
                },
            ],
            renderComplete() {
                createIcons({
                    icons,
                    "stroke-width": 1.5,
                    nameAttr: "data-lucide",
                });
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = $("#tbPatient-html-filter-field").val();
            let type = $("#tbPatient-html-filter-type").val();
            let value = $("#tbPatient-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        $("#tbPatient-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        $("#tbPatient-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        $("#tbPatient-html-filter-reset").on("click", function (event) {
            $("#tbPatient-html-filter-field").val("hcNo");
            $("#tbPatient-html-filter-type").val("like");
            $("#tbPatient-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        $("#tbPatient-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "Patients.xlsx", {
                sheetName: "Patients",
            });
        });
        // Print
        $("#tbPatient-print").on("click", function (event) {
            table.print();
        });
    }
}

/*------------------------ View Patient Begin ------------------------------*/
function viewPatient($patientId){
    var base_url = window.location.origin;
    var url=base_url+'/api/patientInfo/'+$patientId;
    console.log(url);
    let options = {
        method: 'GET'
    }
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divPatientErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $('#lblHcNo').text(data.patientDetails.hcNo);
                $('#lblName').text(data.patientDetails.name);
                $('#lblPhoneNo').text(data.patientDetails.phoneNo);
                $('#lblEmail').text(data.patientDetails.email);
                $('#lblDob').text(data.patientDetails.dob);
                $('#lblAge').text(data.patientDetails.age);
                $('#lblGender').text(data.patientDetails.gender);
                $('#lblBloodGrp').text(data.patientDetails.bloodGroup);
                $('#lblMartialStatus').text(data.patientDetails.martialStatus);
                $('#lblHeight').text(data.patientDetails.patientHeight);
                $('#lblWeight').text(data.patientDetails.patientWeight);
                $('#lblAddress').text(data.patientDetails.address);
                $('#lblCity').text(data.patientDetails.city);
                $('#lblState').text(data.patientDetails.state);
                $('#lblPincode').text(data.patientDetails.pincode);
                $('#lblReason').text(data.patientDetails.reason);
                $('#lblSpouseName').text(data.patientDetails.spouseName);
                $('#lblSpousePhNo').text(data.patientDetails.spousePhnNo);
                const viewModal = tailwind.Modal.getInstance(document.querySelector("#divViewPatient"));
                viewModal.show();
                $("#tbPrintPatient").on("click",function(){
                    $("#tbViewPatient").print();
                });
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
}
/*------------------------ View Patient End ------------------------------*/

/*------------------------ Search Patient End ------------------------*/

$( "#ddlRefferedBy" ).on( "change", function() {
    $( "#txtDocHpName" ).val("");
    $( "#txtDocName" ).val("");
    if($( "#ddlRefferedBy" ).val()=='Doctor'){
        $( "#divDocName" ).show();
        $( "#divDocHpName" ).show();
        $( "#divDocName" ).focus();
    }else{
        $( "#divDocName" ).hide();
        $( "#divDocHpName" ).hide();
    }
} );
 $( "#btnCancelPatient" ).on( "click", function() {
    window.scrollTo(0, 0);
 });
 
 /* --------------- Patient Add form submit Begins ------------------------*/

const patientform = document.getElementById('frmPatient');
if(patientform!=null){
//Patient registeration
patientform.addEventListener("submit", (e) => {
    e.preventDefault();
    const patientdata = new FormData(patientform);
     const params=new URLSearchParams(patientdata);
    
    let options = {
        method: "POST",
        body: params
    };
    var base_url = window.location.origin;
    var url=base_url+'/api/addPatient';
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divPatientErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $('#divMsg span').text(data.Message);
                $('#divHcNo span').text(data.hcNo);
                if (data.ShowModal==1) {
                    const successModal = tailwind.Modal.getInstance(document.querySelector("#success-modal-preview"));
                    successModal.show();    
                    document.getElementById("frmPatient").reset() ;
                }                   
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                 }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });
        window.scrollTo(0, 0);
});
 
}
/* --------------- Patient Add form submit End ------------------------*/

//Back to search from update/delete Begin
$( "#btnRedirect" ).on( "click", function() {
    window.scrollTo(0, 0);
    var base_url = window.location.origin;
    window.location.href = base_url+ "/SearchPatient";
});


//Back to search from update/delete End

/*----------------------------------- Delete Patient By ID bEGINS -------------------------*/
function deletePatient(patientId,userId){
    var base_url = window.location.origin;
    var url=base_url+'/api/deletePatient/'+patientId+'/'+userId;
    console.log(url);
    let options = {
        method: 'GET'
    }
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            console.log(data);
            if(data.Success=='Success'){
                if (data.ShowModal==1) {
                const el = document.querySelector("#delete-modal-preview"); 
                const modal = tailwind.Modal.getOrCreateInstance(el); 
                modal.hide();
                setTabulator();
                }                   
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
}

/*----------------------------------- Delete Patient By ID END -------------------------
==============================================================================================================================================
                                                    ==========================================Doctor=====================================
==============================================================================================================================================
---------------------------------Load Add doctor DropDown  ctrl--BEGIN --------------------------- */

function addDoctorLoadEvent(base_url){
    let options = {
        method: 'GET'
    }
    var url=base_url+'/api/getDoctorCommonData';
    console.log(url);
    fetch(url,options)
            .then(response => response.json())
            .then(function (result) {
                // Load GENDER
                var listGender=result.gender;
                listGender.forEach(function(value, key) {
                    $("#ddlGender").append($("<option></option>").val(value.name).html(value.name)); 
                });
                //LOAD BLOOD GROUP
                var listBloodGrp=result.bloodGrp;
                 listBloodGrp.forEach(function(value, key) {
                    $("#ddlBloodGrp").append($("<option></option>").val(value.name).html(value.name)); 
                });
                //LOAD DEPARTMENT
                var listDepartment=result.department;
                listDepartment.forEach(function(value, key) {
                    $("#ddlDepartment").append($("<option></option>").val(value.id).html(value.name)); 
                });
            });         
   
}
/*---------------------------------Load Add doctor DropDown  ctrl--END --------------------------- */

/* --------------- Doctor Add form submit Begins ------------------------*/

const doctorFrom = document.getElementById('frmDoctor');
if(doctorFrom!=null){
    console.log("called");
//Doctor registeration
doctorFrom.addEventListener("submit", (e) => {
    e.preventDefault();
    const doctorData = new FormData(doctorFrom);
    //  const doctorParams=new URLSearchParams(doctorData);
     const file = document.querySelector('#txtProfileImage').files[0];
     if(file!= null){
        console.log(file);
        doctorData.append('profileImage', file);
     }
    let options = {
        method: "POST",
        body: doctorData
    };
    // delete options.headers['Content-Type'];
console.log(options);
    var base_url = window.location.origin;
    var url=base_url+'/api/addDoctor';

    const drerrorModal = tailwind.Modal.getInstance(document.querySelector("#divDoctorErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $('#divDrMsg span').text(data.Message);
                $('#divDoctorCodeNo span').text(data.doctorCodeNo);
                $('#divDrLogin span').text(data.loginCreation==1?"User Login created successfully":"");
                if (data.ShowModal==1) {
                    const successModal = tailwind.Modal.getInstance(document.querySelector("#success-modal-preview"));
                    successModal.show();    
                    $(imgProfileImage).attr("src","dist/images/profile-11.jpg");
                    document.getElementById("frmDoctor").reset() ;
                }                   
            }else{
                $('#divDrErrorHead span').text(data.Success);
                $('#divDrErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    drerrorModal.show();
                 }
            }
        })
        .catch(function(error){
            $('#divDrErrorHead span').text('Error');
            $('#divDrErrorMsg span').text(error);
            drerrorModal.show();
        });
        window.scrollTo(0, 0);
});
 
}
/* --------------- Doctor Add form submit End ------------------------*/
/*------------------------------------ Search Doctor Begin ----------------------------*/
function setDoctorTabulator(){
    // Tabulator
    if ($("#tbDoctor").length) {
        console.log( window.location.origin);
        // Setup Tabulator
        let table = new Tabulator("#tbDoctor", {
            ajaxURL: window.location.origin+"/api/doctorList",
            ajaxParams: {"hospitalId": "1","branchId":"0"},
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    hozAlign: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "CODE NO",
                    minWidth: 50,
                    field: "doctorCodeNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "NAME",
                    minWidth: 100,
                    field: "name",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "PHONE NO",
                    minWidth: 100,
                    field: "phoneNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Email",
                    minWidth: 100,
                    field: "email",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "BLOOD GROUP",
                    minWidth: 50,
                    field: "bloodGrp",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "DESIGNATION",
                    minWidth: 50,
                    field: "designation",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "DEPARTMENT",
                    minWidth: 50,
                    field: "department",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "ACTIONS",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a =
                            $(`<div class="flex lg:justify-center items-center text-info">
                            <a class="view flex items-center mr-3" href="javascript:;">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="edit flex items-center mr-3 text-primary" href="javascript:;">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="delete flex items-center text-danger" href="javascript:;">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> 
                            </a>
                        </div>`);
                        $(a)
                        .find(".view")
                        .on("click", function () {
                            viewDoctor(cell.getData().id);
                        });
                        $(a)
                            .find(".edit")
                            .on("click", function () {
                                window.location.href="showDoctor/"+cell.getData().id;
                            });
                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                const deleteModal = tailwind.Modal.getInstance(document.querySelector("#delete-modal-preview"));
                                deleteModal.show();
                                $('#txtId').val(cell.getData().id);
                                $('#divDrCodeNo span').text(cell.getData().doctorCodeNo);
                                console.log(cell.getData().id);
                                $( "#btnDelDoctor" ).on( "click", function() {
                                    deleteDoctor(cell.getData().id,1);
                                });
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "CODE NO",
                    field: "doctorCodeNo",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "NAME",
                    field: "name",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "PHONE NO",
                    field: "phoneNo",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "EMAIL",
                    field: "email",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "BLOOD TYPE",
                    field: "bloodGrp",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "DESIGNATION",
                    field: "designation",
                    visible: false,
                    print: false,
                    download: false,
                },
                {
                    title: "DEPARTMENT",
                    field: "department",
                    visible: false,
                    print: false,
                    download: false,
                },
            ],
            renderComplete() {
                createIcons({
                    icons,
                    "stroke-width": 1.5,
                    nameAttr: "data-lucide",
                });
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });

        // Filter function
        function filterHTMLDoctorForm() {
            let field = $("#tbDoctor-html-filter-field").val();
            let type = $("#tbDoctor-html-filter-type").val();
            let value = $("#tbDoctor-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        $("#tbDoctor-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLDoctorForm();
                }
            }
        );

        // On click go button
        $("#tbDoctor-html-filter-go").on("click", function (event) {
            filterHTMLDoctorForm();
        });

        // On reset filter form
        $("#tbDoctor-html-filter-reset").on("click", function (event) {
            $("#tbDoctor-html-filter-field").val("doctorCodeNo");
            $("#tbDoctor-html-filter-type").val("like");
            $("#tbDoctor-html-filter-value").val("");
            filterHTMLDoctorForm();
        });

        // Export
        $("#tbDoctor-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        $("#tbDoctor-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        $("#tbDoctor-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "Doctors.xlsx", {
                sheetName: "Doctors",
            });
        });

        $("#tbDoctor-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        $("#tbDoctor-print").on("click", function (event) {
            table.print();
        });
    }
}
/*------------------------ Search Doctor End ------------------------*/

/*----------------------------------- Delete Patient By ID bEGINS -------------------------*/
function deleteDoctor(doctorId,userId){
    var base_url = window.location.origin;
    var url=base_url+'/api/deleteDoctor/'+doctorId+'/'+userId;
    console.log(url);
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divDoctorErrorModal"));
    let options = {
        method: 'GET'
    }
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            console.log(data);
            if(data.Success=='Success'){
                if (data.ShowModal==1) {
                  const el = document.querySelector("#delete-modal-preview"); 
                  const modal = tailwind.Modal.getOrCreateInstance(el); 
                  modal.hide();
                  setDoctorTabulator();
                }                   
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
    }
    
    /*----------------------------------- Delete Patient By ID END -------------------------*/
/*------------------------ View Doctor Begin ------------------------------*/
function viewDoctor($doctorId){
    var base_url = window.location.origin;
    var url=base_url+'/api/doctorInfo/'+$doctorId;
    console.log(url);
    let options = {
        method: 'GET'
    }
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divDoctorErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $(imgProfileImage).attr("src",data.doctorDetails.profileImage);
                $('#divCode span').text(data.doctorDetails.doctorCodeNo);
                $('#divName span').text(data.doctorDetails.name);
                $('#divPhoneNo span').text(data.doctorDetails.phoneNo);
                $('#divEmail span').text(data.doctorDetails.email);
                $('#divDob span').text((data.doctorDetails.dob==""?"Not Provided" : data.doctorDetails.dob));
                $('#divGender span').text((data.doctorDetails.gender==0?"Not Provided" :data.doctorDetails.gender));
                $('#divBloodGrp span').text((data.doctorDetails.bloodGroup==0?"Not Provided" :data.doctorDetails.bloodGroup));
                $('#divEducation span').text((data.doctorDetails.education==""?"Not Provided" :data.doctorDetails.education));
                $('#divDesignation span').text((data.doctorDetails.designation==""?"Not Provided" :data.doctorDetails.designation));
                $('#divDepartment span').text((data.doctorDetails.department==""?"Not Provided" :data.doctorDetails.department));
                $('#divExperience span').text((data.doctorDetails.experience==""?"Not Provided" :data.doctorDetails.experience));
                $('#divAddress span').text((data.doctorDetails.address==""?"Not Provided" : data.doctorDetails.address));
                const viewModal = tailwind.Modal.getInstance(document.querySelector("#divViewDoctor"));
                viewModal.show();
                // $("#tbPrintPatient").on("click",function(){
                //     $("#tbViewPatient").print();
                // });
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
}
/*------------------------ View Doctor End ------------------------------*/
/*--------------------------------------Edit Doctor Begins------------------------------*/
const doctorEditform = document.getElementById('frmEditDoctor');
if(doctorEditform!=null){
    doctorEditform.addEventListener("submit", (epf) => {
    epf.preventDefault();
    console.log("called");
     const doctordata = new FormData(doctorEditform);
     const file = document.querySelector('#txtProfileImage').files[0];
     if(file!=null){
        console.log(file);
        doctordata.append('profileImage', file);
     }
     let options = {
         method: "POST",
         body: doctordata
     };
     var base_url = window.location.origin;
     var url=base_url+'/api/updateDoctor';
     console.log(url);
     const errorDrModal = tailwind.Modal.getInstance(document.querySelector("#divErrorEditDoctor"));
     fetch(url, options)
         .then(function(response){ 
             return response.json(); 
         })
         .then(function(data){ 
             console.log(data);
             if(data.Success=='Success'){
                 $('#divMsg span').text(data.Message);
                 $('#divDoctorCodeNo span').text(data.doctorCodeNo);
                 if (data.ShowModal==1) {
                    const successEditModal = tailwind.Modal.getInstance(document.querySelector("#divSuccessEditDoctor"));
                     successEditModal.show();    
                 }                   
             }else{
                 $('#divErrorHead span').text(data.Success);
                 $('#divErrorMsg span').text(data.Message);
                 if (data.ShowModal==1) {
                    errorDrModal.show();
                 }
             }
         })
         .catch(function(error){
             $('#divErrorHead span').text('Error');
             $('#divErrorMsg span').text(error);
             errorDrModal.show();
         });       
 });      
}
/*-------------------------------------------------Edit Doctor Ends -----------------------------*/
$( "#btnDrRedirect" ).on( "click", function() {
    window.scrollTo(0, 0);
    window.location.href = window.location.origin+ "/SearchDoctor";
});

/* --------------- Hospital Add form submit Begins ------------------------*/

const hospitalFrom = document.getElementById('frmHospital');
if(hospitalFrom!=null){
//Hospital registeration
hospitalFrom.addEventListener("submit", (e) => {
    e.preventDefault();
    const hospitalData = new FormData(hospitalFrom);
     const file = document.querySelector('#txtLogo').files[0];
     if(file!= null){
        hospitalData.append('logo', file);
     }
    let options = {
        method: "POST",
        body: hospitalData
    };
    var base_url = window.location.origin;
    var url=base_url+'/api/addHospital';

    const drerrorModal = tailwind.Modal.getInstance(document.querySelector("#divHospitalErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $('#divDrMsg span').text(data.Message);
                $('#divDrLogin span').text(data.loginCreation==1?"User Login created successfully":"");
                if (data.ShowModal==1) {
                    const successModal = tailwind.Modal.getInstance(document.querySelector("#divHospitalSuccessModal"));
                    successModal.show();    
                    $(imgLogo).attr("src","dist/images/profile-11.jpg");
                    document.getElementById("frmHospital").reset() ;
                }                   
            }else{
                $('#divDrErrorHead span').text(data.Success);
                $('#divDrErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    drerrorModal.show();
                 }
            }
        })
        .catch(function(error){
            $('#divDrErrorHead span').text('Error');
            $('#divDrErrorMsg span').text(error);
            drerrorModal.show();
        });
        window.scrollTo(0, 0);
});
 
}
/* --------------- Hospital Add form submit End ------------------------*/
/*------------------------------------ Search Hospital Begin ----------------------------*/
function setHospitalTabulator(){
    // Tabulator
    if ($("#tbHospital").length) {
        // Setup Tabulator
        let table = new Tabulator("#tbHospital", {
            ajaxURL: window.location.origin+"/api/hospitalList",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    hozAlign: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "HOSPITAL NAME",
                    minWidth: 50,
                    field: "hospitalName",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "PHONE NO",
                    minWidth: 100,
                    field: "phoneNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Email",
                    minWidth: 100,
                    field: "email",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "ADDRESS",
                    minWidth: 150,
                    field: "address",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "CONTACT PERSON",
                    minWidth: 100,
                    field: "inChargePerson",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "CONTACT PERSON NUMBER",
                    minWidth: 50,
                    field: "inChargePhoneNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "SUBSCRIBED",
                    minWidth: 50,
                    field: "is_subscribed",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "ACTIONS",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a =
                            $(`<div class="flex lg:justify-center items-center text-info">
                            <a class="view flex items-center mr-3" href="javascript:;">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="edit flex items-center mr-3 text-primary" href="javascript:;">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="delete flex items-center text-danger" href="javascript:;">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> 
                            </a>
                        </div>`);
                        $(a)
                        .find(".view")
                        .on("click", function () {
                            viewHospital(cell.getData().id);
                        });
                        $(a)
                            .find(".edit")
                            .on("click", function () {
                                window.location.href="showHospital/"+cell.getData().id;
                            });
                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                const deleteModal = tailwind.Modal.getInstance(document.querySelector("#divDeleteHospital"));
                                deleteModal.show();
                                $('#txtId').val(cell.getData().id);
                                $('#divHospitalName span').text(cell.getData().hospitalName);
                                console.log(cell.getData().id);
                                $( "#btnDelHospital" ).on( "click", function() {
                                    deleteHospital(cell.getData().id,1);
                                });
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "HOSPITAL NAME",
                    field: "hospitalName",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "PHONE NO",
                    field: "phoneNo",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "EMAIL",
                    field: "email",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "ADDRESS",
                    field: "address",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CONTACT PERSON",
                    field: "inChargePerson",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CONTACT PERSON PHONE NO",
                    field: "inChargePhoneNo",
                    visible: false,
                    print: false,
                    download: false,
                },
                {
                    title: "SUBSCRIBED",
                    field: "is_subscribed",
                    visible: false,
                    print: false,
                    download: false,
                },
            ],
            renderComplete() {
                createIcons({
                    icons,
                    "stroke-width": 1.5,
                    nameAttr: "data-lucide",
                });
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });

        // Filter function
        function filterHTMLDoctorForm() {
            let field = $("#tbHospital-html-filter-field").val();
            let type = $("#tbHospital-html-filter-type").val();
            let value = $("#tbHospital-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        $("#tbHospital-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLDoctorForm();
                }
            }
        );

        // On click go button
        $("#tbHospital-html-filter-go").on("click", function (event) {
            filterHTMLDoctorForm();
        });

        // On reset filter form
        $("#tbHospital-html-filter-reset").on("click", function (event) {
            $("#tbHospital-html-filter-field").val("doctorCodeNo");
            $("#tbHospital-html-filter-type").val("like");
            $("#tbHospital-html-filter-value").val("");
            filterHTMLDoctorForm();
        });

        // Export
        $("#tbHospital-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "Hospitals.xlsx", {
                sheetName: "Hospitals",
            });
        });
        // Print
        $("#tbHospital-print").on("click", function (event) {
            table.print();
        });
    }
}
/*------------------------ Search Hospital End ------------------------*/
/*------------------------ View Hospital Begin ------------------------------*/
function viewHospital($hospitalId){
    var base_url = window.location.origin;
    var url=base_url+'/api/hospitalInfo/'+$hospitalId;
    let options = {
        method: 'GET'
    }
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divHospitalErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $(imgLogo).attr("src",data.hospitalDetails.logo);
                $('#divContactPerson span').text(data.hospitalDetails.inChargePerson);
                $('#divName span').text(data.hospitalDetails.hospitalName);
                $('#divPhoneNo span').text(data.hospitalDetails.phoneNo+" , "+data.hospitalDetails.inChargePhoneNo);
                $('#divEmail span').text(data.hospitalDetails.email);
                $('#divAddress span').text(data.hospitalDetails.address);
                const viewModal = tailwind.Modal.getInstance(document.querySelector("#divViewHospital"));
                viewModal.show();
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
}
/*------------------------ View Hospital End ------------------------------*/
/*----------------------------------- Delete Hospital By ID BEGINS -------------------------*/
function deleteHospital(hospitalId,userId){
    var base_url = window.location.origin;
    var url=base_url+'/api/deleteHospital/'+hospitalId+'/'+userId;
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divHospitalErrorModal"));
    let options = {
        method: 'GET'
    }
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            console.log(data);
            if(data.Success=='Success'){
                if (data.ShowModal==1) {
                  const el = document.querySelector("#divDeleteHospital"); 
                  const modal = tailwind.Modal.getOrCreateInstance(el); 
                  modal.hide();
                  setHospitalTabulator();
                }                   
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
    }
    
    /*----------------------------------- Delete Hospital By ID END -------------------------*/
/*--------------------------------------Edit Hospital Begins------------------------------*/
const hospitalEditform = document.getElementById('frmEditHospital');
if(hospitalEditform!=null){
    hospitalEditform.addEventListener("submit", (epf) => {
    epf.preventDefault();
     const hospitaldata = new FormData(hospitalEditform);
     const file = document.querySelector('#txtLogo').files[0];
     if(file!=null){
        hospitaldata.append('logo', file);
     }
     let options = {
         method: "POST",
         body: hospitaldata
     };
     var base_url = window.location.origin;
     var url=base_url+'/api/updateHospital';
     const errorDrModal = tailwind.Modal.getInstance(document.querySelector("#divErrorEditHospital"));
     fetch(url, options)
         .then(function(response){ 
             return response.json(); 
         })
         .then(function(data){ 
             console.log(data);
             if(data.Success=='Success'){
                 $('#divMsg span').text(data.Message);
                 if (data.ShowModal==1) {
                    const successEditModal = tailwind.Modal.getInstance(document.querySelector("#divSuccessEditHospital"));
                     successEditModal.show();    
                 }                   
             }else{
                 $('#divErrorHead span').text(data.Success);
                 $('#divErrorMsg span').text(data.Message);
                 if (data.ShowModal==1) {
                    errorDrModal.show();
                 }
             }
         })
         .catch(function(error){
             $('#divErrorHead span').text('Error');
             $('#divErrorMsg span').text(error);
             errorDrModal.show();
         });       
 });      
}
/*-------------------------------------------------Edit Hospital Ends -----------------------------*/
$( "#btnHsRedirect" ).on( "click", function() {
    window.scrollTo(0, 0);
    window.location.href = window.location.origin+ "/SearchHospital";
});
  /* ------------------------------------------ Add Branch Begin -----------------------*/
  function addBranchLoadEvent(base_url){
        let options = {
            method: 'GET'
        }
        var url=base_url+'/api/listAllHospital';
        fetch(url,options)
                .then(response => response.json())
                .then(function (result) {
                    var hospitalList=result.hospitalList;
                    hospitalList.forEach(function(value, key) {
                        $("#ddlHospital").append($("<option></option>").val(value.id).html(value.hospitalName)); 
                    });
                });         
}
/* ------------------------------------------ Add Branch END -----------------------*/
/* --------------- Branch Add form submit Begins ------------------------*/

const branchFrom = document.getElementById('frmBranch');
if(branchFrom!=null){
//Branch registeration
branchFrom.addEventListener("submit", (e) => {
    e.preventDefault();
    const branchData = new FormData(branchFrom);
     const file = document.querySelector('#txtLogo').files[0];
     if(file!= null){
        branchData.append('logo', file);
     }
    let options = {
        method: "POST",
        body: branchData
    };
    var base_url = window.location.origin;
    var url=base_url+'/api/addBranch';

    const brerrorModal = tailwind.Modal.getInstance(document.querySelector("#divBranchErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $('#divBrMsg span').text(data.Message);
                $('#divBrLogin span').text(data.loginCreation==1?"User Login created successfully":"");
                if (data.ShowModal==1) {
                    const successModal = tailwind.Modal.getInstance(document.querySelector("#divBranchSuccessModal"));
                    successModal.show();    
                    $(imgLogo).attr("src","dist/images/profile-11.jpg");
                    document.getElementById("frmBranch").reset() ;
                }                   
            }else{
                $('#divBrErrorHead span').text(data.Success);
                $('#divBrErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    brerrorModal.show();
                 }
            }
        })
        .catch(function(error){
            $('#divBrErrorHead span').text('Error');
            $('#divBrErrorMsg span').text(error);
            brerrorModal.show();
        });
        window.scrollTo(0, 0);
});
 
}
/* --------------- Branch Add form submit End ------------------------*/
/*------------------------------------ Search Branch Begin ----------------------------*/
function setBranchTabulator(){
    // Tabulator
    if ($("#tbBranch").length) {
        // Setup Tabulator
        let table = new Tabulator("#tbBranch", {
            ajaxURL: window.location.origin+"/api/branchList",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    hozAlign: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "HOSPITAL NAME",
                    minWidth: 50,
                    field: "hospitalName",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },{
                    title: "BRANCH NAME",
                    minWidth: 50,
                    field: "branchName",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "PHONE NO",
                    minWidth: 100,
                    field: "phoneNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Email",
                    minWidth: 100,
                    field: "email",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "ADDRESS",
                    minWidth: 150,
                    field: "address",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "CONTACT PERSON",
                    minWidth: 100,
                    field: "inChargePerson",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "CONTACT PERSON NUMBER",
                    minWidth: 50,
                    field: "inChargePhoneNo",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "SUBSCRIBED",
                    minWidth: 50,
                    field: "is_subscribed",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "ACTIONS",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a =
                            $(`<div class="flex lg:justify-center items-center text-success">
                            <a class="view flex items-center mr-3" href="javascript:;">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="edit flex items-center mr-3 text-primary" href="javascript:;">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> 
                            </a>
                            <a class="delete flex items-center text-danger" href="javascript:;">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> 
                            </a>
                        </div>`);
                        $(a)
                        .find(".view")
                        .on("click", function () {
                            viewBranch(cell.getData().id);
                        });
                        $(a)
                            .find(".edit")
                            .on("click", function () {
                                window.location.href="showBranch/"+cell.getData().id;
                            });
                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                const deleteModal = tailwind.Modal.getInstance(document.querySelector("#divDeleteBranch"));
                                deleteModal.show();
                                $('#txtId').val(cell.getData().id);
                                $('#divBranchName span').text(cell.getData().branchName);
                                console.log(cell.getData().id);
                                $( "#btnDelBranch" ).on( "click", function() {
                                    deleteBranch(cell.getData().id,1);
                                });
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "HOSPITAL NAME",
                    field: "hospitalName",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "PHONE NO",
                    field: "phoneNo",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "EMAIL",
                    field: "email",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "ADDRESS",
                    field: "address",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CONTACT PERSON",
                    field: "inChargePerson",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CONTACT PERSON PHONE NO",
                    field: "inChargePhoneNo",
                    visible: false,
                    print: false,
                    download: false,
                },
                {
                    title: "SUBSCRIBED",
                    field: "is_subscribed",
                    visible: false,
                    print: false,
                    download: false,
                },
            ],
            renderComplete() {
                createIcons({
                    icons,
                    "stroke-width": 1.5,
                    nameAttr: "data-lucide",
                });
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });

        // Filter function
        function filterHTMLDoctorForm() {
            let field = $("#tbBranch-html-filter-field").val();
            let type = $("#tbBranch-html-filter-type").val();
            let value = $("#tbBranch-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        $("#tbBranch-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLDoctorForm();
                }
            }
        );

        // On click go button
        $("#tbBranch-html-filter-go").on("click", function (event) {
            filterHTMLDoctorForm();
        });

        // On reset filter form
        $("#tbBranch-html-filter-reset").on("click", function (event) {
            $("#tbBranch-html-filter-field").val("doctorCodeNo");
            $("#tbBranch-html-filter-type").val("like");
            $("#tbBranch-html-filter-value").val("");
            filterHTMLDoctorForm();
        });

        // Export
        $("#tbBranch-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "HospitalBranch.xlsx", {
                sheetName: "Branch",
            });
        });
        // Print
        $("#tbBranch-print").on("click", function (event) {
            table.print();
        });
    }
}
/*------------------------ Search Branch End ------------------------*/
/*------------------------ View Branch Begin ------------------------------*/
function viewBranch($branchId){
    var base_url = window.location.origin;
    var url=base_url+'/api/branchInfo/'+$branchId;
    let options = {
        method: 'GET'
    }
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divBranchErrorModal"));
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                $(imgLogo).attr("src",data.branchDetails.logo);
                $('#divHospitalName span').text(data.branchDetails.hospitalName);
                $('#divContactPerson span').text(data.branchDetails.contactPerson);
                $('#divName span').text(data.branchDetails.branchName);
                $('#divPhoneNo span').text(data.branchDetails.phoneNo+" , "+data.branchDetails.contactPersonPhNo);
                $('#divEmail span').text(data.branchDetails.email);
                $('#divAddress span').text(data.branchDetails.address);
                const viewModal = tailwind.Modal.getInstance(document.querySelector("#divViewBranch"));
                viewModal.show();
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
}
/*------------------------ View Branch End ------------------------------*/
/*----------------------------------- Delete Branch By ID BEGINS -------------------------*/
function deleteBranch(branchId,userId){
    var base_url = window.location.origin;
    var url=base_url+'/api/deleteBranch/'+branchId+'/'+userId;
    const errorModal = tailwind.Modal.getInstance(document.querySelector("#divBranchErrorModal"));
    let options = {
        method: 'GET'
    }
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            if(data.Success=='Success'){
                if (data.ShowModal==1) {
                  const el = document.querySelector("#divDeleteBranch"); 
                  const modal = tailwind.Modal.getOrCreateInstance(el); 
                  modal.hide();
                  setBranchTabulator();
                }                   
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                    errorModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorModal.show();
        });       
    }
    
    /*----------------------------------- Delete Branch By ID END -------------------------*/
/*--------------------------------------Edit Branch Begins------------------------------*/
const branchEditform = document.getElementById('frmEditBranch');
if(branchEditform!=null){
    branchEditform.addEventListener("submit", (epf) => {
    epf.preventDefault();
     const branchdata = new FormData(branchEditform);
     const file = document.querySelector('#txtLogo').files[0];
     if(file!=null){
        branchdata.append('logo', file);
     }
     let options = {
         method: "POST",
         body: branchdata
     };
     var base_url = window.location.origin;
     var url=base_url+'/api/updateBranch';
     const errorDrModal = tailwind.Modal.getInstance(document.querySelector("#divErrorEditHospital"));
     fetch(url, options)
         .then(function(response){ 
             return response.json(); 
         })
         .then(function(data){ 
             console.log(data);
             if(data.Success=='Success'){
                 $('#divMsg span').text(data.Message);
                 if (data.ShowModal==1) {
                    const successEditModal = tailwind.Modal.getInstance(document.querySelector("#divSuccessEditHospital"));
                     successEditModal.show();    
                 }                   
             }else{
                 $('#divErrorHead span').text(data.Success);
                 $('#divErrorMsg span').text(data.Message);
                 if (data.ShowModal==1) {
                    errorDrModal.show();
                 }
             }
         })
         .catch(function(error){
             $('#divErrorHead span').text('Error');
             $('#divErrorMsg span').text(error);
             errorDrModal.show();
         });       
 });      
}
/*-------------------------------------------------Edit Branch Ends -----------------------------*/
$( "#btnbrRedirect" ).on( "click", function() {
    window.scrollTo(0, 0);
    window.location.href = window.location.origin+ "/SearchBranch";
});
/*-------------------------------------- Consent Form --------------------------------------*/
function consentFormOnLoad(){
    $("#btnGo").on("click", function () {
        $("#divProfile").removeClass("hidden").removeAttr("style");
        $("#divFormList").removeClass("hidden").removeAttr("style");
        $("#divFormContent").removeClass("hidden").removeAttr("style");
    });
    $( "#btnPrintConsent" ).on( "click", function() {
      var divToPrint=document.getElementById('divConsentContent');
      var newWin=window.open('','Print-Window');
      newWin.document.open();
      newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
      newWin.document.close();
      setTimeout(function(){newWin.close();},10);            
    });

    /*----------------------------------------------- Load Consent Form BEGIN -------------------------------------*/
    var base_url = window.location.origin;
    var hospitalId=$("#txtHospital").val();
    var branchId=$("#txtBranch").val()==""?0:$("#txtBranch").val();
    var url=base_url+'/api/consentFormList/'+hospitalId+'/'+branchId;
    console.log(url);
    const errorDrModal = tailwind.Modal.getInstance(document.querySelector("#divConsentErrorModal"));
    let options = {
        method: 'GET'
    }
    fetch(url, options)
        .then(function(response){ 
            return response.json(); 
        })
        .then(function(data){ 
            console.log(data);
            if(data.Success=='Success'){
                var html = "";
                var formList=data.consentList;
                var i=1;
                formList.forEach(function(value, key) {
                    html = '<div id=div'+i+' class="intro-x bg-blue-800 text-white cursor-pointer box relative flex items-center p-5 '+(i>1?'mt-5':'')+'"><div class="ml-2 overflow-hidden"><div class="form-check mt-2"> <input id="chk'+value.formName+'" class="form-check-input" type="checkbox" value="'+value.id+'"><label class="form-check-label" for="checkbox-switch-1"> <div class="flex items-center"><a href="javascript:;" class="font-medium">'+value.formName+'</a> </div></label></div></div></div> '; 
                    $('#divFormNameList').append(html);
                    var divId="#div"+i;
                    var id=value.id;
                    $("#div"+i).on("click",function(){
                    console.log(divId);
                        console.log(id);
                        $('#divHideForm').removeClass("hidden").removeAttr("style");
                        $('#divConsentHeader span').text(value.formName);
                        $('#divConsentContent').append(value.formContent);
                    });
                    i=i+1;
                });
                
            }else{
                $('#divErrorHead span').text(data.Success);
                $('#divErrorMsg span').text(data.Message);
                if (data.ShowModal==1) {
                   errorDrModal.show();
                }
            }
        })
        .catch(function(error){
            $('#divErrorHead span').text('Error');
            $('#divErrorMsg span').text(error);
            errorDrModal.show();
        });       
}
/*----------------------------------------------- Load Consent Form END -------------------------------------*/
})();
