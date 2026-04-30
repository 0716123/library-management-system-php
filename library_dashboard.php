<!-- FILE: library_dashboard.php -->
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: auto;
        }
        .card {
            background: white;
            border: 2px solid #007bff;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.2s;
        }
        .card:hover {
            background: #007bff;
            color: white;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

    <h1>📚 Library & Learning Center</h1>

    <div class="dashboard">
        <a href="view_table.php?table=books"><div class="card">📖 Books</div></a>
        <a href="view_table.php?table=ebooks"><div class="card">📘 Ebooks</div></a>
        <a href="view_table.php?table=journals"><div class="card">📑 Journals</div></a>
        <a href="view_table.php?table=proceedings"><div class="card">📋 Proceedings</div></a>
        <a href="view_table.php?table=thesis"><div class="card">📚 Thesis</div></a>
        
        
    </div>

</body>
</html>
