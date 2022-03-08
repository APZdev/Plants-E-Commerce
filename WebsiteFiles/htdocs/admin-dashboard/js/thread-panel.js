//Delete comment of a thread on click
const deleteCommentButtons = document.querySelectorAll(".delete_comment_button");
deleteCommentButtons.forEach((deleteButton) => {
    deleteButton.addEventListener("click", (event) => {
        const commentId = deleteButton.dataset.id;

        let formData = new FormData();
        formData.append("remove_comment", "1");
        formData.append("comment_id", commentId);

        fetch("/admin-dashboard/post/thread-post.php", {
                method: "POST",
                body: formData,
            })
            .then(function(response) {
                setTimeout(function() {
                    location.reload();
                }, 200);
            });
    });
});

const deleteThreadButtons = document.querySelectorAll(".thread_delete_button");
deleteThreadButtons.forEach((deleteButton) => {
    deleteButton.addEventListener("click", (event) => {
        const threadId = deleteButton.dataset.id;

        let formData = new FormData();
        formData.append("remove_thread", "1");
        formData.append("thread_id", threadId);

        fetch("/admin-dashboard/post/thread-post.php", {
                method: "POST",
                body: formData,
            })
            .then(function(response) {
                return response.text();
            })
            .then(function(body) {
                console.log(body);
            });
    });
});