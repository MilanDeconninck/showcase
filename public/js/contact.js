document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);

    if(urlParams.get("success") === "1") {
        Swal.fire({
            title: "Verzonden!",
            text: "Bedankt voor je bericht, ik neem snel contact met je op.",
            icon: "success",
            confirmButtonColor: "#2C3E50"
        }).then(() => {
            window.history.replaceState({}, document.title, window.location.pathname);
        });
    }
});