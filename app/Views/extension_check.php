<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magento PHP Requirements Check</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }
        .status-ok {
            background-color: #d4edda;
            color: #155724;
        }
        .status-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        .description {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- PHP Version Section -->
        <div class="section">
            <h2>PHP Version Check</h2>
            <p>
                Current Version: 
                <span class="status <?= $php_version['status'] ? 'status-ok' : 'status-error' ?>">
                    <?= $php_version['current'] ?>
                </span>
            </p>
            <p>Minimum Required: <?= $php_version['minimum'] ?></p>
            <p>Recommended: <?= $php_version['recommended'] ?></p>
            <p><?= $php_version['message'] ?></p>
        </div>

        <!-- Required Extensions Section -->
        <div class="section">
            <h2>Required Extensions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Extension</th>
                        <th>Status</th>
                        <th>Version</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($required_extensions as $name => $info): ?>
                    <tr>
                        <td><?= $name ?></td>
                        <td>
                            <span class="status <?= $info['installed'] ? 'status-ok' : 'status-error' ?>">
                                <?= $info['status'] ?>
                            </span>
                        </td>
                        <td><?= $info['version'] ?? 'N/A' ?></td>
                        <td class="description"><?= $info['description'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Recommended Extensions Section -->
        <div class="section">
            <h2>Recommended Extensions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Extension</th>
                        <th>Status</th>
                        <th>Version</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recommended_extensions as $name => $info): ?>
                    <tr>
                        <td><?= $name ?></td>
                        <td>
                            <span class="status <?= $info['installed'] ? 'status-ok' : 'status-warning' ?>">
                                <?= $info['status'] ?>
                            </span>
                        </td>
                        <td><?= $info['version'] ?? 'N/A' ?></td>
                        <td class="description"><?= $info['description'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- System Information Section -->
        <div class="section">
            <h2>System Information</h2>
            <table>
                <tbody>
                    <?php foreach ($system_info as $key => $value): ?>
                    <tr>
                        <td><?= ucwords(str_replace('_', ' ', $key)) ?></td>
                        <td><?= $value ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
