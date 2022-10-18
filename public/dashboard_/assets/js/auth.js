$("#LoginForm").submit(function (e) {
       e.preventDefault();
       $.ajax({
              url: "/dashboard/login",
              type: "post",
              data: $("#LoginForm").serialize(),
              dataType: 'json',
              success: function (data) {
                     window.location.replace("/dashboard/vacancy");
              },
              error: function (data) {
                     window.location.replace("/dashboard/main");
              }
       })
})
console.log('sd');