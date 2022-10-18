function makeSideBar() {
       if (!localStorage.activeSideBar) {
           localStorage.setItem("activeSideBar", window.location.href);
           $(`.sidebar-layout a[href="${localStorage.activeSideBar}"]`).parent().addClass("active");
           console.log(localStorage.activeSideBar);
       }
       else {
           localStorage.setItem("activeSideBar", window.location.href);
           $(`.sidebar-layout a[href="${localStorage.activeSideBar}"]`).parent().addClass("active");
       }
   }
makeSideBar();

let tmp__ = $(location).attr('search').slice(3);
console.log(tmp__);
if (top.location.pathname === '/dashboard/print') {
       $.get(`/dashboard/csapi/scholar/get/${tmp__}`, function(data) {
              let citizen__='';
              if((data)[0]['is_az_citizen']==1){
                     citizen__='Bəli';
              } else {
                     citizen__='Xeyr';
              }
              $("#modelWindows").modal("show");
              $('.scholarModal').html('');
              $('.scholarName').append((data)[0]['fullname']);
              $('.scholarType').append((data)[0]['type']);
              $('.scholarEmail').append((data)[0]['email']);
              $('.scholarBirth').append((data)[0]['birthdate']);
              $('.scholarPhone').append((data)[0]['phone']);
              $('.scholarAddress').append((data)[0]['address']);
              $('.scholarCitizen').append(citizen__);
              $('.scholarSmedia').append((data)[0]['s_media']);
              $('.scholarUni').append((data)[0]['university']);
              $('.scholarScore').append((data)[0]['uni_entrance_poin']);
              $('.scholarPrfsn').append((data)[0]['profession']);
              $('.scholarGrade').append((data)[0]['grade']);
              $('.scholarGpa').append((data)[0]['gpa']);
       })
       $("#printArea").printThis({
              debug: false,               // show the iframe for debugging
              importCSS: true,            // import parent page css
              importStyle: false,         // import style tags
              printContainer: true,       // print outer container/$.selector
              loadCSS: [
                     "/dashboard_/assets/css/backende209.css",
                     "/dashboard_/assets/css/backend-plugin.min.css",
                     "/dashboard_/assets/css/gridjs.css"
              ],                // path to additional css file - use an array [] for multiple
              pageTitle: "Print document",// add title to print page
              removeInline: false,        // remove inline styles from print elements
              removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
              printDelay: 333,            // variable print delay
              header: null,               // prefix to html
              footer: null,               // postfix to html
              base: false,                // preserve the BASE tag or accept a string for the URL
              formValues: true,           // preserve input/form values
              canvas: false,              // copy canvas content
              doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
              removeScripts: false,       // remove script tags from print content
              copyTagClasses: false,      // copy classes from the html & body tag
              beforePrintEvent: null,     // callback function for printEvent in iframe
              beforePrint: null,          // function called before iframe is filled
              afterPrint: null            // function called before iframe is removed
       });
}

