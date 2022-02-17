<?php
require_once('head.php');
?>


<div class="container-fluid">
    <div class="row justify-content-md-center align-items-center" style="height: 100vh;">
        <div class="col-md-5 rounded text-center card">
        <h2 class="text-center">Login</h2>
            <form class="form m-4" action="">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Digite seu email">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Digite sua senha">
                    <label for="password">Senha</label>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <a href="signin.php">Não tem conta? Cadastre-se</a>
                </div>
            </form>

            <div class="d-flex justify-content-center mb-4">
                <button onclick="toLogin()" class="btn btn-success">Entrar</button>
            </div>
        </div>
    </div>
</div>

 <script type="text/javascript">
    console.log("teste")
    function toLogin() {
        const url = "http://127.0.0.1:3000/sessions";

        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                password: password,
                email: email,
            }),
        }).then(
            async (response) => {
                let contentType = response.headers.get("content-type");

                if (response.status === 200) {

                    json = await response.json();

                    window.sessionStorage.setItem("token", json.token);
                    window.sessionStorage.setItem("user", JSON.stringify(json.user));
                    
                    console.log(window.sessionStorage.getItem("token"));
                    console.log(window.sessionStorage.getItem("user"));

                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Login realizado com sucesso!',
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
                        text: 'Usuário não encontrado!',
                    });
                }
            }
        );
    }
</script>

<?php
require_once('foot.php');
?>