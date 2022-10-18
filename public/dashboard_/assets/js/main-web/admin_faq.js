let GetFAQ=new gridjs.Grid({
       columns:[
                     {name:"Suallar",id:"question"},
                     {name:"Cavablar",id:"answer"},
                     {name:'Yaradılma tarixi',id:"created_at"},
                     {name:"Əməliyyat"}
              ],
              sort:true,
              pagination:{
                     limit:10
              },
       server:{
              url:"/dashboard/csapi/faq/get",
              then:data => data.map(card => [
                     card.question_az,
                     card.answer_az,
                     card.create_time,
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-faq" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-faq ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if(top.location.pathname === '/dashboard/faq') {
       GetFAQ.render(document.getElementById("gridfaq"));       
}
$("#FaqForm").submit(function(e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("FaqForm"));
       $.ajax({
              type:"post",
              processData: false,
              url:"/dashboard/csapi/faq/post",
              contentType: false,
              cache: false,
              data: fd,
              success:function(){
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetFAQ.forceRender();
                     $("#NewFaqModal").modal("hide");
              }
       })
     
})
$(document).on('click','.delete-faq',function(e){
       Swal.fire({
              title:"FAQ silmək istədiyinizdən əminsinizmi?",
              showDenyButton:true,
              icon:'info',
              confirmButtonText:'Bəli',
              denyButtonText:`Xeyr`,
       }).then((result) => {
              if(result.isConfirmed){
                     $.ajax({
                            type:"post",
                            url:"/dashboard/csapi/faq/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(){
                                   GetFAQ.forceRender();
                                   Swal.fire('Silindi','','success');
                            }
                     })
              } else{
                     Swal.fire('Silinmədi','','info');
              }
       }
       )
})
$(document).on('click','.update-faq',function(){
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type:"post",
              url: "/dashboard/csapi/faq/find",
              data: {
                     uniq_id:tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success:function(data){
                     let parse_data = (data)[0];
                     $("#UpdateFaqModal").modal("show");
                     $(`textarea[id='answer_az']`).val(parse_data.answer_az)
                     $(`textarea[id='answer_en']`).val(parse_data.answer_en)
                     $(`textarea[id='question_az']`).val(parse_data.question_az)
                     $(`textarea[id='question_en']`).val(parse_data.question_en)
              }
       })
})
$(document).on('submit','#UpdateFaq',function(e){
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('UpdateFaq'));
       $.ajax({
              url:"/dashboard/csapi/faq/update",
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
                     GetFAQ.forceRender();
                     $("#UpdateFaqModal").modal("hide");
              }
       })
})
$(".addNewFaqBTN").click(function() {
       $("#NewFaqModal").modal("show");
       $("#FaqForm")[0].reset();
});
