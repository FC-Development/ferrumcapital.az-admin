let SubscribedNotificationUserList = new gridjs.Grid({
    columns:[
        {name:"FIN"},
        {name:"ASA"},
        {name:'Qeydiyyat tarixi'},
    ],
    sort:true,
    pagination:{
        limit:10
    },
    server:{
        url:"https://ferrumcapital.az/api/mk/NotificationUserList",
        then:data => data.map(card => [
            card.title,
            card.tips_txt,
            card.create_time,
        ])
    }
})
if(top.location.pathname === '/dashboard/notification-center') {
    SubscribedNotificationUserList.render(document.getElementById("SubscribedNotificationUserList"));
    // var CampaignEditorMedia = CKEDITOR.replace( 'media_body' );
    // var CampaignEditorMediaEdit = CKEDITOR.replace( 'media_body_edit' );      
}
