$(".addNewCustomerSliderBTN").click(function() {
    $("#NewCustomerSliderModal").modal("show");
})
$("#NewCustomerSliderForm").submit(function(e){
    e.preventDefault()
    $.ajax({
        url: "/dashboard/csapi/create/FerrumCapital/MusteriKabineti/slider",
        type: "post",
        dataType: "json",
        data: $("#NewCustomerSliderForm").serialize(),
        beforeSend: function () {
            $(document).find('span.alert-danger').remove();
            },
        success: function (data) {
            Swal.fire('Əlavə olundu', '', 'success');
            $("#NewCustomerSliderForm")[0].reset();
            },
        error: function (response) {
            $.each(response.responseJSON.errors, function (field_name, error) {
                $(document).find('[name=' + field_name + ']').parent().after('<span class="mt-2 text-strong alert alert-danger">' + error + '</span>')
            })
        }
    })
})

let GetMkSlider = new gridjs.Grid({
    columns: [
        { name: "Başlıq", id: "title" },
        { name: "Açıqlama", id: "description" },
        { name: "---" }
    ],
    pagination: {
        limit: 10
    },
    sort: true,
    server: {
        url: "/dashboard/csapi/get/FerrumCapital/MusteriKabineti/slider",
        then: data => data.data.map(card => [
            card.title,
            card.description,
            gridjs.html(`
            <div class='d-flex'>
            <button class="btn btn-sm  delete-mkSlider mr-1" data-uniq-id="${card.uniq_id}">
                         <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                         </svg>
                         </button>
                         </div>
            `)
        ]),
    }
})
if (top.location.pathname === '/dashboard/mkslider') {
    GetMkSlider.render(document.getElementById("grid_mkSlider"));
}

$(document).on("click",".delete-mkSlider",function(){
    e.preventDefault();
    Swal.fire({
        title: "Kontenti silmək istədiyinizdən əminsinizmi?",
        showDenyButton: true,
        icon: 'info',
        confirmButtonText: 'Bəli',
        denyButtonText: `Xeyr`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/dashboard/csapi/delete/FerrumCapital/MusteriKabineti/slider",
                data: {
                    uniq_id: $(this).attr("data-uniq-id"),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    GetMkSlider.forceRender();
                    Swal.fire('Silindi', '', 'success');
                }
            })
        } else {
            Swal.fire('Silinmədi', '', 'info');
        }
    }
    )
})