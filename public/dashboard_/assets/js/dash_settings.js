function makeSideBar() {
    if(!localStorage.activeSideBar) {
        localStorage.setItem("activeSideBar", window.location.href);
        $(`.sidebar-layout a[href="${localStorage.activeSideBar}"]`).parent().addClass("active");
        console.log(localStorage.activeSideBar);
    }
    else {
        localStorage.setItem("activeSideBar", window.location.href);
        $(`.sidebar-layout a[href="${localStorage.activeSideBar}"]`).parent().addClass("active");
    }
}
makeSideBar();
var FormRequestTbl = new gridjs.Grid({
    columns: ["ID", "Ad, Soyad", "E-poçt", "Əlaqə nömrəsi", "Tarix", "Qeyd", "Status"],
    pagination:{
           limit:10
    },
    sort:true,
    search:true,
       language:{
              'search':{
                     'placeholder': 'Axtarış...'
              }
       },
    server: {
        url: '/dashboard/csapi/callback/list',
        then: data => data.map(card => [
            card.uniq_id, 
            card.fullname,
            card.email,
            card.phone_number,
            card.created_at,
            gridjs.html(`<button class="btn btn-sm CallBackViewBTN" data-uniq-id="${card.uniq_id}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            </svg>
            </button>`),
            gridjs.html(determineCallbackStatus(card.status, card.uniq_id)),
        ]),
    }
});

