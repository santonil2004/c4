<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>
<body>
    <h1>Todo List</h1>

    <h2>Debug Information:</h2>
    <p>Xdebug: <?= $xdebug_enabled ?></p>
    <p>PCOV: <?= $pcov_enabled ?></p>

    <ul>
    <?php foreach ($todos as $todo): ?>
        <li><?= esc($todo['task']) ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
