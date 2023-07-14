let GetCampaignRequests = new gridjs.Grid({
    columns: [
        { name: "Ad,Soyad" },
        { name: "Finkod", id: "fincode", width: '155px' },
        { name: "Mobil nömrə", width: '200px'},
        { name: "Kampaniya mənbəsi" },
        { name: "Status", width: '155px' },
        { name: "Mwraciət tarixi" }
    ],
    sort: true,
    pagination: {
        limit: 10
    },
    server: {
        url: "/dashboard/csapi/campaign/request/list",
        then: data => data.map(card => [
            `${card.name} ${card.surname}`,
            card.finCode,
            card.mobilePhone,
            gridjs.html(`${card.campaignSource}`),
            gridjs.html(`${statusBtnRequest(card.status,card.uniq_id,'changeRequestStatus')}`),
            gridjs.html(`${moment(card.created_at).lang("az").format("LLL")}`),
        ]),
    }
})
function statusBtnRequest(data, uniq_id, className) {
    if (data === 'gözləmədə') {
        return `<button class="btn btn-sm btn-suc ${className}" data-val="${data}" data-uniq-id="${uniq_id}">gözləmədə</button>`
    }
    else if (data === "zəng edildi") {
        return `<button class="btn btn-sm btn-warning ${className}" data-val="${data}" data-uniq-id="${uniq_id}">zəng edildi</button>`
    }
    else if (data === "rədd edildi") {
        return `<button class="btn btn-sm btn-dg ${className}" data-val="${data}" data-uniq-id="${uniq_id}">rədd edildi</button>`
    }
    else {
        return `<button class="btn btn-sm btn-dk ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Seçim edilməyib</button>`
    }
}
$(document).on("click",".changeRequestStatus",function (){
    $("#RequestStatusModal").modal("show")
    $(`#updateCampaignRequestStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
})
$("#updateCampaignRequestStatusForm select").change(function () {
    $.post(`/dashboard/csapi/campaign/request/update/status/${$(`#updateCampaignRequestStatusForm input[name="uniq_id"]`).val()}`, {
            status: $("#requestStatus").find(":selected").val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        function (data) {
            console.log(data)
            if (data) {
                GetCampaignRequests.forceRender();
                Swal.fire('Yeniləndi', '', 'success');
                $("#RequestStatusModal").modal("hide");
            }
        })
});
if (top.location.pathname === '/dashboard/campaigns/request') {
    GetCampaignRequests.render(document.getElementById("campaign_request_list"));
}
