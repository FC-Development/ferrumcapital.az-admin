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