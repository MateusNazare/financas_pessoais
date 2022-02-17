<?php
require_once('head.php');
?>


<div class="container-fluid">
    <div class="row justify-content-md-center align-items-center" style="height: 100vh;">
        <div class="col-md-5 rounded text-center card">
            <h2 class="text-center">Cadastrar</h2>
            <form id="inputform" class="form m-4">

            </form>

            <div id="btn-submit" class="d-flex justify-content-center mb-4">
                
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        document.getElementById('inputform').innerHTML = `
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder="Digite seu nome">
                    <label for="name">Nome completo</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Digite sua senha">
                    <label for="password">Senha</label>
                </div>
            `;

        document.getElementById('btn-submit').innerHTML = `<button onclick="updateUser()" class="btn btn-success">Atualizar</button>`;

        const url = "http://127.0.0.1:3000/users";

        let token = window.sessionStorage.getItem("token");

        if (token) {
            fetch(url, {
                method: "GET",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            }).then(
                (response) => {
                    if (response.status === 200) {
                        response.json().then((json) => {
                            console.log(json)

                            document.getElementById('name').value = json.name;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Opss',
                            text: 'Não foi possível obter os dados!',
                        });
                    }
                }
            );
        } else {
            document.getElementById('btn-submit').innerHTML = `<button onclick="createUser()" class="btn btn-success">Cadastrar</button>`;
            document.getElementById('inputform').innerHTML = `
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
            `;
        }
    });

    function createUser() {
        const url = "http://127.0.0.1:3000/users";

        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                email: email,
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
                        window.location.replace('login.php');
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

    function updateUser() {
        const url = "http://127.0.0.1:3000/users";

        let name = document.getElementById('name').value;
        let password = document.getElementById('password').value;

        let token = window.sessionStorage.getItem("token");

        fetch(url, {
            method: "PUT",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            body: JSON.stringify({
                name: name,
                password: password,
            }),
        }).then(
            (response) => {
                let contentType = response.headers.get("content-type");

                if (response.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Usuário atualizado com sucesso!',
                    }).then((result) => {
                        window.location.replace('index.php');
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
                        text: 'Usuário não atualizado!',
                    });
                }
            }
        );
    }
</script>

<?php
require_once('footer.php');
?>