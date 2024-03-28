function deleteEvent(id) {
    if (confirm("Are you sure you want to delete this Event?")) {
        $.ajax({
            url: "/eventDelete/" + id,
            type: "GET",

            success: function (response) {
                // Reload the page to reflect the updated user list
                // location.reload();
            },
            error: function (xhr, status, error) {
                alert("Error deleting user: " + error);
            },
        });
    }
}
