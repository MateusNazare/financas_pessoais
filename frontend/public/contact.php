<?php
require_once('head.php');
require_once('header.php');
?>

<div class="container-fluid main">
    <div class="row justify-content-center">
        <form class="col-md-6 mt-5">
            <div class="mb-3">
                <label for="Nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Nome">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <textarea class="form-control" id="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php
require_once('foot.php');
?>