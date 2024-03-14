<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
</head>
<body>
<div class="container">
    <h2>Список пользователей</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

            <?php
                foreach ($users as $user) {
                    ?>
                    <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <a href="?action=userEdit&id=<?= $user['id'] ?>" class="btn-edit">Редактировать</a>
                        <a href="?action=userDelete&id=<?= $user['id'] ?>" class="btn-delete">Удалить</a>
                    </td>
                    <tr>
                    <?php
                }
            ?>

        <!-- Добавьте другие строки таблицы для других пользователей -->
        </tbody>
    </table>
</div>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 600px;
        background-color: #fff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        margin-top: 0;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn-edit, .btn-delete {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 5px;
    }

    .btn-edit:hover, .btn-delete:hover {
        background-color: #0056b3;
    }
</style>


</body>
</html>
