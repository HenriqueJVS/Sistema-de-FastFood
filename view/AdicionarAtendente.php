<?php require __DIR__ . '/layout/header.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>👥 Atendentes</h2>
        <a href="index.php?pagina=gerente/adicionar_atendente" class="btn btn-success">
            ➕ Adicionar Novo Atendente
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Matrícula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($atendentes as $a): ?>
                    <tr>
                        <td><?= $a->id ?></td>
                        <td><?= $a->nome ?></td>
                        <td><?= $a->email ?></td>
                        <td><?= $a->cpf ?></td>
                        <td><?= $a->matricula ?></td>
                        <td>
                            <a href="index.php?pagina=gerente/editar_atendente&id=<?= $a->id ?>" class="btn btn-primary btn-sm">
                                ✏️ Editar
                            </a>
                            <a href="index.php?pagina=gerente/excluir_atendente&id=<?= $a->id ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir este atendente?')" 
                               class="btn btn-danger btn-sm">
                                🗑️ Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
