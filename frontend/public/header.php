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
                    <input class="form-control me-2" id="search" type="search" placeholder="Search" aria-label="Search">
                    <button onclick="buscarPorId()" class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <span id="log"></span>
            </div>
        </div>
    </nav>
</header>

<script type="text/javascript">
    $('.nav-link').on('click', function() {
        $(this).addClass('active').siblings('li').removeClass('active');
    });


    let token = window.sessionStorage.getItem("token");
    let user = window.sessionStorage.getItem("user");

    if (token) {
        var login = document.getElementById("log").innerHTML = `
            <div class="d-flex mx-2">
                <a href="signin.php" class="btn btn-outline-primary mx-2">Atualizar conta</a>
                <button onclick="logout()" class="btn btn-outline-danger">Sair</button>
            </div>
        `;
    } else {
        window.location.replace('login.php');
    }

    function logout() {
        sessionStorage.clear();

        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Você saiu!',
        }).then((result) => {
            window.location.replace('index.php');
        });
    }
</script>