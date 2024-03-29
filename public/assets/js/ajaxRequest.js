function deleteEvent(id) {
    if (confirm("Are you sure you want to delete this Event?")) {
        $.ajax({
            url: "/eventDelete/" + id,
            type: "GET",

            success: function (response) {},
            error: function (xhr, status, error) {
                alert("Error deleting Event: " + error);
            },
        });
    }
}

function addtoCart(id) {
    // if (confirm("Are you sure you want to Add this Ticket to Cart?")) {
    $.ajax({
        url: "/addtoCart/" + id,
        type: "GET",

        success: function (response) {},
        error: function (xhr, status, error) {
            alert("Error in Add to Cart Ticket: " + error);
        },
    });
    // }
}

function deleteCartItem(id) {
    if (confirm("Are you sure you want to Delete this Item from cart")) {
        $.ajax({
            url: "/deleteFromCart/" + id,
            type: "GET",

            success: function (response) {},
            error: function (xhr, status, error) {
                alert("Error Deleting the item :" + error);
            },
        });
    }
}
// Session Alert Animation
$(document).ready(function () {
    // Hide the alert after 5 seconds (5000 milliseconds)
    setTimeout(function () {
        $("#alert").fadeOut("slow");
    }, 3000);
});
