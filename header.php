<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($title ?? 'Royal Food Corner Weert - Klantenbeheer'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../stylesheets/php.css?v=20260401">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php"><i class="bi bi-people-fill me-2"></i>Royal Food Corner Weert</a>
        <div>
          <a href="index.php" class="btn btn-light btn-sm"><i class="bi bi-house me-1"></i>Overzicht</a>
          <a href="toevoegen.php" class="btn btn-success btn-sm"><i class="bi bi-plus-lg me-1"></i>Nieuwe klant</a>
        </div>
      </div>
    </nav>
</header>
