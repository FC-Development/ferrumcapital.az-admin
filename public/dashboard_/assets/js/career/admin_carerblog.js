let GetCareerBlog = new gridjs.Grid({
       columns: [
              { name: "Başlıq", id: "title" },
              { name: "Tips text", id: "tips_txt" },
              { name: 'Yaradılma tarixi', id: "created_at" },
              { name: 'Status', id: "status" },
              { name: "Əməliyyat" }
       ],
       sort: true,
       pagination: {
              limit: 10
       },
       server: {
              url: "/dashboard/csapi/careerblog/get",
              then: data => data.map(card => [
                     card.title,
                     card.tips_txt,
                     card.create_time,
                     gridjs.html(statusBtn(card.status, card.uniq_id, "cBlogStatusBTN")),
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-cblog" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-cblog ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if (top.location.pathname === '/dashboard/career_blog') {
       GetCareerBlog.render(document.getElementById("gridCareerblog"));
       var CampaignEditorCareerBlog = CKEDITOR.replace('blog_body');
       var CampaignEditorCareerBlogEdit = CKEDITOR.replace('blog_body_edit');

}
$("#CareerBlogForm").submit(function (e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("CareerBlogForm"));
       fd.append('blog_body', CampaignEditorCareerBlog.getData());
       $.ajax({
              type: "post",
              processData: false,
              url: "/dashboard/csapi/careerblog/post",
              contentType: false,
              cache: false,
              data: fd,
              success: function () {
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetCareerBlog.forceRender();
                     $("#NewCareerBlogModal").modal("hide");
              }
       })

})
$(document).on('click', '.delete-cblog', function (e) {
       Swal.fire({
              title: "Bloqu silmək istədiyinizdən əminsinizmi?",
              showDenyButton: true,
              icon: 'info',
              confirmButtonText: 'Bəli',
              denyButtonText: `Xeyr`,
       }).then((result) => {
              if (result.isConfirmed) {
                     $.ajax({
                            type: "post",
                            url: "/dashboard/csapi/careerblog/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                   GetCareerBlog.forceRender();
                                   Swal.fire('Silindi', '', 'success');
                            }
                     })
              } else {
                     Swal.fire('Silinmədi', '', 'info');
              }
       }
       )
})
$(document).on('click', '.update-cblog', function () {
       let tmp__ = $(this).attr('data-uniq-id')
    $("#UpdateCareerBlog").reset();
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type: "post",
              url: "/dashboard/csapi/careerblog/find",
              data: {
                     uniq_id: tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                     let parse_data = (data)[0];
                     $("#CareerModalUpd").modal("show");
                     $("#UpdateCareerBlog #cover_edit").after(`<a href="${parse_data.cover}">Şəkilə bax</a>`)
                     $("#UpdateCareerBlog #include_image_edit").after(`<a href="${parse_data.include_image}">Şəkilə bax</a>`)
                     CampaignEditorCareerBlogEdit.setData(parse_data.blog_body);
                     $(`input[id='title_edit']`).val(parse_data.title)
                     $(`input[id='tips_text_edit']`).val(parse_data.tips_text)
                     $("#UpdateCareerBlog #meta_description").val(parse_data.meta_description)
              }
       })
})
$(document).on('submit', '#UpdateCareerBlog', function (e) {
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('UpdateCareerBlog'));
       fd__.append('blog_body_edit', CampaignEditorCareerBlogEdit.getData());
       $.ajax({
              url: "/dashboard/csapi/careerblog/update",
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
                     GetCareerBlog.forceRender();
              }
       })
})
$(".addNewCareerBlogBTN").click(function () {
       $("#NewCareerBlogModal").modal("show");
       $("#CareerBlogForm")[0].reset();
       CKEDITOR.instances['blog_body'].setData('');
});
$(document).on('click', '.cBlogStatusBTN', function () {
       $("#CblogStatusModal").modal("show")
       $(`#updateCBlogStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
       var cblogNotSelected = $(`#updateCBlogStatusForm select option[value="${$(this).data("val")}"]`);
       if (cblogNotSelected.length) {
              $(".blogNotSelected").remove();
              $(`#updateCBlogStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
       }
})
$("#updateCBlogStatusForm select").change(function () {
       $.post(`/dashboard/csapi/career_blog/status/update/${$(`#updateBlogStatusForm input[name="uniq_id"]`).val()}`, {
              status: $("#updateCBlogStatusForm").find(":selected").val(),
              _token: $('meta[name="csrf-token"]').attr('content')
       },
              function (data) {
                     console.log(data)
                     if (data) {
                            GetCareerBlog.forceRender();
                            Swal.fire('Yeniləndi', '', 'success');
                            $("#CblogStatusModal").modal("hide");
                     }
              })
});
