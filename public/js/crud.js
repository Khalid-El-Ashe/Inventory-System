function store(url, data) {
    // Make a request for a user with a given ID
    axios.post(url, data)
        .then(function (response) {
            // handle success 2xx
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            // showMessage(error.response.data);
            toastr.error(error.response.data.message)
        });
}

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
                alert("حدث خطأ غير متوقع");
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
