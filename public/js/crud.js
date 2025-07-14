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

function register(url, guard, data) {
    console.log("Guard value:", guard);
    axios
        .post(url, data)
        .then((response) => {
            alert(response.data.message);
            window.location.href = response.data.redirect;
        })
        .catch((error) => {
            if (error.response) {
                alert(error.response.data.message);
            } else {
                // alert("something is worning");
                toastr.error(error.response.data.message);
            }
        });
}

function login(url, guard, data) {
    // console.log("Guard value:", guard);

    // Make a request for a user with a given ID
    axios
        .post(url, data)
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

// this function is used to confirm login and ask the user if they want to remember their login
// it will be used in the login page
// it will show a SweetAlert confirmation dialog
function confirmLogin(url, guard, data) {
    Swal.fire({
        title: "هل تريد تذكر تسجيل الدخول؟",
        text: "سيتم تذكرك تلقائيًا في هذا الجهاز.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "نعم، تذكرني",
        cancelButtonText: "لا، دخول مؤقت",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            data.remember = true;
            login(url, guard, data);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            data.remember = false;
            login(url, guard, data);
        }
    });
}

// this function is used to send a password request and change the password
// it will be used in the change password and reset password
function sendPasswordRequest(url, guard, data) {
    console.log("Guard value:", guard);
    axios
        .post(url, data)
        .then((response) => {
            alert(response.data.message);
            if (response.data.redirect) {
                window.location.href = response.data.redirect;
            }
        })
        .catch((error) => {
            if (
                error.response &&
                error.response.data &&
                error.response.data.message
            ) {
                alert(error.response.data.message);
            } else {
                alert("something is worning");
                toastr.error(error.response.data.message);
            }
        });
}

function store(url, data) {
    // Make a request for a user with a given ID
    axios
        .post(url, data)
        .then(function (response) {
            // handle success 2xx
            console.log(response);
            // toastr.success(response.data.message);
            showMessage(response.data);
            document.getElementById("create-form").reset();
        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            showMessage(error.response.data);
            // toastr.error(error.response.data.message);
        });
}

function update() {}

function deleteDrop(url, id, reference) {
    // Make a request for a user with a given ID
    axios
        .delete(url + id)
        .then(function (response) {
            // handle success 2xx
            showMessage(response.data);
            reference.closest("tr").remove();
        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            showMessage(error.response.data);
        })
        .finally(function () {
            // always executed
        });
}

function showMessage(data) {
    // i need to get the data from json
    Swal.fire({
        // position: "top-end",
        icon: data.icon,
        title: data.title,
        text: data.text,
        timer: 1500,
    });
}
