let GetApplications = new gridjs.Grid({
    columns: [
        { name: "Adı Soyadı", id: "fullname" },
        { name: "Nömrə", id: "phone" },
        { name: "Email", id: "email" },
        { name: 'Status', id: "status" },
        { name: "Əməliyyat" }
    ],
    sort: true,
    pagination: {
        limit: 10
    },
    server: {
        url: "/dashboard/csapi/career/applications/get",
        then: data => data.map(card => [
            gridjs.html(`${card.name}`),
            card.phone,
            card.email,
            gridjs.html(statusBtnApplication(card.status, card.uniq_id, "cApplyStatusBTN")),
            gridjs.html(`
                     <div class='d-flex'>
                            <button class="btn btn-sm detail-applications" data-uniq-id="${card.uniq_id}">
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
function statusBtnApplication(data, uniq_id, className) {
    if (data === 'Gözləmədə') {
        return `<button class="btn btn-sm btn-suc ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Gözləmədə</button>`
    }
    else if (data === "Yönləndirildi") {
        return `<button class="btn btn-sm btn-warning ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Yönləndirildi</button>`
    }
    else if (data === "Ləğv edildi") {
        return `<button class="btn btn-sm btn-dg ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Ləğv edildi</button>`
    }
    else {
        return `<button class="btn btn-sm btn-dk ${className}" data-val="${data}" data-uniq-id="${uniq_id}">Seçim edilməyib</button>`
    }
}
if (top.location.pathname === '/dashboard/applications') {
    GetApplications.render(document.getElementById("applications"));
}

/*sdsdsd*/
$(document).on('click', '.cApplyStatusBTN', function () {
    $("#ApplyStatusModal").modal("show")
    $(`#updateApplyStatusForm input[name="uniq_id"]`).val($(this).data("uniq-id"));
    var ApplyNotSelected = $(`#updateApplyStatusForm select option[value="${$(this).data("val")}"]`);
    if (ApplyNotSelected.length) {
        $(".ApplyNotSelected").remove();
        $(`#updateApplyStatusForm option[value="${$(this).data("val")}"]`).prop('selected', true);
    }
})
$("#updateApplyStatusForm select").change(function () {
    $.post(`/dashboard/csapi/application/status/update/${$(`#updateApplyStatusForm input[name="uniq_id"]`).val()}`, {
        status: $("#updateApplyStatusForm").find(":selected").val(),
        _token: $('meta[name="csrf-token"]').attr('content')
    },
        function (data) {
            console.log(data)
            if (data) {
                GetApplications.forceRender();
                Swal.fire('Yeniləndi', '', 'success');
                $("#ApplyStatusModal").modal("hide");
            }
        })
});
function callEducation(each) {
    return `
                    <div class="col-lg-5">
                            <div>
                                <p>Dərəcə: <span>${each.degree}</span></p>

                            </div>
                            <div>
                                <p>${each.university ? "Universitet" : "Məktəb" }: <span>${each.university ? each.university : each.school}</span></p>

                            </div>
                            <div>
                                <p>Giriş balı: <span>${each.score}</span></p>

                            </div>
                            <div>
                                <p>Ixtisas: <span>${each.speciality}</span></p>

                            </div>
                            <div>
                                <p>Giriş ili: <span>${each.entrance}</span></p>

                            </div>
                             <div>
                                <p>Bitirmə ili: <span>${each.graduation}</span></p>

                            </div>
                      </div>
                    `
}
function callExperience(each) {
    return `
                    <div class="col-lg-5">
                            <div>
                                <p>Şirkət: <span>${each.company}</span></p>

                            </div>
                            <div>
                                <p>Şöbə: <span>${each.speciality}</span></p>

                            </div>
                            <div>
                                <p>Vəzifə öhdəlikləri: <span>${each.responsibilities}</span></p>

                            </div>
                            <div>
                                <p>Başlama tarixi: <span>${each.startDate}</span></p>

                            </div>
                            <div>
                                <p>Hal hazırda işləyir: <span>${each.currentlyWorking == true ? "Bəli" : "Xeyr"}</span></p>
                            </div>
                            ${each.currentlyWorking !== true ? "" +
            "<div>" +
            `<p>Bitmə tarixi: <span>${each.endDate}</span></p>` +
            "</div>" +
            "<div>" +
            `<p>Çıxma səbəbi: <span>${each.reasonOfLeave}</span></p>` +
            "</div>" : ""}
                      </div>
                    `
}
function callLanguage(each) {
    return `
                    <div class="col-lg-15">
                        <div>
                                <p>Dil: <span>${each.language}</span></p>

                        </div>
                         <div>
                                <p>Səviyyə: <span>${each.level}</span></p>
                        </div>
                        <div>
                            <h5>Kompyuter bilikləri</h4>
                            <p>${each.additional_skills}</p>
                        </div>
                    </div>
                    `
}
function callSertificate(each) {
    return `
                        <div class="col-lg-5">
                         <div>
                                <p>Sertifikat: <span>${each.certificate}</span></p>

                        </div>
                         <div>
                                <p>Tarix: <span>${each.date}</span></p>

                        </div>
                        </div>
                    `
}
$(document).on('click', '.detail-applications', function (e) {
    var tmp__scholar = $(this).attr('data-uniq-id')
    $.get(`/dashboard/csapi/application/find/${tmp__scholar}`, function (data) {
        $(".fieldList").html('')
        Object.entries(data[0]).forEach(item => {
            if (item[0] === 'url') {
                item[1][0]['linkedin'] != "" ? $(`#applicationUniq #linkedin`).html(`<a target="_blank" href="${item[1][0]['linkedin']}">Linkedin</a>`) : $("#applicationUniq #linkedinDiv").html('')
                item[1][0]['portfolio']!='' ? $(`#applicationUniq #portfolio`).html(`<a target="_blank" href="${item[1][0]['portfolio']}">Portfolio</a>`) : $("#applicationUniq #portfolioDiv").html('')
                item[1][0]['telegram']!='' ? $(`#applicationUniq #telegram`).html(`<p>Telegram:<span class="font-weight-bold"> ${item[1][0]['telegram']}</span></p>`) : $("#applicationUniq #telegramDiv").html('')
            }
            else if (item[0] === 'education') {
                item[1].forEach(each => {
                    $("#applicationUniq #educationField").append(callEducation(each))
                })
            }
            else if (item[0] === 'experience') {
                item[1].length > 0 ? item[1].forEach(each => {
                    $("#applicationUniq #workField").append(callExperience(each))
                }) : $("#applicationUniq #workDiv").remove()
            } else if (item[0] === 'skills') {
                item[1].length > 0 ? item[1].forEach(each => {
                    $("#applicationUniq #languageField").append(callLanguage(each))
                }) : $("#applicationUniq #languageDiv").remove()
            } else if (item[0] === "certificates") {
                item[1].length > 0 ? item[1].forEach(each => {
                    $("#applicationUniq #sertificateField").append(callSertificate(each))
                }): $("#applicationUniq #sertificateDiv").remove()
            } else if (item[0] === 'cv') {
                $(`#applicationUniq #${item[0]}`).append(`<a href="${item[1]}" target="_blank">${item[1]}</a>`)
            }
            else {
                $(`#applicationUniq #${item[0]}`).html(item[1])
            }

        })
    })
    $("#applicationUniq").modal('show')
})
