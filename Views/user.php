<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
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
            width: 400px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Редактирование пользователя</h2>
    <form method="post">
        <?php
        if ($model->success) {
            echo "<span style='color: green;'>".$model->success."</span>";
        }
        ?>
        <?php
        if ($model->error) {
            echo "<span style='color: red;'>".$model->error."</span>";
        }
        ?>

        <input type="hidden" name="id" value="<?= $model->id ?>">
        <input type="text" name="name" placeholder="Имя" value="<?= $model->name ?>" required>
        <input type="text" name="phone" placeholder="Телефон" value="<?= $model->phone ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= $model->email ?>" required>
        <button type="submit">Сохранить</button>
    </form>
</div>
</body>
</html>
