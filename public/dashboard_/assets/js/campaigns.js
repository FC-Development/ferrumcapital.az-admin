$(".addNewCampaignBTN").click(function() {
    $("#CampaignAddModal").modal("show")
    $("#campaign_partner_input").empty();
    //optionlarin hamisi onceden temizlenir
    $("#campaign_partner_input").empty();
    $.ajax({
        type: "GET",
        url: `/dashboard/csapi/campaigns/partner/list`,
        success: (data) => {
            data.sort((a, b) => { return a.name.localeCompare(b.name); });
            data.forEach((val) => {
                $("#campaign_partner_input").append(`<option value="${val.uniq_id}" value-name="${val.name}">${val.name}</option>`);
            });
            var $disabledResults = $("#campaign_partner_input");
            $disabledResults.select2({
                dropdownParent: $("#CampaignAddModal"),
                minimumResultsForSearch: 0,
                placeholder: "Seç",
                allowClear: true
            });
        }
    });
})

if(window.location.pathname === '/dashboard/campaigns') {
    var CampaignModalEditor = CKEDITOR.replace('CampaignModalEditor_input');
}

let CampaignListTable = new gridjs.Grid({
    columns: [
        { name: "Başlıq", id: "title", sort: false },
        { name: "Şəkil", sort: false, width: '130px' },
        { name: "Mobil şəkil", sort: false, width: '130px' },
        { name: "Tarix", sort: true },
        { name: "Son tarix", sort: true },
        { name: "---", sort: false, width: '130px' }
    ],
    pagination: {
        limit: 10
    },
    sort: true,
    search: true,
    server: {
        url: "/dashboard/csapi/campaigns/list",
        then: data => data.map(card => [
            card.campaign_title,
            gridjs.html(`<a href="${card.campaign_image}" target="_blank">link</a>`),
            gridjs.html(`<a href="${card.campaign_mobile_image}" target="_blank">link</a>`),
            `${moment(card.created_at).locale("az").format("LLL")}`,
            `${moment(card.end_duration).locale("az").format("LLL")}`,
            gridjs.html(`<div class='d-flex'>
            <button class="btn btn-sm  delete-Campaigns mr-1" data-uniq-id="${card.uniq_id}">
            <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg></button>
            <button class="btn btn-sm  edit-Campaigns mr-1" data-uniq-id="${card.uniq_id}">
            <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#000" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg></button></div>`)
        ]),
    }
})
if(top.location.pathname === '/dashboard/campaigns') {
    CampaignListTable.render(document.getElementById("CampaignListTable"));
    $(document).on("click", ".delete-Campaigns", function(e) {
        $("#loading").show()
        var id = $(this).attr("data-uniq-id");
        console.log(id);
        $.ajax({
            type: "POST",
            url: `/dashboard/csapi/campaigns/delete/${id}`,
            data: {
                id: id,
                _token : $(`meta[name="csrf-token"]`).attr("content")
            },
            success: (data) => {
                Swal.fire('Silindi', '', 'success')
                console.log(data)
                $("#loading").hide()
            },
            error: (data) => {
                alert("Xəta baş verdi")
                console.log(data)
                $("#loading").hide()
            },
            complete: (data) => {
                $("#CampaignAddModal").modal("hide")
                CampaignListTable.forceRender(document.getElementById("CampaignListTable"));
                $("#loading").hide()
                console.log(data);
            }
        })
    });
    $(document).on("click", ".edit-Campaigns", function(e) {
        //$("#loading").show()
        var id = $(this).attr("data-uniq-id");
        console.log(id);
        $("#edit_campaign_title_input").val("ddd")
        $("#CampaignEditModal").modal("show");
    })
    $("#NewCampaignForm").submit((e) => {
        e.preventDefault();
        var fd__25 = new FormData(document.getElementById('NewCampaignForm'));
        fd__25.append('CampaignModalEditor_input', CampaignModalEditor.getData());
        fd__25.append('CampaignPartnerModalEditor_input', $("#campaign_partner_input").find(":selected").attr('value'));
        if(CampaignModalEditor.getData().length > 3) {
            $("#loading").show()
            $.ajax({
                type: "POST",
                url: `/dashboard/csapi/campaigns/new`,
                contentType: false,
                cache: false,
                processData: false,
                data: fd__25,
                success: () => {
                    Swal.fire('Məlumat', 'yeni kampaniya uğurla əlavə edildi', 'success')
                    $("#loading").hide()
                },
                error: (resp) => {
                    console.log(resp.responseJSON)
                    Swal.fire('Xəta', `${resp.responseJSON}`, 'error')
                    $("#loading").hide()
                },
                complete: (data) => {
                    $("#CampaignAddModal").modal("hide")
                    CampaignListTable.forceRender(document.getElementById("CampaignListTable"));
                    $("#loading").hide()
                    console.log(data);
                }
            })
        }
        else {
            alert("Açıqlama doldurun")
        }
    })
}
