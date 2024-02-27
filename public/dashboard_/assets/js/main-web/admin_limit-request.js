let gridLimitRequest = new gridjs.Grid({
       columns:[
                     {name:"Ad Soyad"},
                     {name:"FİN kod"},
                     {name:"Telefon nömrəsi"},
                     {name:"Tələb edilən limit məbləği"},
                     {name:"Əlavə edilən qeyd"},
                     {name:'Müraciət tarixi'},
                     {name:"Əməliyyat"}
              ],
              sort:true,
              pagination:{
                     limit:10
              },
       server:{
              url:"https://ferrumcapital.az/api/fc-limit-list",
              then:data => data.map(card => [
                     card.fullname,
                     card.fin_code,
                     card.phone_number,
                     card.new_limit_amount,
                     card.notes,
                     moment(card.created_at).lang('az').format('LLL'),
                     gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm update-faq" data-uniq-id="${card.uniq_id}">
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
if(top.location.pathname === '/dashboard/limit-request-list-all') {
       gridLimitRequest.render(document.getElementById("gridLimitRequest"));       
}
