let GetBusinessPartner = new gridjs.Grid({
       columns: [
              { name: "Ad,Soyad" },
              { name: "Şəhər" },
              { name: "Göndərilmə tarixi" },
              { name: "Mobil nömrə" },
              { name: "İstiqamət" },
              { name: "Ətraflı bax" }
       ],
       sort: true,
       pagination: {
              limit: 10
       },
       server: {
              url: "csapi/get/business/partner/all/apply",
              then: data => data.map(card => [
                     card.fullname,
                     card.city,
                     moment(card.created_at).format("LLL"),
                     card.phone,
                     card.data_by == 'business' ? "Biznes müraciəti" : "Partnyor müraciəti",
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm showMore" data-uniq-id="${card.uniq_id}" data-data_by="${card.data_by}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                     </div>
                            `)
              ]),
       }
})
if (top.location.pathname === '/dashboard/business_partner_apply') {
       GetBusinessPartner.render(document.getElementById("business_partner_apply"));
}

$(document).on('click', '.showMore', function () {
       let uniq_id = $(this).attr('data-uniq-id')
       let section = $(this).attr('data-data_by')
       $.ajax({
              type: "get",
              url: `/dashboard/csapi/get/${section}/apply/${uniq_id}`,
              success: function (data) {
                     $("#BusinessPartnerApply").modal('show')
                     console.log(data);
                     Object.entries(data[0]).forEach(item => {
                            if (item[0] === 'data_by' && item[1] === 'business') {
                                   $(".adressDiv").after(`
                                   <div class="col-md-3 mb-3">
                                          <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Şirkət adı</label>
                                          <input type="text" class="form-control border border-light" id="company" name="company"
                                          minlength="2" required value="${data[0].company_name}">
                                   </div>
                                   `)
                            } else if (item[0] === 'data_by' && item[1] === 'partner') {
                                   $(".adressDiv").after(`
                                   <div class="col-md-3 mb-3">
                                          <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Mağaza adı</label>
                                          <input type="text" class="form-control border border-light" id="company" name="company"
                                          minlength="2" required value="${data[0].store_name}">
                                   </div>
                                   `)
                            }
                            else {
                                   $(`#BusinessPartnerApply [name=${item[0]}]`).val(item[1])
                            }
                     })
              }
       })
})