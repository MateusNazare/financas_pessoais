<?php
require_once('head.php');
require_once('header.php');
?>

<div class="container-fluid main">
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Entrada</div>
                <div class="card-body">
                    <h4 class="card-title"><span id="entrada"></span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 align-self-center mb-3">
            <div class="card text-white bg-danger">
                <div class="card-header">Saída</div>
                <div class="card-body">
                    <h4 class="card-title"><span id="saida"></span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 align-self-center mb-3">
            <div class="card text-white bg-primary">
                <div class="card-header">Total</div>
                <div class="card-body">
                    <h4 class="card-title"><span id="total"></span></h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center mt-4">
        Transações
    </h3>

    <div class="text-center">
        <button type="button" class="btn btn-outline-success" id="openModal">Nova Transação</button>
    </div>

    <table id="table_id" class="table table-dark table-hover mt-4 text-center">
        <thead>
            <tr>
                <th>Título</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Data</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="myModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title-modal" class="modal-title">Cadastro de Transações</h5>
                <button type="button" onclick="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="id">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="value" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="value" step="0.01" required>
                    </div>
                    <input type="radio" class="btn-check" value="1" name="option" id="input" autocomplete="off" checked>
                    <label class="btn btn-outline-success" for="input">Entrada</label>

                    <input type="radio" class="btn-check" value="0" name="option" id="output" autocomplete="off">
                    <label class="btn btn-outline-danger" for="output">Saída</label>
                    <div class="mt-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select id="category" class="form-select" aria-label="Default select example" required>
                            <option selected>Selecione uma categoria</option>
                            <option value="Estudos">Estudos</option>
                            <option value="Casa">Casa</option>
                            <option value="Viagem">Viagem</option>
                            <option value="Compras">Compras</option>
                            <option value="Farmácia">Farmácia</option>
                        </select>
                    </div>
                </form>
            </div>
            <div id="updateOrRegister" class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script type="module">
    $(document).ready(function() {

        let table = $('#table_id').DataTable({
            "columns": [
                null,
                null,
                null,
                null,
                {
                    "width": "8%"
                },
                {
                    "width": "8%"
                },
            ],
            responsive: true,
            scrollY: true,
            searching: false,
            paging: false,
            ordering: false,
        });

        let total = 0;
        let entrada = 0;
        let saida = 0;

        const url = "http://127.0.0.1:3000/transactions";

        let token = window.sessionStorage.getItem("token");

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
                        let token = window.sessionStorage.getItem("token");
                        let user = window.sessionStorage.getItem("user");

                        user = JSON.parse(user);

                        console.log(json)

                        let buttonUpdate = '-';
                        let buttonDelete = '-';

                        for (let data of json) {
                            buttonDelete = `<button onclick="deleteTransaction('${data.id}')" type="button" class="btn btn-outline-danger">Apagar</button>`;
                            buttonUpdate = `
                                    <div class="d-flex">  
                                        <button onclick="update('${data.id}', '${data.title}', '${data.value}', '${data.type}', '${data.category}', )" class="btn btn-outline-primary">Atualizar</button>
                                    </div>
                                        
                                    `;

                            table.row.add([
                                data.title,
                                data.type == 1 ? "+" + data.value : "-" + data.value,
                                data.category,
                                data.created_at,
                                buttonUpdate,
                                buttonDelete,
                            ]).draw(false);

                            console.log(parseFloat(json.value));

                            if (data.type) {
                                entrada += parseFloat(data.value);
                            } else {
                                saida += parseFloat(data.value);
                            }

                            total = entrada - saida;
                        }

                        document.getElementById('entrada').innerHTML = entrada;
                        document.getElementById('saida').innerHTML = saida;
                        document.getElementById('total').innerHTML = total;

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
    });
</script>

<?php
require_once('foot.php');
?>

<script>
    $("#openModal").on('click', function(e) {
        document.getElementById("title-modal").innerHTML = "Cadastrar Transação";
        document.getElementById("updateOrRegister").innerHTML = `
            <button type="button" onclick="closeModal()" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button onclick="register()" type="button" class="btn btn-primary">Cadastrar</button>
        `;

        $('#myModal').show()
    });

    function register() {
        const url = "http://127.0.0.1:3000/transactions";

        let title = document.getElementById('title').value;
        let value = document.getElementById('value').value;
        let type = document.querySelector('input[name="option"]:checked').value;
        let category = document.getElementById('category').value;

        let token = window.sessionStorage.getItem("token");

        fetch(url, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            body: JSON.stringify({
                title: title,
                value: parseFloat(value),
                type: parseInt(type),
                category: category
            }),
        }).then(
            async (response) => {
                let contentType = response.headers.get("content-type");

                if (response.status === 201) {
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

    function update(id_data, title_data, value_data, type_data, category_data) {

        document.getElementById("title-modal").innerHTML = "Atualizar Transação";

        document.getElementById("updateOrRegister").innerHTML =
            `
            <button type="button" onclick="closeModal()" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button onclick="updateData()" type="button" class="btn btn-primary">Atualizar</button>
        `;

        document.getElementById('title').value = title_data;
        document.getElementById('value').value = value_data;
        document.getElementById('category').value = category_data;
        document.getElementById('id').value = id_data;

        console.log(id_data, title_data, value_data, type_data, category_data)

        $('#myModal').show()
    }

    function closeModal() {
        document.getElementById('title').value = '';
        document.getElementById('value').value = '';
        document.getElementById('category').value = '';
        document.getElementById('id').value = '';

        $('#myModal').hide()
    }

    function updateData() {
        let id = document.getElementById('id').value;

        const url = "http://127.0.0.1:3000/transactions/" + id;

        let title = document.getElementById('title').value;
        let value = document.getElementById('value').value;
        let type = document.querySelector('input[name="option"]:checked').value;
        let category = document.getElementById('category').value;


        fetch(url, {
            method: "PUT",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            body: JSON.stringify({
                title: title,
                value: parseFloat(value),
                type: parseInt(type),
                category: category
            }),
        }).then(
            async (response) => {
                let contentType = response.headers.get("content-type");

                if (response.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Atualizado com sucesso!',
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
                        text: 'Falha ao atualizar!',
                    });
                }
            }
        );
    }

    function deleteTransaction(id) {
        const url = "http://127.0.0.1:3000/transactions/" + id;

        let token = window.sessionStorage.getItem("token");

        fetch(url, {
            method: "DELETE",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
        }).then(
            async (response) => {
                let contentType = response.headers.get("content-type");

                if (response.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Apagado com sucesso!',
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
                        text: 'Falha ao apagar!',
                    });
                }
            }
        );
    }
</script>