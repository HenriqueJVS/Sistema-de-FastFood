<?php require __DIR__ . '/layout/header.php'; ?>

<h2>👥 Gerenciar Atendentes</h2>

<a href="index.php?pagina=gerente/adicionar_atendente">➕ Cadastrar Novo Atendente</a>

<hr>

<table border="1" cellpadding="8">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($atendentes as $a): ?>
        <tr>
            <td><?= htmlspecialchars($a->nome) ?></td>
            <td><?= htmlspecialchars($a->email) ?></td>
            <td>
                <a href="index.php?pagina=gerente/editar_atendente&id=<?= $a->id ?>">Editar</a> |
                <a href="index.php?pagina=gerente/excluir_atendente&id=<?= $a->id ?>" onclick="return confirm('Deseja excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . '/layout/footer.php'; ?>