if(top.location.pathname === '/dashboard/callback') {
    FormRequestTbl.render(document.getElementById("OrderRequestTable"));
    $(".gridjs-search").css('float','right');
    $(".gridjs-head").append("<h4>Bizimlə əlaqə</h4>")
}
function determineCallbackStatus(data, uniq_id) {
    if(data === "pending") {
        return `<button class="btn btn-sm btn-wt callbackStatusBTN" data-val="${data}" data-uniq-id="${uniq_id}">Gözləyir</button>`
    }
    else if (data === "called") {
        return `<button class="btn btn-sm btn-suc callbackStatusBTN" data-val="${data}" data-uniq-id="${uniq_id}">Zəng edildi</button>`
    }
    else if (data === "forwarded") {
        return `<button class="btn btn-sm btn-dg callbackStatusBTN" data-val="${data}" data-uniq-id="${uniq_id}">Yönləndirildi</button>`
    }
    else {
        return `<button class="btn btn-sm btn-dk callbackStatusBTN" data-val="${data}" data-uniq-id="${uniq_id}">Seçim edilməyib</button>`
    }
}
$(document).on("click", ".callbackStatusBTN", function() {
    $("#callBacStatuskModal").modal("show");
    $(`#updateCallBackStatusForm input[name="body_id"]`).val($(this).data("uniq-id"));
    var notSelectedOption = $(`#updateCallBackStatusForm select option[value="${$(this).data("val")}"]`);
    if(notSelectedOption.length) {
        $(".notSelectedOption").remove();
        $(`#updateCallBackStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
    }
    else {
        $(`#updateCallBackStatusForm select`).prepend("<option selected class='notSelectedOption'>Seçim edilməyib</option>");
    }
});

$("#updateCallBackStatusForm select").change( function() {
    Swal.fire({
        title: 'Statusu yeniləmək istədiyinizə əminsiniz?',
        showDenyButton: true,
        icon: 'info',
        confirmButtonText: 'Bəli',
        denyButtonText: `Xeyr`,
      }).then((result) => {
        if (result.isConfirmed) {
            $.post(`/dashboard/csapi/callback/update/${$(`#updateCallBackStatusForm input[name="body_id"]`).val()}`, {
                status: $("#updateCallBackStatusForm").find(":selected").val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            function(data) {
                if(data.state) {
                    FormRequestTbl.forceRender();
                    Swal.fire('Yeniləndi', '', 'success');
                    $("#callBacStatuskModal").modal("hide");
                }
            })
        }
        else {
            $("#callBacStatuskModal").modal("hide");
        }
      })
});
$(document).on("click", ".CallBackViewBTN", function() {
    let tmp_id__ = $(this).data("uniq-id");
    $.get(`/dashboard/csapi/callback/get/${tmp_id__}`, function(data) {
        $("#callBackModal").modal("show");
        $(`#callBackModal input[name="fullname"]`).val(data.fullname)
        $(`#messageTextArea`).val(data.message)
    })
});
let SliderTable = new gridjs.Grid({
    columns: [
           {
                  name: "Prioritet",
                  sort: {
                         compare: (a,b) => {
                                if(a>b){
                                       return 1;
                                } else if(b>a){
                                       return -1;
                                } else { 
                                       return 0;
                                }
                         }
                  }
           },
            "Başlıq", 
            "Status",
             "Əməliyyat"],
             sort:true,
    pagination:{
       limit:10
       },
       sort:true,
    server: {
        url: '/dashboard/csapi/slider/list',
        then: data => data.map(card => [
              gridjs.html(`
                     <div class='d-flex align-items-center'>           
                            <button class='btn btn-sm incrm-priority' data-uniq-id="${card.uniq_id}" data-val="${card.priority}">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                   <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                   <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                   </svg>
                            </button>
                            <input  class='d-inline-block priority border border-none bg-white' data-pr-val="${card.uniq_id}"  value='${card.priority}' disabled>
                            <button class='btn btn-sm dcrm-priority' data-uniq-id="${card.uniq_id}" data-val="${card.priority}">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                   </svg>
                            </button>
                     </div>
              `),
            card.title,
            gridjs.html(sliderStatus(card.status,card.uniq_id,"sliderStatusBTN")),
            gridjs.html(`<button class="btn btn-sm show-slider" data-uniq-id="${card.uniq_id}">
            <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            </svg>
            </button>
            <button class="btn btn-sm delete-slider ml-3" data-uniq-id="${card.uniq_id}">
                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>`)
            ,
        ]),
    }
});
function sliderStatus(data,uniq_id,className){
       if(data === 'active') {
              return `<button class="btn btn-sm btn-suc ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Aktiv</button>`
       }
       else if (data === "deactive") {
              return `<button class="btn btn-sm btn-dg ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Deaktiv</button>`
       }
       else {
              return `<button class="btn btn-sm btn-dk ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Seçim edilməyib</button>`
       }

}
$(document).on('click','.sliderStatusBTN',function(){
       $("#sliderStatusModal").modal("show")
       $(`#updateSliderStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
       var sliderNotSelected = $(`#updateSliderStatusForm select option[value="${$(this).data("val")}"]`);
       if(sliderNotSelected.length) 
       {
              $(".sliderNotSelected").remove();
              $(`#updateSliderStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
       }
       else 
       {
              $(`#updateSliderStatusForm select`).prepend("<option selected class='sliderNotSelected'>Seçim edilməyib</option>");
       }
})
$("#updateSliderStatusForm select").change( function() {
       $.post(`/dashboard/csapi/slider/status/update/${$(`#updateSliderStatusForm input[name="uniq_id"]`).val()}`, {
           status: $("#updateSliderStatusForm").find(":selected").val(),
           _token: $('meta[name="csrf-token"]').attr('content')
       },
       function(data) {
           if(data.state) {
              SliderTable.forceRender();
               Swal.fire('Yeniləndi', '', 'success');
               $("#sliderStatusModal").modal("hide");
           }
       })      
});
$(document).on('click','.incrm-priority',function(){
       let tmp_slct__ = $(this);
       let data = parseInt($(tmp_slct__).siblings('.priority').val());
       data=data+1
       if($(`.priority[value='${data}']`).length && data === parseInt($(`.priority[value='${data}']`)[0].value)){
              data=data+1
       }
       $(tmp_slct__).siblings('.priority').val(data)
       $.post(`/dashboard/csapi/slider/update/${$(tmp_slct__).siblings('.priority').attr('data-pr-val')}`, {
              _token:  $('meta[name="csrf-token"]').attr('content'),
              priority: data,
       },
              function(data){
                     if(data.state){
                            SliderTable.forceRender();
                     }
              }
       )
       
})
$(document).on('click','.dcrm-priority',function(){
       let tmp_slct__ = $(this);
       let data=parseInt($(tmp_slct__).siblings('.priority').val());
       data=data-1
       if($(`.priority[value='${data}']`).length && data === parseInt($(`.priority[value='${data}']`)[0].value)){
              data=data-1
       }
       if(data == -1){
              data=0;
       }
       $(tmp_slct__).siblings('.priority').val(data)
       $.post(`/dashboard/csapi/slider/update/${$(tmp_slct__).siblings('.priority').attr('data-pr-val')}`, {
              _token:  $('meta[name="csrf-token"]').attr('content'),
              priority:  $(tmp_slct__).siblings('.priority').val(),
       },
       function(data){
              if(data.state){
                     SliderTable.forceRender();
              }
       })
})
//JSON.parse(data)[0]['description']
$(document).on('click','.show-slider',function(){
       let tmp__ = $(this).attr('data-uniq-id')
       $.get(`/dashboard/csapi/slider/get/${tmp__}`, function(data) {
              $("#modelWindows").modal("show");
              // let tmp__btn= {
              //        'Button adı':JSON.parse(JSON.parse(data)[0]['button'])['btn_name_az'],
              //        'Button linki' : JSON.parse(JSON.parse(data)[0]['button'])['btn_uri_az'],
              //        'Button rəngi' : JSON.parse(JSON.parse(data)[0]['button'])['btn_color_az'],
              // }
              // console.log(JSON.parse(JSON.parse(data)[0]['button'])['btn_name']);
              $(`#sliderDescr`).val((JSON.parse(data)[0]['description']));
              $(`#sliderTitle`).val(JSON.parse(data)[0]['title']);
              $(`#sliderFile`).val(JSON.parse(data)[0]['file']);
              $(`#sliderButtonName`).val((JSON.parse(data)[0]['button'])['btn_name_az']);
              $(`#sliderButtonColor`).val((JSON.parse(data)[0]['button'])['btn_color_az']);
              $(`#sliderButtonUrl`).val((JSON.parse(data)[0]['button'])['btn_uri_az']);
       })
      
})
$(document).on('click','.delete-slider',function(){
       Swal.fire({
              title:"Slayderi silmək istədiyinizdən əminsinizmi?",
              showDenyButton:true,
              icon:'info',
              confirmButtonText:'Bəli',
              denyButtonText:`Xeyr`,
       }).then((result) => {
              if(result.isConfirmed){
                     $.ajax({
                            type:"post",
                            url:"/dashboard/csapi/slider/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(){
                                   SliderTable.forceRender();
                                   Swal.fire('Silindi','','success');
                            }
                     })
              } else{
                     Swal.fire('Silinmədi','','info');
              }
       }
       )
})
if(top.location.pathname === '/dashboard/heroslider') {
       SliderTable.render(document.getElementById("slideListAz"));
}
$(document).on('submit','#SliderUploadForm',function(e){
       e.preventDefault();
       let fd = new FormData(document.getElementById("SliderUploadForm"));
       $.ajax({
              type:"post",
              url:"/dashboard/csapi/slider/add",
              contentType: false,
              cache: false,
              processData:false,
              data: fd,
              success:function(){
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     SliderTable.forceRender();
              }
       })
})
let parseLongTextElip = function(text, limit){
    if (text.length > limit){
        for (let i = limit; i > 0; i--){
            if(text.charAt(i) === ' ' && (text.charAt(i-1) != ','||text.charAt(i-1) != '.'||text.charAt(i-1) != ';')) {
                return text.substring(0, i) + '...';
            }
        }
         return text.substring(0, limit) + '...';
    }
    else
        return text;
  };
var SliderListTable = new gridjs.Grid({
    columns: ["E-poçt", "Tarix", "Mənbə"],
    pagination:{
       limit:10
       },
       sort:true,
       search:true,
       language:{
              'search':{
                     'placeholder': 'Axtarış...'
              }
       },
    server: {
        url: '/dashboard/csapi/subs',
        then: data => data.map(card => [
            card.email,
            card.created_at,
            `${(card.source ? parseLongTextElip(card.source, 50) : '---')}`,
            ,
        ]),
    }
});
$(".nav-tabs a").click(function(){
       $(".nav-tabs a").removeClass('active');
       $(".tab-content .slider-tab").css('display','none');
       $(this).addClass("active");
})
$(".btn-slider-az").click(function(){
       $('#slider_az').slideToggle();
})
$(".btn-slider-ru").click(function(){
       $('#slider_ru').slideToggle();
})
$(".btn-slider-en").click(function(){
       $('#slider_en').slideToggle();
})
//*
$(".slider-grid-az ").click(function(){
       $('#slideListAz').slideToggle();
})
$(".slider-grid-ru").click(function(){
       $('#slideListRu').slideToggle();
})
$(".slider-grid-en ").click(function(){
       $('#slideListEn').slideToggle();
})
if(top.location.pathname === '/dashboard/subscribers') {
    SliderListTable.render(document.getElementById("EmailSubTable"));
    $(".gridjs-search").css('float','right');
    $(".gridjs-head").append("<h4>Abunəlik</h4>")
   
}

if(top.location.pathname === '/dashboard/vacancies') {
    VacancyTable.render(document.getElementById("VacanciesTable"));
    $.ajax({
       type:'get',
       url: "/dashboard/csapi/brands/list",
       success:function(data){
              (JSON.parse(data)).forEach(item => {
                     $("#brand").append(`
                            <option value='${item.uniq_id}'>${item.name}</option>
                     `)
               })
              }
       })
       $.ajax({
              type:'get',
              url: "/dashboard/csapi/sectors/list",
              success:function(data){
                     data.forEach(item => {
                            $("#sector").append(`
                                   <option value='${item.uniq_id}'>${item.title}</option>
                            `)
                     })
              }
       })
}
let id__val=0;
$(document).on('click','.addJobDuty',function(){
       id__val++;
       $(".job_duty:last").after(`
       <input type="text" class="job_duty form-control w-25 ml-1 border border-light" id="job_duties"
       name="job_duties_${id__val}" minlength="2" required>
              `)
})
$(document).on('submit','#VacancyForm',function(e){
    e.preventDefault();
       let temp__job=[];
       let tmp__data = $("#VacancyForm").serializeArray().reduce(function(obj,item){
              obj[item.name] = item.value;
              if(item.name.includes("job_duties")){
                     temp__job.push(item.value);
              }
              obj["job_duty"] = temp__job;
              return obj;
       },{});

       $.post(`/dashboard/csapi/vacancy/post`,{
              _token: $('meta[name="csrf-token"]').attr('content'),
              brand_id: tmp__data.brand_id,
              deadline: tmp__data.deadline,
              description: tmp__data.description,
              job_duty: JSON.stringify(tmp__data.job_duty),
              job_requirements: JSON.stringify([tmp__data.job_requir_award,tmp__data.job_requir_exper,tmp__data.job_requir_special,tmp__data.job_requirements_edu]),
              job_title: tmp__data.job_title,
              location: tmp__data.location,
              other_information: tmp__data.other_information,
              salary: tmp__data.salary,
              schedule: tmp__data.schedule,
              schedule_type: tmp__data.schedule_type,
              sector_id: tmp__data.sector_id

       },
       function(data) {
              console.log(data)
              if(data==="Successfully") {
                     VacancyTable.forceRender();
                     Swal.fire('Yeniləndi', '', 'success');
                     $("#NewVacancyModal").modal("hide");
                     $("#VacancyForm")[0].reset()
              }
          });
})

$(document).on('click','.showVacancy',function(){
       let tmp__ = $(this).attr('data-uniq-id')
       $.get(`/dashboard/csapi/vacancy/get/${tmp__}`, function(data) {
              console.log(data);
              $("#modelWindows").modal("show");
              $(`#vacancySector`).val(data[0]['sector']);
              $(`#vacancyBrand`).val((data)[0]['brand']);
              $(`#vacancyJob`).val((data)[0]['job_title']);
              $(`#vacancyLctn`).val((data)[0]['location']);
              $(`#vacancyDdln`).val((data)[0]['deadline']);
              $(`#vacancySchType`).val((data)[0]['schedule_type']);
              $(`#vacancySch`).val((data)[0]['schedule']);
              $(`#vacancyDesc`).val((data)[0]['description']);
              $(`#vacancySalary`).val((data)[0]['salary']);
              $(`#vacancyRequir`).val((data)[0]['job_requirements']);
              $(`#vacancyDuties`).val((data)[0]['job_duties']);
              $(`#vacancyOtherInfo`).val((data)[0]['other_information']);
              $(`#vacancyStatus`).val((data)[0]['status']);
       })
      
})


