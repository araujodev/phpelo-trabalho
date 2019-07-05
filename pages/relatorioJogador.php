<?php

    $jogador_id = $_GET['jogador_id'];

?>

<div class="card">
    <div class="card-header">
        Novo Relatorio do Jogador
    </div>
    <div class="card-body">
        <h5 class="card-title">Cadastro de novo relatorio</h5>

        <form action="func/FuncCriarRelatorioJogador.php" method="post">
            <div class="form-group">
                <label for="timeAtual">Qual o seu time atual?</label>
                <input type="text" class="form-control" name="time_atual" id="timeAtual" placeholder="Ex: Palmeiras">
            </div>
            <div class="form-group">
                <label for="idade_inicio">Com quantos anos começou a jogar?</label>
                <input type="text" class="form-control" name="idade_inicio" id="idade_inicio" placeholder="Ex: 18 anos">
            </div>
            <div class="form-group">
                <label for="idade_inicio">Já sofreu lesao enquanto jogava?</label>
                <select name="lesao" id="lesao" class="form-control">
                    <option value="sim" selected>Sim</option>
                    <option value="nao">Nao</option>
                </select>
            </div>
            <input type="hidden" value="<?= $jogador_id?>" name="jogador_id">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>




<div class="card mt-5">
    <div class="card-header">
        Relatorios do Jogador
    </div>
    <div class="card-body">
        <h5 class="card-title">Lista de todos os relatorios do jogador</h5>

        <?php

        $statement = $db->pdo->prepare("SELECT * FROM relatorios WHERE jogador_id = :jogador_id ORDER BY criado_em DESC");
        $statement->bindParam(':jogador_id', $jogador_id, PDO::PARAM_INT);
        $statement->execute();
        $rows = $statement->rowCount();
        $relatorios = [];
        if($rows >= 1)
        {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $relatorios[] = $row;
            }
        }
        ?>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Qual o seu time atual?</th>
                <th scope="col">Com quantos anos começou a jogar?</th>
                <th scope="col">Já sofreu lesao enquanto jogava?</th>
                <th scope="col">Respondido em:</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($relatorios as $relatorio): ?>
                <tr>
                    <td><?= $relatorio->time_atual; ?></td>
                    <td><?= $relatorio->idade_inicio; ?></td>
                    <td><?= $relatorio->lesao; ?></td>
                    <td><?= date('d/m/Y', strtotime($relatorio->criado_em)); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>