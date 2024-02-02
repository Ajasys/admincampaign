
$('body').on('click', '#investor-people .modal-close-btn', function (e) {
  $("#peoModel .modal-close-btn").trigger("click");
});


// script-1
// var clickevent = document.querySelectorAll('[data-clickable]')
// clickevent.forEach(function(row){row.addEventListener("click", function () { document.querySelector(".model-box").style.display = "flex" })}); 
// var clickevent2 = document.querySelectorAll('[data-edit-btn]')
// clickevent2.forEach(function(row){row.addEventListener("click", function () { document.querySelector(".model-box2").style.display = "flex" })}); 


// document.getElementById("close").addEventListener("click", function () { document.querySelector(".model-box").style.display = "none" }); 
// // document.getElementById("edit-btn").addEventListener("click", function () { document.querySelector(".model-box2").style.display = "flex" }); 
// document.getElementById("close2").addEventListener("click", function () { document.querySelector(".model-box2").style.display = "none" }); 
// document.getElementById("call-btn").addEventListener("click", function () { document.querySelector(".model-box3").style.display = "flex" }); 
// document.getElementById("close3").addEventListener("click", function () { document.querySelector(".model-box3").style.display = "none" }); 
// document.getElementById("log-btn").addEventListener("click", function () { document.querySelector(".model-box4").style.display = "flex" }); 
// document.getElementById("close4").addEventListener("click", function () { document.querySelector(".model-box4").style.display = "none" }); 
// document.getElementById("delete-btn").addEventListener("click", function () { document.querySelector(".model-box6").style.display = "flex" }); 
// document.getElementById("close6").addEventListener("click", function () { document.querySelector(".model-box7").style.display = "flex" }); 
// document.getElementById("close7").addEventListener("click", function () { document.querySelector(".model-box7").style.display = "none" }); 
// document.getElementById("close6-1").addEventListener("click", function () { document.querySelector(".model-box6").style.display = "none" }); 
// document.getElementById("edit-btn").addEventListener("click", function () { document.querySelector(".model-box").style.display = "none" }); 
// document.getElementById("call-btn").addEventListener("click", function () { document.querySelector(".model-box").style.display = "none" }); 
// document.getElementById("log-btn").addEventListener("click", function () { document.querySelector(".model-box").style.display = "none" }); 
// document.getElementById("delete-btn").addEventListener("click", function () { document.querySelector(".model-box").style.display = "none" });


// script-1
// script-2
$(document).ready(function () {
  setTimeout(function () {

    $(".loader").fadeOut(500);
  }, 1000)
});

// $('[data-submenu]').submenupicker();
// $(".nav-links .drop").click(function () {
//   $(this ).toggleClass("showMenu");

// });
// $(".nav-links .drop2").click(function () {
//   $(this).toggleClass("showMenu2");

// });
// // $(".nav-links .drop").click(function () {

// //   $(".peta-menu").toggle();
// // });
// $(".peta-menu").hide();
// $(".nav-links > .drop2").click(function () {

//   // $(this).toggleClass("showMenu2");
//   $(this).find(".peta-menu").slideToggle();
// });
// // $(".nav-links .drop2").click(function () {

// //   // $(this).toggleClass("showMenu2");
// //   $(".peta-menu").show();
// // });

// $(".drop2").click(function(){

//   $(this).next(".peta-menu").slideToggle();
// })



// $(document).ready(function() {

//   // Toggle Sub Nav
//   $("#nav li:has(ul)").children("ul").hide(); // hide the li UL
//   $("#nav li:has(ul)").find("a").click(function() {
//     //   alert();
//     // Add .show-subnav class to revele on click
//     $(this).closest("ul").find("ul:first").toggleClass("show-subnav");
//     // how to hide previously clicked submenus?
//   });

// });


