let GetBrand = new gridjs.Grid({
    columns: [
        { name: "Logo", id: "logo", width: '100px' },
        { name: "Name", id: "name" },
        { name: 'Phone', id: "phone" },
        { name: 'City', id: "citySlider", width: '120px' },
        { name: 'Region', id: "regionSlider", width: '120px' },
        { name: 'Status', id: "status", width: '120px' },
        { name: "Slider", width: '100px'},
        { name: "Slider şəkil" },
        { name: "Slider şəkil mobil" },
        { name: "---", width: '130px' }
    ],
    sort: true,
    pagination: {
        limit: 10
    },
    search:true,
    server: {
        url: "/dashboard/csapi/brand/get",
        then: data => data.map(card => [
            gridjs.html(`<a href="${card.logo}" target="_blank">&#128279;</a>`),
            card.name,
            card.phone,
            card.city_name,
            card.region_name,
            gridjs.html(statusBtn(card.status, card.uniq_id, "brandStatusBTN")),
            gridjs.html(card.slider_img_status === "true" ? '&#9989;': '&#10060'),
            gridjs.html(card.slider_img_status === "true" ? `<a href="${card.slider_img_path}" target="_blank">&#128279;</a>` : '*' ),
            gridjs.html(card.slider_img_status === "true" ? `<a href="${card.slider_img_m_path}" target="_blank">&#128279;</a>` : '*' ),
            gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-brand" data-uniq-id="${card.uniq_id}">
                            <span class="flashing-dots" style="display: none;"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="btn btn-sm delete-brand ml-3" data-uniq-id="${card.uniq_id}">
                                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                            </button>
                     </div>
                     `)
        ]),
    }
})
if (top.location.pathname === '/dashboard/brand') {
    GetBrand.render(document.getElementById("gridbrand"));
    
    
    $.ajax({
        type: "get",
        url: "/dashboard/csapi/brand_sector/get",
        success: function(data) {
            let values = (data);
            values.forEach(each => {
                $(".brand_sector").append(
                    `<option value="${each.uniq_id}">${each.title_az}</option>`
                )
            })
        }
    })
    $.ajax({
        type:"get",
        url:"/api/cities/names",
        success: function(data){
            data.forEach(each => {
                $("#BrendForm #city").append(`<option value="${each.city_id}">${each.city_name}</option>`)
                $("#BrendUpdate #city").append(`<option value="${each.city_id}">${each.city_name}</option>`)
            })
        }
    })

    $("#BrendUpdate #city").on("change", function(){
        var cityId__ = $(this).val();
        $("#BrendUpdate #region").html(''); //clear options before select
        $("#region").siblings(".form-label").children("span").eq(0).hide();
        $("#region").siblings(".form-label").children("span").eq(1).show();
        $.ajax({
            type: "get",
            url: `/api/regions/${cityId__}`,
            success: function(data) {
                data.forEach(each => {
                    $("#BrendUpdate #region").append(`<option value="${each.region_id}">${each.region_name}</option>`)
                });
                $("#region").siblings(".form-label").children("span").eq(0).show();
                $("#region").siblings(".form-label").children("span").eq(1).hide();
            }
        })
    });
}
$(".addNewBrendBTN").click(function() {
    $(".additionalAddress").remove()
    $("#NewBrendModal").modal("show");
    $("#BrendForm")[0].reset();
});
$(document).on('click', '.addNewAddressPartner', function () {
    $(".partnerAddressBox:last").after(`
        <div class="col-md-4 mt-4 partnerAddressBox additionalAddress">
            <div class="input-group">
                <input type="text" class="form-control border border-light" id="adress" placeholder="Adress" name="adress"
                    minlength="2" >
                <div class='d-flex flex-column changingOnAddressBox'>
                    <button class="btn btn-primary addNewAddressPartner" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="15" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <button class="btn btn-danger removeAddingAddress" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="15" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
              `)
})
$(document).on("click",".addNewAddressPartnerEdit" , function(){
    $(".partnerAddressBoxEdit:last").after(`
    <div class="col-md-3 mt-4 partnerAddressBoxEdit additionalAddressEdit">
        <div class="input-group">
            <textarea type="text" class="form-control border border-light"  placeholder="Adress" 
                minlength="2" > </textarea>
            <div class='d-flex flex-column changingOnAddressBox'>
                <button class="btn btn-primary addNewAddressPartnerEdit" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="15" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <button class="btn btn-danger removeAddingAddress" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="15" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
          `)
})
$(document).on("click",".removeAddingAddress",function(){
    $(this).parents().eq(2).remove()
})
$("#BrendForm").submit(function(e) {
    e.preventDefault();
    var fd = new FormData(document.getElementById("BrendForm"));
   /* let additional_address = [];
    $(".additionalAddress").each((k,v) =>{ 
        additional_address.push($(v).find("input").val())
    })
    console.log(additional_address);
    fd.append("additional_address",JSON.stringify(additional_address)) */
    $.ajax({
        type: "post",
        processData: false,
        url: "/dashboard/csapi/brand/post",
        contentType: false,
        cache: false,
        data: fd,
        success: function() {
            Swal.fire(
                'Əlavə olundu!',
                '',
                'success'
            )
            GetBrand.forceRender();
            $("#NewBrendModal").modal("hide");
        }
    })

})
$(document).on('click', '.delete-brand', function(e) {
    Swal.fire({
        title: "Brandi silmək istədiyinizdən əminsinizmi?",
        showDenyButton: true,
        icon: 'info',
        confirmButtonText: 'Bəli',
        denyButtonText: `Xeyr`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/dashboard/csapi/brand/delete",
                data: {
                    id: $(this).attr("data-uniq-id"),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    GetBrand.forceRender();
                    Swal.fire('Silindi', '', 'success');
                }
            })
        } else {
            Swal.fire('Silinmədi', '', 'info');
        }
    })
})
$(document).on('click', '.update-brand', function() {
    $("#BrendUpdate #region").html(''); //clear region options before opening modal
    let tmp__ = $(this).attr('data-uniq-id');
    $(this).children("svg").hide();
    $(this).children(".flashing-dots").show();
    $(".additionalAddressEdit").remove()
    $(`input[name="uniq_id"]`).val(tmp__);
    $.ajax({
        type: "post",
        url: "/dashboard/csapi/brand/find",
        data: {
            uniq_id: tmp__,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $(".update-brand svg").show();
            $(".flashing-dots").hide();
            let parse_data = (data)[0];
            let additional_address = JSON.parse(parse_data.additional_address);
            $("#BrendModal").modal("show");
            $('#DisplayInSlider').prop('checked', parse_data.slider_img_status);
            $(`#BrendUpdate input[id='name']`).val(parse_data.name)
            $(`#BrendUpdate input[id='phone']`).val(parse_data.phone)
            $(`#BrendUpdate input[id='adress']`).val(parse_data.adress)
            // $(`#BrendUpdate input[id='city']`).val(parse_data.city) //bu artiq istifade olunmur
            $("#cityUpdateModal").siblings(".form-label").children("span").eq(0).hide();
            $("#cityUpdateModal").siblings(".form-label").children("span").eq(1).show();
            $.ajax({
                type: "get",
                url: `/api/cities/names`,
                success: function(data) {
                    data.forEach(each => {
                        $("#BrendUpdate #city").append(`<option value="${each.city_id}">${each.city_name}</option>`)
                    });
                    $(`#BrendUpdate #city option[value="${parse_data.city_id}"]`).prop('selected', true);
                    $("#cityUpdateModal").siblings(".form-label").children("span").eq(0).show();
                    $("#cityUpdateModal").siblings(".form-label").children("span").eq(1).hide();
                }
            });
            $("#region").siblings(".form-label").children("span").eq(0).hide();
            $("#region").siblings(".form-label").children("span").eq(1).show();
            $.ajax({
                type: "get",
                url: `/api/regions/${parse_data.city_id}`,
                success: function(data) {
                    data.forEach(each => {
                        $("#BrendUpdate #region").append(`<option value="${each.region_id}">${each.region_name}</option>`)
                    });
                    $("#region").siblings(".form-label").children("span").eq(0).show();
                    $("#region").siblings(".form-label").children("span").eq(1).hide();
                }
            });
            $(`#BrendUpdate input[id='website']`).val(parse_data.website)
            $(`#BrendUpdate input[id='ig']`).val(parse_data.ig)
            $(`#BrendUpdate input[id='fb']`).val(parse_data.fb)
            $(`#BrendUpdate #city`).val(parse_data.city)
            $('.brand_sector').val(parse_data.sector_id);
            /*if( additional_address!=null && additional_address.length >0) {
                $(additional_address).each((k,v) => {
                    $(".partnerAddressBoxEdit").parent().append(`
                        <div class="col-md-3 mt-4 partnerAddressBoxEdit additionalAddressEdit">
                            <div class="input-group">
                                <textarea type="text" class="form-control border border-light"  placeholder="Adress"
                                >${v}</textarea>
                                <div class='d-flex flex-column changingOnAddressBox'>
                                <button class="btn btn-primary addNewAddressPartnerEdit" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="15" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button class="btn btn-danger removeAddingAddress" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="15" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                            </button>
                            </div>
                        </div>
                    `)
                })
            }*/
        }
    })
})
$(document).on('submit', '#BrendUpdate', function(e) {
    e.preventDefault();
    var uploadStatus = $('#upload-status');
    $(".progress").show();
    var fd__ = new FormData(document.getElementById('BrendUpdate'));
    fd__.append('DisplayInSlider', $('#DisplayInSlider').is(':checked') ? true : false);
   /* let additional_address = [];
    $(".additionalAddressEdit").each((k,v) =>{ 
        additional_address.push($(v).find("textarea").val())
    })
    console.log(additional_address);
    fd__.append("additional_address",JSON.stringify(additional_address))*/
    $.ajax({
        url: "/dashboard/csapi/brand/update",
        type: "post",
        contentType: false,
        cache: false,
        processData: false,
        data: fd__,
        beforeSend: function() {
            uploadStatus.html('<p class="text-info flashing-dots">Yenilənir</p>');
        },
        success: function(data) {
            console.log(data)
            uploadStatus.html('<p class="text-success">Mağaza məlumatları yeniləndi!</p>');
            GetBrand.forceRender();
        },
        error: (resp) => {
            uploadStatus.html('<p class="text-danger">Xəta baş verdi bir daha cəhd edin.</p>');
            console.log(resp.responseJSON)
        },
    })
})
$('#BrendModal').on('hidden.bs.modal', function () {
    var uploadStatus = $('#upload-status');
    uploadStatus.html('');
});
$(document).on('click', '.brandStatusBTN', function() {
    $("#brandStatusModal").modal("show")
    $(`#updateBrandStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
    var brandNotSelected = $(`#updateBrandStatusForm select option[value="${$(this).data("val")}"]`);
    if (brandNotSelected.length) {
        $(".brandNotSelected").remove();
        $(`#updateBrandStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
    }
})
$("#updateBrandStatusForm select").change(function() {
            $.post(`/dashboard/csapi/brand/status/update/${$(`#updateBrandStatusForm input[name="uniq_id"]`).val()}`, {
           status: $("#updateBrandStatusForm").find(":selected").val(),
           _token: $('meta[name="csrf-token"]').attr('content')
       },
       function(data) {
              console.log(data)
           if(data) {
              GetBrand.forceRender();
               Swal.fire('Yeniləndi', '', 'success');
               $("#brandStatusModal").modal("hide");
           }
       })      
});