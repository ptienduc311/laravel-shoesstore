$(document).ready(function () {

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-link').each(function() {
        if ($(this).hasClass('active')) {
            $(this).find('.arrow').removeClass('fa-angle-down').addClass('fa-angle-down');
        }
    });
    $('.nav-link.active .sub-menu').slideDown();
    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-down');
    });

//   UPLOAD ẢNH AJAX
$("#upload_info").on('submit', function() {
    // var data = new FormData(this);
    var inputFile = $('#file');
        var fileToUpload = inputFile[0].files;

        if (fileToUpload.length > 0) {
            var formData = new FormData();
            // Chỉ thêm một file vào formData
            formData.append('file', fileToUpload[0], fileToUpload[0].name);

            $.ajax({
                url: '?mod=post&action=process',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'text',
                success: function(data) {
                    $("#result").html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }

        return false;
});
});
