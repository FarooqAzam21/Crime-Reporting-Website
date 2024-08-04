document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    handleFormSubmit('user_register.php', new FormData(this));
});

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    handleFormSubmit('user_login.php', new FormData(this));
});

document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    event.preventDefault();
    handleFormSubmit('user_feedback.php', new FormData(this));
});

document.getElementById('messageForm').addEventListener('submit', function(event) {
    event.preventDefault();
    handleFormSubmit('user_message.php', new FormData(this));
});

function handleFormSubmit(url, formData) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.success) {
                showModal('Action successful!');
            } else {
                showModal('Action failed: ' + response.message);
            }
        }
    };

    xhr.send(new URLSearchParams(formData).toString());
}

