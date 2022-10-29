$(".addNewVacancyBTN").click(function () {
    $("#NewVacancyModal").modal("show");
    $("#Vacancy1Form")[0].reset();
});
let id__val_desc = 0;
$(document).on('click', '.addDescPunkt', function () {
    id__val_desc++;
    $(".desc_punkt:last").after(`
       <input type="text" class="desc_punkt form-control col-lg-3 ml-1  border border-light"
       name="desc_punkt_${id__val}" minlength="2" required>
              `)
})
let id__val_resp = 0;
$(document).on('click', '.addResponsPunkt', function () {
    id__val_resp++;
    $(".respons_punkt:last").after(`
       <input type="text" class="respons_punkt form-control col-lg-3 ml-1  border border-light"
       name="respons_punkt_${id__val}" minlength="2" required>
              `)
})

var VacancyTable = new gridjs.Grid({
    columns: ["Başlıq", "Department", "Yaradilma tarixi", "Status", "Emeliyat"],
    pagination: {
        limit: 4
    },
    sort: true,
    server: {
        url: '/dashboard/csapi/vacancy/get',
        then: data => data.map((card, key) => [
            card.title,
            card.d_title,
            moment(card.created_at).format("LL"),
            gridjs.html(sliderStatus(card.status, card.uniq_id, "vacancyStatusBTN")),
            gridjs.html(`<button class="btn btn-sm updateVacancy" data-uniq-id="${card.uniq_id}">
               <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-5 w-5" viewBox="0 0 20 20" fill="#8f9fbc">
                   <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                   <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
               </svg>
               </button>
               <button class="btn btn-sm deleteVacancyBTN ml-3" data-uniq-id="${card.uniq_id}">
                   <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                   </svg>
               </button>`)
        ]),
    }
});
$(document).on('submit', '#Vacancy1Form', function (e) {
    e.preventDefault();
    let temp__descr = [];
    let temp__resp = [];
    let tmp__data = $("#Vacancy1Form").serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        if (item.name.includes("desc_punkt")) {
            temp__descr.push(item.value);
        }
        if (item.name.includes("respons_punkt")) {
            temp__resp.push(item.value);
        }
        obj["desc_punkt"] = temp__descr;
        obj['respons_punkt'] = temp__resp;
        return obj;
    }, {});
    $.post(`/dashboard/csapi/vacancy/post`, {
        _token: $('meta[name="csrf-token"]').attr('content'),
        title: (tmp__data.title),
        department_id: (tmp__data.department_id),
        description: (tmp__data.description),
        responsibility: (tmp__data.responsibility),
        description_punkt: JSON.stringify(tmp__data.desc_punkt),
        respons_punkt: JSON.stringify(tmp__data.respons_punkt),
        extra_info: JSON.stringify({ "Department": tmp__data.department, 'salary': tmp__data.salary, 'time': tmp__data.time_duration, 'deadline': tmp__data.deadline, 'requirement': tmp__data.special_req }),
    },
        function (data) {
            if (data === "Successfully") {
                VacancyTable.forceRender();
                Swal.fire('Yeniləndi', '', 'success');
                $("#NewVacancyModal").modal("hide");
                $("#VacancyForm")[0].reset()
            }
        });
})
if (top.location.pathname === '/dashboard/vacancy') {
    $.ajax({
        type: "get",
        url: "http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/department",
        dataType: "json",
        headers: {
            'xc-auth': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Inl1c2lmLmV5bnVsbGFiZXlsaUBmZXJydW1jYXBpdGFsLmF6IiwiZmlyc3RuYW1lIjpudWxsLCJsYXN0bmFtZSI6bnVsbCwiaWQiOjEsInJvbGVzIjoidXNlciIsImlhdCI6MTY2MDkwOTkxMX0.HttDn-LRM3wErtkaamXwJVhEmMpm0JX2gizDjlg0MTM'
        },
        success: function (data) {
            data.forEach(item => {
                $('#department').append(`
                    <option value="${item.uniq_id}">${item.title}</option>
                `)
                $('#VacancyUpdate #department_id').append(`
                <option value="${item.uniq_id}">${item.title}</option>
                `)
            })
        }
    })
    VacancyTable.render(document.getElementById("VacanciesTable"));

}
$(document).on('click', '.updateVacancy', function () {
    let tmp__ = $(this).attr('data-uniq-id')
    $(`input[name="uniq_id"]`).val(tmp__);
    $.ajax({
        type: "post",
        url: "/dashboard/csapi/vacancy/find",
        data: {
            uniq_id: tmp__,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $("#EditVacancyModal").modal("show");
            parsing_ = (data)[0]
            Object.entries(parsing_).forEach(item => {
                if (item[0] === 'respons_punkt') {
                    JSON.parse(item[1]).forEach(each => {
                        $("#VacancyUpdate #responsibility_div").after(`
                        <div class='col-md-12'>
                            <label>Responsibility punk</label>
                            <input value="${each}" name='respons_punkt' class="respons_punkt form-control border border-light">
                        </div>
                        `)
                    })
                }
                else if (item[0] === 'description_punkt') {
                    JSON.parse(item[1]).forEach(each => {
                        $("#VacancyUpdate #description_div").after(`
                        <div class='col-md-12'>
                            <label>Description punkt</label>
                            <input value="${each}" name="description_punkt" class="description_punkt form-control border border-light">
                        </div>
                        `)
                    })
                }
                else if (item[0] === 'extra_info') {
                    Object.entries(JSON.parse(item[1])).forEach(each => {
                        $(`#VacancyUpdate #${each[0]}`).val(each[1])
                    })
                } else {
                    $(`#VacancyUpdate #${item[0]}`).val(item[1])
                }
            })
        }
    })

})
$(document).on('submit', '#VacancyUpdate', function (e) {
    e.preventDefault();
    let responsePunkt = [];
    let descriptionPunkt = []
    let tmp__data = $("#VacancyUpdate").serializeArray().reduce(function (obj, item) {
        item.name == 'respons_punkt' && responsePunkt.push(item.value)
        item.name == 'description_punkt' && descriptionPunkt.push(item.value)
        obj[item.name] = item.value;
        return obj;
    }, {});

    $.post(`/dashboard/csapi/vacancy/update`, {
        _token: $('meta[name="csrf-token"]').attr('content'),
        uniq_id: (tmp__data.uniq_id),
        description_punkt: JSON.stringify(descriptionPunkt),
        respons_punkt: JSON.stringify(responsePunkt),
        date_duration: tmp__data.date_duration,
        description: tmp__data.description,
        responsibility: tmp__data.responsibility,
        title: JSON.stringify(tmp__data.title),
        department_id: JSON.stringify(tmp__data.department_id),
        date_duration: tmp__data.date_duration,
        extra_info: JSON.stringify({ 'salary': tmp__data.salary, 'time': tmp__data.time, 'deadline': tmp__data.deadline, 'requirement': tmp__data.requirement }),
    }).done(function (data) {
        if (data) {
            VacancyTable.forceRender();
            Swal.fire('Yeniləndi', '', 'success');
            $("#EditVacancyModal").modal("hide");
        }
    })
})
$(document).on('click', '.deleteVacancyBTN', function () {
    Swal.fire({
        title: "Vakansiyanı silmək istədiyinizdən əminsinizmi?",
        showDenyButton: true,
        icon: 'info',
        confirmButtonText: 'Bəli',
        denyButtonText: `Xeyr`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/dashboard/csapi/vacancy/delete",
                data: {
                    id: $(this).attr("data-uniq-id"),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    VacancyTable.forceRender();
                    Swal.fire('Silindi', '', 'success');
                }
            })
        } else {
            Swal.fire('Silinmədi', '', 'info');
        }
    })
})
$(document).on('click', '.vacancyStatusBTN', function () {
    $("#vacancyStatusModal").modal("show")
    $(`#updateVacancyStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
    var vacancyNotSelected = $(`#updateVacancyStatusForm select option[value="${$(this).data("val")}"]`);
    if (vacancyNotSelected.length) {
        $(".vacancyNotSelected").remove();
        $(`#updateVacancyStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
    } else {
        $(`#updateVacancyStatusForm select`).prepend("<option selected class='vacancyNotSelected'>Seçim edilməyib</option>");
    }
})
$("#updateVacancyStatusForm select").change(function () {
    $.post(`/dashboard/csapi/vacancy/status/update/${$(`#updateVacancyStatusForm input[name="uniq_id"]`).val()}`, {
        status: $("#updateVacancyStatusForm").find(":selected").val(),
        _token: $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        if (data) {
            VacancyTable.forceRender();
            Swal.fire('Yeniləndi', '', 'success');
            $("#vacancyStatusModal").modal("hide");
        }
    })
});
