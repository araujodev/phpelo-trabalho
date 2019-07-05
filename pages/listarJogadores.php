<div class="card">
    <div class="card-header">
        Listar Jogadores
    </div>
    <div class="card-body">
        <h5 class="card-title">Lista de todos os jogadores</h5>

        <?php

            $statement = $db->pdo->prepare("SELECT * FROM jogadores ORDER BY nome_completo ASC");
            $statement->execute();
            $rows = $statement->rowCount();
            $jogadores = [];
            if($rows >= 1)
            {
                while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                    $jogadores[] = $row;
                }
            }
        ?>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Foto</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">Idade</th>
                <th scope="col">RG</th>
                <th scope="col">CPF</th>
                <th scope="col">Relatorio</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($jogadores as $jogador): ?>
            <tr>
                <th scope="row"><img width="70" src="images/<?= $jogador->foto; ?>"></th>
                <td><?= $jogador->nome_completo; ?></td>
                <td><?= $jogador->idade; ?></td>
                <td><?= $jogador->rg; ?></td>
                <td><?= $jogador->cpf; ?></td>
                <td>
                    <a class="btn btn-success" href="?page=relatorio-jogador&jogador_id=<?= $jogador->id; ?>">Relatorio</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>