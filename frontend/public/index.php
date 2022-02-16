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
                    <h4 class="card-title">R$ 4.500,00</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 align-self-center mb-3">
            <div class="card text-white bg-danger">
                <div class="card-header">Saída</div>
                <div class="card-body">
                    <h4 class="card-title">R$ 2.500,00</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 align-self-center mb-3">
            <div class="card text-white bg-primary">
                <div class="card-header">Total</div>
                <div class="card-body">
                    <h4 class="card-title">R$ 2.000,00</h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center mt-4">
        Transações
    </h3>

    <div class="text-center">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#myModal">Nova Transação</button>
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
            <tr>
                <td>Supermercado</td>
                <td>R$ 200,00</td>
                <td>Alimentação</td>
                <td>27/02/2022</td>
                <td><button class="btn btn-outline-primary">Atualizar</button></td>
                <td><button class="btn btn-outline-danger">Apagar</button></td>
            </tr>
            <tr>
                <td>Supermercado</td>
                <td>R$ 200,00</td>
                <td>Alimentação</td>
                <td>27/02/2022</td>
                <td><button class="btn btn-outline-primary">Atualizar</button></td>
                <td><button class="btn btn-outline-danger">Apagar</button></td>
            </tr>
        </tbody>
    </table>
</div>

<div id="myModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Transações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="value" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="value" step="0.01" required>
                    </div>
                    <input type="radio" class="btn-check" name="type" id="input" autocomplete="off" checked>
                    <label class="btn btn-outline-success" for="input">Entrada</label>

                    <input type="radio" class="btn-check" name="type" id="output" autocomplete="off">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once('foot.php');
?>

<script type="module">
    $(document).ready(function() {
        $('#table_id').DataTable({
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
    });
</script>