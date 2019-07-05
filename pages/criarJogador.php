<div class="card">
    <div class="card-header">
        Criar Jogador
    </div>
    <div class="card-body">
        <h5 class="card-title">Cadastro de novo jogador</h5>

        <form action="func/FuncCriarJogador.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomeCompleto">Nome Completo</label>
                <input type="text" class="form-control" name="nome_completo" id="nomeCompleto" placeholder="Nome Completo">
            </div>
            <div class="form-group">
                <label for="idade">Idade</label>
                <input type="text" class="form-control" name="idade" id="idade" placeholder="Ex: 23 anos">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="rg">RG</label>
                    <input type="text" name="rg" class="form-control" id="rg">
                </div>
                <div class="form-group col-md-6">
                    <label for="cpf">CPF (somente numeros)</label>
                    <input type="text" name="cpf" class="form-control" id="cpf">
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control" id="foto">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>