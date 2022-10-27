$(".addNewCampaignBTN").click(function() {
    $("#CampaignAddModal").modal("show")
})

var CampaignModalEditor = CKEDITOR.replace('CampaignModalEditor_input');