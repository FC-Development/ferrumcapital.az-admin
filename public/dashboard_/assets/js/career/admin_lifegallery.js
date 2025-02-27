$(".addGalleryBTN").click(function() {
       $("#NewGalleryModal").modal("show");
       $("#GalleryForm")[0].reset();
});
let GetLifeGalery=new gridjs.Grid({
       columns:[
                     {name:'Image',id:"image"},
                     {name:"Əməliyyat"}
              ],
              sort:true,
              pagination:{
                     limit:10
              },
       server:{
              url:"/dashboard/csapi/life_gallery/get",
              then:data => data.map(card => [
                     card.image_upload,
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm delete-photoGallery ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if(top.location.pathname === '/dashboard/life_gallery') {
       GetLifeGalery.render(document.getElementById("gridGallery"));       
}
$("#GalleryForm").submit(function(e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("GalleryForm"));
       $.ajax({
              type:"post",
              processData: false,
              url:"/dashboard/csapi/life_gallery/post",
              contentType: false,
              cache: false,
              data: fd,
              success:function(){
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetLifeGalery.forceRender();
                     $("#NewGalleryModal").modal("hide");
              }
       })
     
})
$(document).on('click','.delete-photoGallery',function(e){
       Swal.fire({
              title:"Photonu silmək istədiyinizdən əminsinizmi?",
              showDenyButton:true,
              icon:'info',
              confirmButtonText:'Bəli',
              denyButtonText:`Xeyr`,
       }).then((result) => {
              if(result.isConfirmed){
                     $.ajax({
                            type:"post",
                            url:"/dashboard/csapi/life_gallery/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(){
                                   GetLifeGalery.forceRender();
                                   Swal.fire('Silindi','','success');
                            }
                     })
              } else{
                     Swal.fire('Silinmədi','','info');
              }
       }
       )
})