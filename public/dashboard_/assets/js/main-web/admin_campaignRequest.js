let GetCampaignRequests = new gridjs.Grid({
    columns: [
        { name: "Ad,Soyad" },
        { name: "Finkod", id: "fincode" },
        { name: "Mobil nömrə"},
        { name: "Kampaniya mənbəsi" },
        { name: "Status" }
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
            card.campaignSource,
            gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-brandSec" data-uniq-id="${card.uniq_id}">
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

if (top.location.pathname === '/dashboard/campaigns/request') {
    GetCampaignRequests.render(document.getElementById("campaign_request_list"));
}
