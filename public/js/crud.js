// this is toast success
// const Toast = Swal.mixin({
//     toast: true,
//     position: "top-end",
//     showConfirmButton: false,
//     timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//         toast.onmouseenter = Swal.stopTimer;
//         toast.onmouseleave = Swal.resumeTimer;
//     },
// });
// Toast.fire({
//     icon: "success",
//     title: "Signed in successfully",
// });

function store(csrf_token, title, content, form_id, model_id) {
    // i need to add new post
    $(`.${form_id}`).on("submit", function (e) {
        e.preventDefault();

        title = $(this).find(`input[name=${title}]`).val();
        content = $(this).find(`textarea[name="${content}"]`).val();

        $.ajax({
            url: "/post",
            method: "post",
            data: {
                title: title,
                content: content,
                _token: csrf_token,
            },
            success: function (response) {
                // You can use SweetAlert or any other library here
                console.log(response); // This will log the response data
                // Optionally, handle UI updates here
                $(`.${form_id}`)[0].reset();
                var modal = bootstrap.Modal.getInstance(
                    document.getElementById(model_id)
                );
                Swal.fire({
                    title: "Drag me!",
                    icon: "success",
                    draggable: true,
                });
                modal.hide();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                $(`.${form_id}`)[0].reset();
            },
        });
    });
}
function update() {}

function deletePost(csrf_token) {
    $(".delete-btn").on("click", function () {
        if (!confirm("Are you sure you want to delete this post?")) return;

        let post_id = $(this).data("id");

        $.ajax({
            url: "/post/" + post_id,
            type: "DELETE",
            data: {
                _token: csrf_token,
            },
            success: function (response) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                        });
                    }
                });
                $(".row_" + post_id).remove();
            },
            error: function () {
                console.log("Error when deleting post");
            },
        });
    });
}
function feache() {}

// function store(url, data) {
//     // Make a request for a user with a given ID
//     axios.post(url, data)
//         .then(function (response) {
//             // handle success 2xx
//             console.log(response);
//             toastr.success(response.data.message);
//             document.getElementById('create-form').reset();
//         })
//         .catch(function (error) {
//             // handle error 4xx - 5xx
//             console.log(error);
//             // showMessage(error.response.data);
//             toastr.error(error.response.data.message)
//         });
// }

function register(url, guard, data) {
    axios.post(url, data)
        .then(response => {
            alert(response.data.message);
            window.location.href = response.data.redirect;
        })
        .catch(error => {
            if (error.response) {
                alert(error.response.data.message);
            } else {
                alert("something is worning");
            }
        });
}

function login(url, guard, data) {
    console.log("Guard value:", guard);

    // Make a request for a user with a given ID
    axios.post(url, data)
        .then(function (response) {
            // handle success 2xx
            console.log(response);
            // toastr.success(response.data.message);
            window.location.href = `/dashboard/${guard}/home`;
        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            // showMessage(error.response.data);
            toastr.error(error.response.data.message);
        });
}
