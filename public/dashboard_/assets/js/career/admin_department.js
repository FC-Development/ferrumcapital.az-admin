var ID = function () {
    // Math.random should be unique because of its seeding algorithm.
    // Convert it to base 36 (numbers + letters), and grab the first 9 characters
    // after the decimal.
    return '_' + Math.random().toString(36).substr(2, 9);
};
var DepartmentTable = new gridjs.Grid({
    columns: ["Department","Yaradılma tarixi","Silmək"],
    pagination: {
        limit: 10
    },
    sort: true,
    server: {
        url: '/dashboard/csapi/get/department/all',
        then: data => data.map((card, key) => [
            card.title,
            moment(card.created_at).format("LL"),
            gridjs.html(`
               <button class="btn btn-sm deleteDepartmentBTN ml-3" data-uniq-id="${card.uniq_id}">
                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                   </svg>
               </button>`)
        ]),
    }
});
if (top.location.pathname == '/dashboard/department'){
    DepartmentTable.render(document.getElementById("DepartmentTable"))
}
$(document).on("click",'.deleteDepartmentBTN',function (){
    Swal.fire({
        title: "Departamenti silmək istədiyinizdən əminsinizmi?",
        showDenyButton: true,
        icon: 'info',
        confirmButtonText: 'Bəli',
        denyButtonText: `Xeyr`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/dashboard/csapi/delete/department",
                data: {
                    uniq_id: $(this).attr("data-uniq-id"),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    DepartmentTable.forceRender();
                    Swal.fire('Silindi', '', 'success');
                },
                error:function (request,status,error) {
                    Swal.fire('Departamentə uyğun vakansiya mövcuddur!', '', 'warning');
                }
            })
        } else {
            Swal.fire('Silinmədi', '', 'info');
        }
    })
})
$(document).on('submit', '#departmentForm', function (e) {
    e.preventDefault();
    let url = "/dashboard/csapi/create/department"
    let tmp__ = {};
    $(this).serializeArray().map(function (obj, item) {
        tmp__[obj.name] = obj.value
        tmp__['slug'] = obj.value.replaceAll(' ', '-').toLowerCase()
        tmp__['uniq_id'] = ID()
    })
    $.ajax({
        type: "POST",
        url: url,
        contentType: "application/json",
        data: JSON.stringify(
            tmp__
        ),
        headers: {
            'xc-auth': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Inl1c2lmLmV5bnVsbGFiZXlsaUBmZXJydW1jYXBpdGFsLmF6IiwiZmlyc3RuYW1lIjpudWxsLCJsYXN0bmFtZSI6bnVsbCwiaWQiOjEsInJvbGVzIjoidXNlciIsImlhdCI6MTY2MDkwOTkxMX0.HttDn-LRM3wErtkaamXwJVhEmMpm0JX2gizDjlg0MTM'
        },
        success: function (response) {
            console.log(response)
        }
    })
})
