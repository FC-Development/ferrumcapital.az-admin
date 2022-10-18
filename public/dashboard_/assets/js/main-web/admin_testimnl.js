let GetTestmnl = new gridjs.Grid({
       columns: [
              { name: "Fullname Az", id: "fullname_az" },
              { name: "Quote Az", id: "quote_az" },
              { name: "Title Az", id: "title_az" },
              { name: 'Status', id: "status" },
              { name: "Əməliyyat" }
       ],
       sort: true,
       pagination: {
              limit: 10
       },
       server: {
              url: "/dashboard/csapi/testimonial-korp/get",
              then: data => data.map(card => [
                     card.fullname_az,
                     card.quote_az,
                     card.title_az,
                     gridjs.html(statusBtn(card.status, card.uniq_id, "testimnlStatusBTN")),
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-testimnl" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-testimnl ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if (top.location.pathname === '/dashboard/testimonialKorporativ') {
       GetTestmnl.render(document.getElementById("gridtestmnl"));
}
$(".addNewTestimnlBTN").click(function () {
       $("#NewTestimnlModal").modal("show");
       $("#TestimnlForm")[0].reset();
});
$("#TestimnlForm").submit(function (e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("TestimnlForm"));
       $.ajax({
              type: "post",
              processData: false,
              url: "/dashboard/csapi/testimonial-korp/post",
              contentType: false,
              cache: false,
              data: fd,
              success: function () {
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetTestmnl.forceRender();
                     $("#NewTestimnlModal").modal("hide");
              }
       })

})
$(document).on('click', '.delete-testimnl', function (e) {
       Swal.fire({
              title: "Testimoniali silmək istədiyinizdən əminsinizmi?",
              showDenyButton: true,
              icon: 'info',
              confirmButtonText: 'Bəli',
              denyButtonText: `Xeyr`,
       }).then((result) => {
              if (result.isConfirmed) {
                     $.ajax({
                            type: "post",
                            url: "/dashboard/csapi/testimonial-korp/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                   GetTestmnl.forceRender();
                                   Swal.fire('Silindi', '', 'success');
                            }
                     })
              } else {
                     Swal.fire('Silinmədi', '', 'info');
              }
       }
       )
})
$(document).on('click', '.update-testimnl', function () {
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type: "post",
              url: "/dashboard/csapi/testimonial-korp/find",
              data: {
                     uniq_id: tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                     console.log((data))
                     let parse_data = (data)[0];
                     $("#TestimnlModal").modal("show");
                     $("#UpdateTestimnl #image").after(`<a href="${parse_data.image}" target='_blank'>Şəkilə bax</a>`)
                     $("#UpdateTestimnl #company_logo").after(`<a href="${parse_data.company_logo}" target='_blank'>Şəkilə bax</a>`)
                     $(`textarea[id='quote_az']`).val(parse_data.quote_az)
                     $(`textarea[id='quote_en']`).val(parse_data.quote_en)
                     $(`input[id='fullname_az']`).val(parse_data.fullname_az)
                     $(`input[id='fullname_en']`).val(parse_data.fullname_en)
                     $(`input[id='title_en']`).val(parse_data.title_en)
                     $(`input[id='title_az']`).val(parse_data.title_az)
              }
       })
})
$(document).on('submit', '#UpdateTestimnl', function (e) {
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('UpdateTestimnl'));
       $.ajax({
              url: "/dashboard/csapi/testimonial-korp/update",
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
                     GetTestmnl.forceRender();
              }
       })
})
$(document).on('click', '.testimnlStatusBTN', function () {
       $("#testimnlStatusModal").modal("show")
       $(`#updateTestimnlStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
       var testimnlNotSelected = $(`#updateTestimnlStatusForm select option[value="${$(this).data("val")}"]`);
       if (testimnlNotSelected.length) {
              $(".testimnlNotSelected").remove();
              $(`#updateTestimnlStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
       }
})
$("#updateTestimnlStatusForm select").change(function () {
       $.post(`/dashboard/csapi/testimonial-korp/status/update/${$(`#updateTestimnlStatusForm input[name="uniq_id"]`).val()}`, {
              status: $("#updateTestimnlStatusForm").find(":selected").val(),
              _token: $('meta[name="csrf-token"]').attr('content')
       },
              function (data) {
                     console.log(data)
                     if (data) {
                            GetTestmnl.forceRender();
                            Swal.fire('Yeniləndi', '', 'success');
                            $("#testimnlStatusModal").modal("hide");
                     }
              })
});

/* Testimonial customer */
let GetTestmnlCustomer = new gridjs.Grid({
       columns: [
              { name: "Fullname Az", id: "fullname_az" },
              { name: "Text Az", id: "text_az" },
              { name: "Əməliyyat" }
       ],
       sort: true,
       pagination: {
              limit: 10
       },
       server: {
              url: "/dashboard/csapi/testimonial-cstmr/get",
              then: data => data.map(card => [
                     card.fullname_az,
                     card.text_az,
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-testimnl-cstmr" data-uniq-id="${card.uniq_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-testimnl-csmtr ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
              ]),
       }
})
if (top.location.pathname === '/dashboard/testimonialCustomer') {
       GetTestmnlCustomer.render(document.getElementById("gridtestimnlCstmr"));
}
$(".addNewTestimnlCstmrBTN").click(function () {
       $("#NewTestimnlCstmrModal").modal("show");
       $("#TestimnlCstmrForm")[0].reset();
});
$("#TestimnlCstmrForm").submit(function (e) {
       e.preventDefault();
       var fd = new FormData(document.getElementById("TestimnlCstmrForm"));
       $.ajax({
              type: "post",
              processData: false,
              url: "/dashboard/csapi/testimonial-cstmr/post",
              contentType: false,
              cache: false,
              data: fd,
              success: function () {
                     Swal.fire(
                            'Əlavə olundu!',
                            '',
                            'success'
                     )
                     GetTestmnlCustomer.forceRender();
                     $("#NewTestimnlCstmrModal").modal("hide");
              }
       })

})
$(document).on('click', '.delete-testimnl-csmtr', function (e) {
       Swal.fire({
              title: "Testimoniali silmək istədiyinizdən əminsinizmi?",
              showDenyButton: true,
              icon: 'info',
              confirmButtonText: 'Bəli',
              denyButtonText: `Xeyr`,
       }).then((result) => {
              if (result.isConfirmed) {
                     $.ajax({
                            type: "post",
                            url: "/dashboard/csapi/testimonial-cstmr/delete",
                            data: {
                                   id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                   GetTestmnlCustomer.forceRender();
                                   Swal.fire('Silindi', '', 'success');
                            }
                     })
              } else {
                     Swal.fire('Silinmədi', '', 'info');
              }
       }
       )
})
$(document).on('click', '.update-testimnl-cstmr', function () {
       let tmp__ = $(this).attr('data-uniq-id')
       $(`input[name="uniq_id"]`).val(tmp__);
       $.ajax({
              type: "post",
              url: "/dashboard/csapi/testimonial-cstmr/find",
              data: {
                     uniq_id: tmp__,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                     let parse_data = (data)[0];
                     $("#TestimnlCstmrModal").modal("show");
                     $(`textarea[id='text_az']`).val(parse_data.text_az)
                     $(`textarea[id='text_en']`).val(parse_data.text_en)
                     $(`input[id='fullname_az']`).val(parse_data.fullname_az)
                     $(`input[id='fullname_en']`).val(parse_data.fullname_en)
              }
       })
})
$(document).on('submit', '#UpdateTestimnlCstmr', function (e) {
       e.preventDefault();
       var fd__ = new FormData(document.getElementById('UpdateTestimnlCstmr'));
       $.ajax({
              url: "/dashboard/csapi/testimonial-cstmr/update",
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
                     GetTestmnlCustomer.forceRender();
              }
       })
})