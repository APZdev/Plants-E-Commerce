const tableLinks = document.querySelectorAll(".user_body_item");

tableLinks.forEach((tableLink) => {
    tableLink.addEventListener("click", () => {
        window.location = window.location.origin + "/admin-dashboard/dashboard.php?page=user-panel&user_id=" + tableLink.dataset.id;
    });
});
