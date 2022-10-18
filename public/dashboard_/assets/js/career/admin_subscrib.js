
var SubscribeTable = new gridjs.Grid({
       columns: ["Email", "Göndərilmə tarixi"],
       pagination: {
              limit: 10
       },
       sort: true,
       server: {
              url: '/dashboard/csapi/get/subscribers',
              then: data => data.map((card, key) => [
                     card.email,
                     moment(card.created_at).format("LLL")
              ]),
       }
});
if (top.location.pathname === '/dashboard/subscription') {
       SubscribeTable.render(document.getElementById("subscriptionGrid"));
}