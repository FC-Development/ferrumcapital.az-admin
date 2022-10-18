let GetGuide=new gridjs.Grid({
       columns:[
                     {name:"Başlıq",id:"title"},
                     {name:"Cover",id:"cover"},
                     {name:'File',id:"file_upload"},
                     {name:'Yaradılma tarixi',id:"created_at"},
                     {name:'Status',id:"status"},
                     {name:"Əməliyyat"}
              ],
              sort:true,
              pagination:{
                     limit:10
              },
       server:{
              url:"/dashboard/csapi/guides/get",
              then:data => data.map(card => [
                     card.title,
                     card.cover,
                     card.file_upload,
                     card.create_time,
                     gridjs.html(statusBtn(card.status,card.uniq_id,"guideStatusBTN")),
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-guide" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-guide ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if(top.location.pathname === '/dashboard/guide') {
       GetGuide.render(document.getElementById("gridguide"));       
}
$("#GuideForm").submit(function(e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("GuideForm"));
       $.ajax({
              type:"post",
              processData: false,
              url:"/dashboard/csapi/guides/post",
              contentType: false,
              cache: false,
              data: fd,
              success:function(){
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetGuide.forceRender();
                     $("#NewGuideModal").modal("hide");
              }
       })
     
})

$(document).on('click','.delete-guide',function(e){
       Swal.fire({
              title:"Guide silmək istədiyinizdən əminsinizmi?",
              showDenyButton:true,
              icon:'info',
              confirmButtonText:'Bəli',
              denyButtonText:`Xeyr`,
       }).then((result) => {
              if(result.isConfirmed){
                     $.ajax({
                            type:"post",
                            url:"/dashboard/csapi/guides/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(){
                                   GetGuide.forceRender();
                                   Swal.fire('Silindi','','success');
                            }
                     })
              } else{
                     Swal.fire('Silinmədi','','info');
              }
       }
       )
})
$(document).on('click','.update-guide',function(){
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type:"post",
              url: "/dashboard/csapi/guides/find",
              data: {
                     uniq_id:tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success:function(data){
                     console.log(JSON.parse(data))
                     let parse_data = JSON.parse(data)[0];
                     $("#GuideModal").modal("show");
                     $(`input[id='title']`).val(parse_data.title)
              }
       })
})
$(document).on('submit','#UpdateGuide',function(e){
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('UpdateGuide'));
       $.ajax({
              url:"/dashboard/csapi/guides/update",
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
                     GetGuide.forceRender();
                     $("#GuideModal").modal("hide");
              }
       })
})
$(".addNewGuideBTN").click(function() {
       $("#NewGuideModal").modal("show");
       $("#GuideForm")[0].reset();
});
$(document).on('click','.guideStatusBTN',function(){
       $("#guideStatusModal").modal("show")
       $(`#updateGuideStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
       var guideNotSelected = $(`#updateGuideStatusForm select option[value="${$(this).data("val")}"]`);
       if(guideNotSelected.length) 
       {
              $(".guideNotSelected").remove();
              $(`#updateGuideStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
       }
})
$("#updateGuideStatusForm select").change( function() {
       $.post(`/dashboard/csapi/guides/status/update/${$(`#updateGuideStatusForm input[name="uniq_id"]`).val()}`, {
           status: $("#updateGuideStatusForm").find(":selected").val(),
           _token: $('meta[name="csrf-token"]').attr('content')
       },
       function(data) {
              console.log(data)
           if(data) {
              GetGuide.forceRender();
               Swal.fire('Yeniləndi', '', 'success');
               $("#guideStatusModal").modal("hide");
           }
       })      
});