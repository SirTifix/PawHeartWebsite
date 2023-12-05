function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("content").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("content").style.marginLeft= "0";
}

function toggleForm() {
    var form = document.getElementById("addAppointmentForm");
    form.style.display = form.style.display === "none" ? "block" : "none";
}