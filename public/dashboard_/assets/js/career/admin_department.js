var ID = function () {
    // Math.random should be unique because of its seeding algorithm.
    // Convert it to base 36 (numbers + letters), and grab the first 9 characters
    // after the decimal.
    return '_' + Math.random().toString(36).substr(2, 9);
};

$(document).on('submit', '#departmentForm', function (e) {
    e.preventDefault();
    let url = "http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/department"
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