// $("#nav li:has(ul)").children("ul").hide(); // hide the li UL
//   $("#nav li:has(ul)").find(".iocn-link").click(function() {
//     // Add .show-subnav class to revele on click
//     $(this).closest("li").find("ul:first").toggleClass("show-subnav sub-menus");
//     // how to hide previously clicked submenus?
//   });

// $(".peta-menus").click(function () {
//   $(this).toggleClass("showMenu2");
// });


// var menuItems = document.querySelectorAll('[data-submenu]');
// menuItems.forEach(function (menuItem) {
//   menuItem.addEventListener('click', function () {
//     // Get the ID of the sub menu from the custom attribute
//     var subMenuId = this.dataset.submenu;

//     // Get the sub menu element by its ID
//     var subMenu = document.getElementById(subMenuId);

//     // Toggle the sub menu's display property
//     if (subMenu.style.display === 'none') {
//       subMenu.style.display = 'block';
//     } else {
//       subMenu.style.display = 'none';
//     }
//   });
// });


let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("sidebarclose");
});


$(sidebarBtn).click(function () {
  $("body").toggleClass("verticalmenu");
});


$(document).ready(function () {

  $('.add-panel').hide();
  $('.add-panel-plus').click(function () {
    $('.add-panel').slideToggle();
  })

})
$(".ton_btn .bell-icon").click(function(e) {
  e.stopPropagation();
  $(".model-bell").toggleClass('d-none');
});
$("body").click(function(e) {
  if ($(e.target).closest('.model-bell').length == 0)
    $(".model-bell").addClass('d-none');
})

$('body').on('click', '#viewmodal .btn-close', function (e) {
  $("#callmodal .modal-close-btn").trigger("click");
});
// script-2

// script-3

$(document).ready(function () {
  $('#editbutton .moreless-button').click(function () {
    $('.moretext').slideToggle();
    if ($(this).text() == "More Details") {
      $(this).text("Less Details")
    } else {
      $(this).text("More Details")
    }
  });
  $('#addbutton .moreless-button').click(function () {
    $('.moretext').slideToggle();
    if ($(this).text() == "More Details") {
      $(this).text("Less Details")
    } else {
      $(this).text("More Details")
    }
  });
  $('#project_view .moreless-button').click(function () {
    $('.moretext').slideToggle();
    if ($(this).text() == "More Details") {
      $(this).text("Less Details")
    } else {
      $(this).text("More Details")
    }
  });
  $('#updatebutton .moreless-button').click(function () {
    $('.moretext').slideToggle();
    if ($(this).text() == "More Details") {
      $(this).text("Less Details")
    } else {
      $(this).text("More Details")
    }
  });
  $(document).on('click', '.delete', function () {
    $(this).parent('a').addClass('open');
    setTimeout(function () {
      $(".really").parent('a').removeClass('open');
    }, 3000);
  });

});
$('body').on('click', '#editbutton .btn-closing , #editbutton .modal-close-btn', function (e) {
  $("#staticBackdrop .modal-close-btn").trigger("click");
});


$('body').on('click', '#property-type .modal-close-btn', function (e) {
  $("#property-view .modal-close-btn").trigger("click");
});

$('.conversion-docs-btn').click(function () {
  $('.conversion-docs-form').slideToggle();
  if ($(this).text() == 'Add Docs') {
    $(this).text('Less Docs')
  } else {
    $(this).text('Add Docs')
  }
});
// script-3




$(document).ready(function () {
  function checkIfAnyCheckboxChecked(inputid,deletebtn) {
    if($(inputid+':checked').length > 0){
        // alert();
        deletebtn.show();
    } else {
        // alert();
        deletebtn.hide();
    }
}


  var selectAllItems = "#select-all";
  var checkboxItem = ".checkbox";

  $(selectAllItems).click(function () {

    if (this.checked) {
      $(checkboxItem).each(function () {
        this.checked = true;
      });
    } else {
      $(checkboxItem).each(function () {
        this.checked = false;
      });
    }

  });
});

