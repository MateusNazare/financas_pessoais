<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo.png" alt="" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="nav me-auto mb-2 mx-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contato</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" id = "search" type="search" placeholder="Search" aria-label="Search">
                    <button onclick = "buscarPorId()" class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <a class="btn btn-outline-primary mx-2" href="login.php">Entrar</a>
            </div>
        </div>
    </nav>
</header>

<script>
    function addTransaction() {
        const url = "http://127.0.0.1:3000/transactions";

        let id = document.getElementById('search').value;

        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            body: JSON.stringify({
                id: parseInt(id)
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
                        text: 'Inserido com sucesso!',
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
                        text: 'Falha ao inserir!',
                    });
                }
            }
        );
    }
</script>