<?php
require_once('head.php');
?>


<div class="container-fluid">
    <div class="row justify-content-md-center align-items-center" style="height: 100vh;">
        <div class="col-md-5 rounded text-center card">
            <h2 class="text-center">Cadastrar</h2>
            <form id="inputform" class="form m-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder="Digite seu nome">
                    <label for="name">Nome completo</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Digite seu email">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Digite sua senha">
                    <label for="password">Senha</label>
                </div>
            </form>

            <div class="d-flex justify-content-center mb-4">
                <button onclick="createUser()" class="btn btn-success">Cadastrar</button>
            </div>

        </div>
    </div>
</div>

<script>
    
    function createUser() {
        const url = "http://127.0.0.1:3000/users";

        let name = document.getElementById('name').value;
        let ra = document.getElementById('ra').value;
        let phone = document.getElementById('phone').value;
        let password = document.getElementById('password').value;

        console.log(name, ra, phone, password);

        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                ra: parseInt(ra),
                phone: phone,
                password: password,
            }),
        }).then(
            (response) => {
                let contentType = response.headers.get("content-type");

                if (response.status === 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Usuário adastrado com sucesso!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace('login.php');
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
                        text: 'Usuário não cadastrado!',
                    });
                }
            }
        );
    }
</script>

<?php
require_once('footer.php');
?>