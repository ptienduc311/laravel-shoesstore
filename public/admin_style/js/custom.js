document.addEventListener('DOMContentLoaded', function() {
    // Ẩn thông báo
    setTimeout(function() {
        let alerts = document.getElementsByClassName('alert-success');
        for (let i = 0; i < alerts.length; i++) {
            alerts[i].style.display = 'none';
        }
    }, 3000);

    // Checkbox All User
    const checkAll = document.querySelector('input[name="checkall"]');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:not([name="checkall"])');
    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = checkAll.checked;
            });
        });
    }
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (!checkbox.checked) {
                checkAll.checked = false;
            } else if (Array.from(checkboxes).every(cb => cb.checked)) {
                checkAll.checked = true;
            }
        });
    });

    //Load trang khi tìm kiếm
    const keywordInput = document.getElementById('keywordInput');
    const resetBtn = document.getElementById('resetBtn');
    const urlLoadElement = document.getElementById('urlLoad');

    if (keywordInput && resetBtn && urlLoadElement) {
        if (keywordInput.value.trim() !== "") {
            resetBtn.classList.add('show');
        }

        resetBtn.addEventListener('click', function() {
            window.location.href = urlLoadElement.value;
        });
    }
});
$(document).ready(function() {
    $('.check-all').click(function() {
        var moduleName = $(this).attr('id');
        var isChecked = $(this).is(':checked');
        $('.' + moduleName).prop('checked', isChecked);
    });
});