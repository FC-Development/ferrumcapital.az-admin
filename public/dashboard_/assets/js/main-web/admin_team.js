let GetTeam = new gridjs.Grid({
       columns: [
              { name: "Fullname Az", id: "fullname" },
              { name: 'Title' },
              { name: "Əməliyyat" }
       ],
       sort: true,
       pagination: {
              limit: 10
       },
       server: {
              url: "/dashboard/csapi/team/get",
              then: data => data.map(card => [
                     card.fullname_az,
                     card.title_az,
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-team" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-team ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if (top.location.pathname === '/dashboard/team') {
       GetTeam.render(document.getElementById("gridteam"))
}
$(".addNewTeamBTN").click(function () {
       $("#NewTeamModal").modal("show");
       $("#TeamForm")[0].reset();
});
var id__img = 0;
/*
$(document).on('click', ".addImageField", function(){
       id__img++;
       $(".addImageField").remove();
       $("#img_part").append(`
       <div class="col-md-6 mb-3 mt-3 last_another_img">
              <span class="f-sm form-label font-weight-bold text-muted text-uppercase"></span>
              <div class="custom-file mt-8">
              <input type="file" class="custom-file-input image_field" id="another_image_${id__img}"
                     name="another_image[]">
              <label for="another_image" class="custom-file-label  file_upl">Seçim edin</label>
              </div>
       </div>
       <button type="button" class="btn btn-sm addImageField">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="red" class="bi bi-plus-circle" viewBox="0 0 16 16">
                     <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                     <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
              </svg>
       </button>
       `)
})
*/
$("#TeamForm").submit(function (e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("TeamForm"));
       $.ajax({
              type: "post",
              processData: false,
              url: "/dashboard/csapi/team/post",
              contentType: false,
              cache: false,
              data: fd,
              success: function () {
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
              }
       })

})
$(document).on('click', '.delete-team', function (e) {
       Swal.fire({
              title: "Teami silmək istədiyinizdən əminsinizmi?",
              showDenyButton: true,
              icon: 'info',
              confirmButtonText: 'Bəli',
              denyButtonText: `Xeyr`,
       }).then((result) => {
              if (result.isConfirmed) {
                     $.ajax({
                            type: "post",
                            url: "/dashboard/csapi/team/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                   GetTeam.forceRender();
                                   Swal.fire('Silindi', '', 'success');
                            }
                     })
              } else {
                     Swal.fire('Silinmədi', '', 'info');
              }
       }
       )
})
$(document).on('click', '.update-team', function () {
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type: "post",
              url: "/dashboard/csapi/team/find",
              data: {
                     uniq_id: tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                     console.log((data))
                     let parse_data = (data)[0];
                     console.log(parse_data.activity_az)
                     $("#UpdateTeamModal").modal("show");
                     $(`input[id='fullname_az']`).val(parse_data.fullname_az)
                     $(`input[id='fullname_en']`).val(parse_data.fullname_en)
                     $(`textarea[id='activity_az']`).val(parse_data.activity_az)
                     $(`textarea[id='activity_en']`).val(parse_data.activity_en)
                     $(`input[id='title_az']`).val(parse_data.title_az)
                     $(`#TeamUpdate #another_image`).after(`<a href="${parse_data.another_image}" target="_blank">Şəkilə bax</a>`)
                     $(`#TeamUpdate #cover_photo`).after(`<a href="${parse_data.cover_photo}" target="_blank">Şəkilə bax</a>`)
                     $(`#TeamUpdate #another_image_2`).after(`<a href="${parse_data.another_image_2}" target="_blank">Şəkilə bax</a>`)
                     $(`input[id='title_en']`).val(parse_data.title_en)
                     $(`input[id='linkedin']`).val(parse_data.linkedin)
                     $(`input[id='another_link']`).val(parse_data.another_link)
                     $(`textarea[id='about_text_az']`).val(parse_data.about_text_az)
                     $(`textarea[id='about_text_en']`).val(parse_data.about_text_en)
              }
       })
})
$(document).on('submit', '#TeamUpdate', function (e) {
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('TeamUpdate'));
       $.ajax({
              url: "/dashboard/csapi/team/update",
              type: "post",
              contentType: false,
              cache: false,
              processData: false,
              data: fd__,
              success: function (data) {
                     console.log(data)
                     Swal.fire(
                            'Uğurla yeniləndi!',
                            '',
                            'success'
                     )
                     GetTeam.forceRender();
              }
       })
})
