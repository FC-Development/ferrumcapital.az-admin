function makeSideBar() {
       if (!localStorage.activeSideBar) {
              localStorage.setItem("activeSideBar", window.location.href);
              $(`.sidebar-layout a[href="${localStorage.activeSideBar}"]`).parent().addClass("active");
              console.log(localStorage.activeSideBar);
       }
       else {
              localStorage.setItem("activeSideBar", window.location.href);
              $(`.sidebar-layout a[href="${localStorage.activeSideBar}"]`).parent().addClass("active");
       }
}
function statusBtn(data, uniq_id, className) {
       if (data === 'active') {
              return `<button class="btn btn-sm btn-suc ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Aktiv</button>`
       }
       else if (data === "deactive") {
              return `<button class="btn btn-sm btn-dg ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Deaktiv</button>`
       }
       else {
              return `<button class="btn btn-sm btn-dk ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Seçim edilməyib</button>`
       }
}
makeSideBar();
let GetBlog = new gridjs.Grid({
       columns: [
              { name: "Başlıq", id: "title" },
              { name: 'Yaradılma tarixi', id: "created_at" },
              { name: 'Status', id: "status" },
              { name: "Əməliyyat" }
       ],
       sort: true,
       pagination: {
              limit: 10
       },
       server: {
              url: "/dashboard/csapi/blog/get",
              then: data => data.map(card => [
                     card.title,
                     card.create_time,
                     gridjs.html(statusBtn(card.status, card.uniq_id, "blogStatusBTN")),
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-blog" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-blog ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if (top.location.pathname === '/dashboard/blog') {
       GetBlog.render(document.getElementById("gridblog"));
       var CampaignEditorBlog = CKEDITOR.replace('blog_body');
       var CampaignEditorBlogEdit = CKEDITOR.replace('blog_body_edit');

}
$("#BlogForm").submit(function (e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("BlogForm"));
       fd.append('blog_body', CampaignEditorBlog.getData());
       $.ajax({
              type: "post",
              processData: false,
              url: "/dashboard/csapi/blog/post",
              contentType: false,
              cache: false,
              data: fd,
              success: function () {
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetBlog.forceRender();
                     $("#NewBlogModal").modal("hide");
              }
       })

})
$(document).on('click', '.delete-blog', function (e) {
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
                            url: "/dashboard/csapi/blog/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                   GetBlog.forceRender();
                                   Swal.fire('Silindi', '', 'success');
                            }
                     })
              } else {
                     Swal.fire('Silinmədi', '', 'info');
              }
       }
       )
})
$(document).on('click', '.update-blog', function () {
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type: "post",
              url: "/dashboard/csapi/blog/find",
              data: {
                     uniq_id: tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                     console.log(JSON.parse(data))
                     let parse_data = JSON.parse(data)[0];
                     console.log(parse_data);
                     $("#modelWindows").modal("show");
                     $("#UpdateBlog #meta_description").val(parse_data.meta_description)
                     $("#cover_edit").after(`<a href='${parse_data.cover}' target='_blank'>Şəkilə baxış</a>`)
                     $("#include_image_edit").after(`<a href='${parse_data.include_image}' target='_blank'>Şəkilə baxış</a>`)
                     CampaignEditorBlogEdit.setData(parse_data.blog_body);
                     $(`input[id='title_edit']`).val(parse_data.title)
                     $(`input[id='tips_text_edit']`).val(parse_data.tips_text)
              }
       })
})
$(document).on('submit', '#UpdateBlog', function (e) {
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('UpdateBlog'));
       fd__.append('blog_body_edit', CampaignEditorBlogEdit.getData());
       $.ajax({
              url: "/dashboard/csapi/blog/update",
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
                     GetBlog.forceRender();
              }
       })
})
$(".addNewBlogBTN").click(function () {
       $("#NewBlogModal").modal("show");
       $("#BlogForm")[0].reset();
       CKEDITOR.instances['blog_body'].setData('');
});
$(document).on('click', '.blogStatusBTN', function () {
       $("#blogStatusModal").modal("show")
       $(`#updateBlogStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
       var blogNotSelected = $(`#updateBlogStatusForm select option[value="${$(this).data("val")}"]`);
       if (blogNotSelected.length) {
              $(".blogNotSelected").remove();
              $(`#updateBlogStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
       }
})
$("#updateBlogStatusForm select").change(function () {
       $.post(`/dashboard/csapi/blog/status/update/${$(`#updateBlogStatusForm input[name="uniq_id"]`).val()}`, {
              status: $("#updateBlogStatusForm").find(":selected").val(),
              _token: $('meta[name="csrf-token"]').attr('content')
       },
              function (data) {
                     console.log(data)
                     if (data) {
                            GetBlog.forceRender();
                            Swal.fire('Yeniləndi', '', 'success');
                            $("#blogStatusModal").modal("hide");
                     }
              })
});