<?php
include 'connect.php';

$table = $_GET['table'] ?? '';
$table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // sanitize

$tables = ['books', 'ebooks', 'journals', 'proceedings', 'thesis'];
if (!in_array($table, $tables)) {
    die("Invalid table.");
}

$query = "SELECT * FROM $table";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= ucfirst($table) ?> Table</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: url('wp2508260.webp') no-repeat center center/cover;
            filter: blur(6px);
            z-index: -1;
        }

        h2 {
            text-align: center;
            font-size: 30px;
            color: #fff;
            margin-bottom: 20px;
            text-transform: capitalize;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            font-weight: bold;
            color: #00ffff;
            padding: 8px 14px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        .table-wrapper {
            overflow-x: auto;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th, td {
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px;
            text-align: center;
            color: #fff;
        }

        th {
            background-color: rgba(0, 123, 255, 0.8);
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #eee;
        }

        .download-btn {
            color: #00ffcc;
            text-decoration: none;
            font-weight: bold;
        }

        .download-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<a href="index11.php" class="back-link">&larr; Back to Dashboard</a>

<div class="table-wrapper">
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <?php if ($table === 'ebooks'): ?>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Download</th>
                    <?php else: ?>
                        <?php while ($field = $result->fetch_field()): ?>
                            <th><?= htmlspecialchars($field->name) ?></th>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <?php if ($table === 'ebooks'): ?>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= htmlspecialchars($row['author']) ?></td>
                            <td>
                                <?php if (!empty($row['pdf_file'])): ?>
                                    <a href="<?= htmlspecialchars($row['pdf_file']) ?>" download class="download-btn">Download</a>
                                <?php else: ?>
                                    No File
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <?php foreach ($row as $col): ?>
                                <td><?= htmlspecialchars($col) ?></td>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No data found in <?= htmlspecialchars($table) ?> table.</p>
    <?php endif; ?>
</div>

</body>
</html>
