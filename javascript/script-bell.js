//Mostrar as notificações

$(document).ready(function () {

    // click on notification bell
    $('.notification').click(function () {
        if (!$(document).find('.notification-dropdown').hasClass('dd')) {
            hide_dropdown()
        } else {
            $('.notification-dropdown').removeClass('dd').addClass('dropdown-transition')
        }
    })

    // handler to close dropdown on clicking outside of it
    $(document).on('click', function (e) {
        var target = $(e.target)
        if (!target.closest('.notification').length && !target.closest('.dropdown-transition').length) {
            if (!$(document).find('.notification-dropdown').hasClass('dd')) {
                hide_dropdown()
            }
        }
    })

    // function to close dropdown and setting notification count to 0
    function hide_dropdown() {
        $(document).find('.notification-dropdown').removeClass('dropdown-transition').addClass('dd')
        $(document).find('.notification-dropdown').find('.list-item').addClass('background-white')
    }
    document.documentElement.onclick = function (event) {
        if (event.target === document.documentElement) {
            document.documentElement.classList.remove("menu-ativo");
        }
    }
    $('input.checkgroup').click(function(){
        debugger
       if($(this).is(":checked")){
          $('input.checkgroup').attr('disabled',true);
          $(this).removeAttr('disabled');
       }else{
          $('input.checkgroup').removeAttr('disabled');
       }
    })

})
