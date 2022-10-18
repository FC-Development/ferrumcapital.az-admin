$(".addNewBfStatsBTN").click(function() {
       $("#NewBfStatsModal").modal("show");
       $("#BfStatsForm")[0].reset();
});
let GetBfStats=new gridjs.Grid({
       columns:[
                     {name:"Header Aze",id:"header_az"},
                     {name:"Value",id:"value"},
                     {name:'Category Aze',id:"category_az"},
                     {name:"Əməliyyat"}
              ],
              sort:true,
              pagination:{
                     limit:10
              },
       server:{
              url:"/dashboard/csapi/bf-statistic/get",
              then:data => data.map(card => [
                     card.header_az,
                     card.value,
                     card.category_az,
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-bfStats" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-bfStats ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if(top.location.pathname === '/dashboard/bfstatistic') {
       GetBfStats.render(document.getElementById("gridBfStats"));       
}
$("#BfStatsForm").submit(function(e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("BfStatsForm"));
       $.ajax({
              type:"post",
              processData: false,
              url:"/dashboard/csapi/bf-statistic/post",
              contentType: false,
              cache: false,
              data: fd,
              success:function(){
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetBfStats.forceRender();
                     $("#NewBfStatsModal").modal("hide");
              }
       })
     
})
$(document).on('click','.delete-bfStats',function(e){
       Swal.fire({
              title:"Busines factory silmək istədiyinizdən əminsinizmi?",
              showDenyButton:true,
              icon:'info',
              confirmButtonText:'Bəli',
              denyButtonText:`Xeyr`,
       }).then((result) => {
              if(result.isConfirmed){
                     $.ajax({
                            type:"post",
                            url:"/dashboard/csapi/bf-statistic/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(){
                                   GetBfStats.forceRender();
                                   Swal.fire('Silindi','','success');
                            }
                     })
              } else{
                     Swal.fire('Silinmədi','','info');
              }
       }
       )
})
$(document).on('click','.update-bfStats',function(){
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type:"post",
              url: "/dashboard/csapi/bf-statistic/find",
              data: {
                     uniq_id:tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success:function(data){
                     let parse_data = (data)[0];
                     $("#BfStatsModal").modal("show");
                     $(`input[id='header_az']`).val(parse_data.header_az)
                     $(`input[id='header_en']`).val(parse_data.header_en)
                     $(`input[id='value']`).val(parse_data.value)
                     $(`input[id='category_az']`).val(parse_data.category_az)
                     $(`input[id='category_en']`).val(parse_data.category_en)
              }
       })
})
$(document).on('submit','#BfStatsUpdate',function(e){
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('BfStatsUpdate'));
       $.ajax({
              url:"/dashboard/csapi/bf-statistic/update",
              type:"post",
              contentType: false,
              cache: false,
              processData:false,
              data: fd__,
              success: function(data){
                     console.log(data)
                     Swal.fire(
                            'Uğurla yeniləndi!',
                            '',
                            'success'
                     )
                     GetBfStats.forceRender();
                     $("#BfStatsUpdate").modal("hide");
              }
       })
})

/** Partner Factory statistic */
$(".addNewPfStatsBTN").click(function() {
       $("#NewPfStatsModal").modal("show");
       $("#PfStatsForm")[0].reset();
});
let GetPfStats=new gridjs.Grid({
       columns:[
                     {name:"Header Aze",id:"header_az"},
                     {name:"Value",id:"value"},
                     {name:'Category Aze',id:"category_az"},
                     {name:"Əməliyyat"}
              ],
              sort:true,
              pagination:{
                     limit:10
              },
       server:{
              url:"/dashboard/csapi/pf-statistic/get",
              then:data => data.map(card => [
                     card.header_az,
                     card.value,
                     card.category_az,
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-pfStats" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-pfStats ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if(top.location.pathname === '/dashboard/pfstatistic') {
       GetPfStats.render(document.getElementById("gridPfStats"));       
}
$("#PfStatsForm").submit(function(e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("PfStatsForm"));
       $.ajax({
              type:"post",
              processData: false,
              url:"/dashboard/csapi/pf-statistic/post",
              contentType: false,
              cache: false,
              data: fd,
              success:function(){
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetPfStats.forceRender();
                     $("#NewPfStatsModal").modal("hide");
              }
       })
     
})
$(document).on('click','.delete-pfStats',function(e){
       Swal.fire({
              title:"Busines factory silmək istədiyinizdən əminsinizmi?",
              showDenyButton:true,
              icon:'info',
              confirmButtonText:'Bəli',
              denyButtonText:`Xeyr`,
       }).then((result) => {
              if(result.isConfirmed){
                     $.ajax({
                            type:"post",
                            url:"/dashboard/csapi/pf-statistic/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(){
                                   GetPfStats.forceRender();
                                   Swal.fire('Silindi','','success');
                            }
                     })
              } else{
                     Swal.fire('Silinmədi','','info');
              }
       }
       )
})
$(document).on('click','.update-pfStats',function(){
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type:"post",
              url: "/dashboard/csapi/pf-statistic/find",
              data: {
                     uniq_id:tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success:function(data){
                     let parse_data = (data)[0];
                     $("#PfStatsModal").modal("show");
                     $(`input[id='header_az']`).val(parse_data.header_az)
                     $(`input[id='header_en']`).val(parse_data.header_en)
                     $(`input[id='value']`).val(parse_data.value)
                     $(`input[id='category_az']`).val(parse_data.category_az)
                     $(`input[id='category_en']`).val(parse_data.category_en)
              }
       })
})
$(document).on('submit','#PfStatsUpdate',function(e){
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('PfStatsUpdate'));
       $.ajax({
              url:"/dashboard/csapi/pf-statistic/update",
              type:"post",
              contentType: false,
              cache: false,
              processData:false,
              data: fd__,
              success: function(data){
                     console.log(data)
                     Swal.fire(
                            'Uğurla yeniləndi!',
                            '',
                            'success'
                     )
                     GetPfStats.forceRender();
                     $("#PfStatsUpdate").modal("hide");
              }
       })
})
