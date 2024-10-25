<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>
<body>
    <h1>Todo List</h1>
    <?php if (!empty($todos)): ?>
        <ul>
        <?php foreach ($todos as $todo): ?>
            <li>
                <strong><?= esc($todo['task']) ?></strong>
                (<?= esc($todo['status']) ?>)
                <p><?= esc($todo['description']) ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No todo items found.</p>
    <?php endif; ?>
</body>
</html>
