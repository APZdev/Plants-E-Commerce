//Thread card on click redirection
const commandItems = document.querySelectorAll(".command_item");
commandItems.forEach((commandItem) => {
    commandItem.addEventListener("click", (event) => {
        const commandId = commandItem.dataset.id;
        window.location.href = `/admin-dashboard/dashboard.php?page=command-panel&command_id=${commandId}`;
    });
});