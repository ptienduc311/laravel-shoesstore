
// Hiển thị popup và lớp phủ
document.querySelector("#show-login").addEventListener("click", function () {
    document.querySelector(".popup").classList.add("active");
    document.querySelector("#overlay").style.display = "block";
});


// Ẩn popup và lớp phủ
document.querySelector(".popup .close-btn").addEventListener("click", function () {
    document.querySelector(".popup").classList.remove("active");
    document.querySelector("#overlay").style.display = "none";
});