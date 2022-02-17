<?php
require_once('head.php');
require_once('header.php');
?>

<div class="container-fluid main">
    <div class="row justify-content-center">
        <form class="col-md-6 mt-5">
            <div class="mb-3">
                <label for="Nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <textarea class="form-control" id="message"></textarea>
            </div>
        </form>

        <button onclick="createMessage()" class="btn btn-primary">Submit</button>
    </div>
</div>

<script>
    function createMessage() {
        const url = "http://127.0.0.1:3000/message";

        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let message = document.getElementById('message').value;

        let token = window.sessionStorage.getItem("token");

        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                email: email,
                message: message
            }),
        }).then(
            (response) => {
                let contentType = response.headers.get("content-type");

                if (response.status === 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Mensagem enviada com sucesso!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace('index.php');
                        }
                    });

                    return;
                }

                if (contentType && contentType.indexOf("application/json") !== -1) {
                    return response.json().then(function(json) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Opss',
                            text: json.message,
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opss',
                        text: 'Falha ao enviar mensagem!',
                    });
                }
            }
        );
    }
</script>

<?php
require_once('foot.php');
?>