$(".addNewCampaignBTN").click(function() {
    $("#CampaignAddModal").modal("show")
})

var CampaignModalEditor = CKEDITOR.replace('CampaignModalEditor_input');

let CampaignListTable = new gridjs.Grid({
    columns: [
        { name: "Başlıq", id: "title", sort: false },
        { name: "Tarix", id: "date", sort: false },
        { name: "---", sort: false }
    ],
    pagination: {
        limit: 10
    },
    sort: true,
    server: {
        url: "/dashboard/csapi/campaigns/list",
        then: data => data.map(card => [
            card.campaign_title,
            `${moment(card.created_at).locale("az").format("LLL")}`,
            gridjs.html(`<div class='d-flex'>
            <button class="btn btn-sm  delete-Campaigns mr-1" data-uniq-id="${card.uniq_id}">
            <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            </button>
            </div>`)
        ]),
    }
})
if (top.location.pathname === '/dashboard/campaigns') {
    CampaignListTable.render(document.getElementById("CampaignListTable"));
    $(document).on("click", ".delete-Campaigns", () => {
        $.ajax({
            type: "POST",
            url: `/dashboard/csapi/campaigns/delete/${$(this).data("uniq-id")}`,
            success: (data) => {
                Swal.fire('Silindi', '', 'success')
                console.log(data)
            },
            error: () => {
                alert("Xəta baş verdi")
                console.log(data)
            }
        })
    })
}