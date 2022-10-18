$(".addNewUserBTN").on('click', function () {

})
$(document).on('click', '.addNewUserBTN', function () {
       console.log('ere');
       $("#NewUserModal").modal('show')
})

$("#UserForm").submit(function (e) {
       e.preventDefault()
       console.log('sadad');
       $.ajax({
              url: "/dashboard/csapi/create/user",
              type: "post",
              dataType: "json",
              data: $("#UserForm").serialize(),
              beforeSend: function () {
                     $(document).find('span.alert-danger').remove();
              },
              success: function (data) {
                     Swal.fire('Əlavə olundu', '', 'success');
                     $("#UserForm")[0].reset();
              },
              error: function (response) {
                     $.each(response.responseJSON.errors, function (field_name, error) {
                            $(document).find('[name=' + field_name + ']').parent().after('<span class="mt-2 text-strong alert alert-danger">' + error + '</span>')
                     })
              }
       })
})
$("#LogOut").submit(function (e) {
       e.preventDefault();
       $.ajax({
              url: "/dashboard/logout",
              type: "post",
              data: $("#LogOut").serialize(),
              success: function (data) {
                     window.location.replace("/dashboard/main");
              }
       })
})

let GetUser = new gridjs.Grid({
       columns: [
              { name: "Username", id: "username" },
              { name: "Email", id: "email" },
              { name: "Rol", id: "role" },
              { name: "---" }
       ],
       pagination: {
              limit: 10
       },
       sort: true,
       server: {
              url: "/dashboard/csapi/user/list",
              then: data => data.map(card => [
                     card.username,
                     card.email,
                     gridjs.html(`<button class="btn btn-sm btn-warning roleBTNforUser" data-uniq-id="${card.uniq_id}">${card.role_id}</button>`),
                     gridjs.html(`
                            <div class='d-flex'>
                                   <button class="btn btn-sm  delete-user mr-1" data-uniq-id="${card.uniq_id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="22" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#DA1B24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                   </button>
                            </div>
                           `)
              ]),
       }
})
if (top.location.pathname === '/dashboard/userPage') {
       GetUser.render(document.getElementById("grid"));
}
$(document).on("click",".roleBTNforUser",function(e){
       e.preventDefault();
       $("#UserRoleModal").modal('show')
       $("#UserRoleUpdate button").attr('data-uniq-id',$(this).attr('data-uniq-id'))
       // $.ajax({
       //        type: "post",
       //        url: "/dashboard/csapi/user/update/role",
       //        data: {
       //               uniq_id: $(this).attr("data-uniq-id"),
       //               _token: $('meta[name="csrf-token"]').attr('content')
       //        },
       //        success: function () {
       //               GetUser.forceRender();
       //               Swal.fire('Silindi', '', 'success');
       //        }
       // })
})
$(document).on('submit','#UserRoleUpdate',function(e){
       e.preventDefault();
       let Uniq_id = $("#UserRoleUpdate button").attr('data-uniq-id')
       let UserRole = $("#UserRoleUpdate  select[name='role']").val()
       $.ajax({
              type: "post",
              url: "/dashboard/csapi/user/update/role",
              data: {
                     uniq_id:Uniq_id,
                     role:UserRole,
                     _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function () {
                     GetUser.forceRender();
                     Swal.fire('Yeniləndi', '', 'success');
              }
       })
})
$(document).on('click', '.delete-user', function (e) {
       e.preventDefault();
       Swal.fire({
              title: "İstifadəçini silmək istədiyinizdən əminsinizmi?",
              showDenyButton: true,
              icon: 'info',
              confirmButtonText: 'Bəli',
              denyButtonText: `Xeyr`,
       }).then((result) => {
              if (result.isConfirmed) {
                     $.ajax({
                            type: "post",
                            url: "/dashboard/csapi/user/delete",
                            data: {
                                   uniq_id: $(this).attr("data-uniq-id"),
                                   _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                   GetUser.forceRender();
                                   Swal.fire('Silindi', '', 'success');
                            }
                     })
              } else {
                     Swal.fire('Silinmədi', '', 'info');
              }
       }
       )
})
