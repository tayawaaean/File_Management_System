const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
  const li = item.parentElement;

  item.addEventListener('click', function() {
    allSideMenu.forEach(i => {
      i.parentElement.classList.remove('active');
    });
    li.classList.add('active');
  });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
});

document.querySelector(".btn_addCandidates").addEventListener("click", function(){
  document.querySelector(".pop-up").classList.add("active");
});
document.querySelector(".pop-up .close-btn").addEventListener("click", function(){
  document.querySelector(".pop-up").classList.remove("active");
});

document.querySelector(".btn_addCandidates2").addEventListener("click", function(){
    document.querySelector(".pop-up").classList.add("active");
  });
  document.querySelector(".pop-up .close-btn").addEventListener("click", function(){
    document.querySelector(".pop-up").classList.remove("active");
  });

$(document).ready(function() {
  $('.update_cad').click(function() {
    var bookId = $(this).data('bookid');
    $.ajax({
      url: 'candidates_edit.php',
      type: 'post',
      data: {
        bookId: bookId,
        table: 'candidates'
      },
      success: function(data) {
        $('.pop-up-2 .form').html(data);
        $('.pop-up-2').addClass('active');
      }
    });
  });
   $('.update_vote').click(function() {
    var bookId = $(this).data('bookid');
    $.ajax({
      url: 'voters_edit.php',
      type: 'post',
      data: {
        bookId: bookId,
        table: 'votes'
      },
      success: function(data) {
        $('.pop-up-2 .form').html(data);
        $('.pop-up-2').addClass('active');
      }
    });
  });
  $('.update_pos').click(function() {
    var bookId = $(this).data('bookid');
    $.ajax({
      url: 'position_edit.php',
      type: 'post',
      data: {
        bookId: bookId,
        table: 'positions'
      },
      success: function(data) {
        $('.pop-up-2 .form').html(data);
        $('.pop-up-2').addClass('active');
      }
    });
  });
  $('.close-btn').click(function() {
  $('.pop-up-2').removeClass('active');
  });
});