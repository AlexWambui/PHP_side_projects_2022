$(document).ready(function() {
    $('#data_table').DataTable();
} );

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function makeAnnouncement() {
    document.getElementById("announcements_form").style.display = "block";
}
function closeAnnouncement() {
    document.getElementById("announcements_form").style.display = "none";
}
