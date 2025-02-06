<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Área Administrativa - Serviço</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .back-link { margin-bottom: 20px; display: inline-block; }
    </style>
</head>
<body>
    <a class="back-link" href="admin_home.php">&larr; Voltar para Home</a>
    <h1>Chamados de <?php echo ucfirst($service); ?></h1>

    <?php if (count($records) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bloco</th>
                    <th>Local Tipo</th>
                    <th>Local Identificação</th>
                    <th>Descrição</th>
                    <th>Data Criação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['bloco']); ?></td>
                        <td><?php echo htmlspecialchars($record['local_tipo']); ?></td>
                        <td><?php echo htmlspecialchars($record['local_identificacao']); ?></td>
                        <td><?php echo htmlspecialchars($record['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($record['data_criacao']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum registro encontrado.</p>
    <?php endif; ?>
</body>
</html>
