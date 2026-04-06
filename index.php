<?php
include 'includes.php';

// Read search text from the URL and default to an empty string if it is missing.
$zoekInput = trim($_GET['zoek'] ?? '');
// Escape search text before placing it in the SQL LIKE clause.
$zoek = $conn->real_escape_string($zoekInput);

// Build one of two SQL queries:
// 1) all customers when search is empty, 2) filtered customers when search has text.
$query = $zoekInput === ''
    ? "SELECT * FROM klanten ORDER BY naam ASC LIMIT 100"
    : "SELECT * FROM klanten WHERE naam LIKE '%{$zoek}%' ORDER BY naam ASC LIMIT 100";
// Execute SQL and store the database result object.
$result = $conn->query($query);

// Count rows so the UI can show how many customers were found.
$totaal = $result->num_rows;
// Prepare the status text once so the HTML stays clean.
$resultaatTekst = $zoekInput !== ''
    ? "Resultaten voor '" . h($zoekInput) . "': {$totaal}"
    : "Aantal klanten: {$totaal}";
$title = 'Royal Food Corner Weert - Klantenbeheer';
?>
<?php include 'header.php'; ?>

<section class="hero-banner py-5 text-center">
  <div class="container">
        <h2>Welkom bij Royal Food Corner Weert</h2>
        <p class="lead">Beheer je klanten van Royal Food Corner Weert snel en efficient.</p>
  </div>
</section>
<div class="container mt-5">
  <div class="card">
        <div class="card-body content-panel">

<h1>Klantenbeheer Royal Food Corner Weert</h1>
<p class="text-muted"><?= $resultaatTekst; ?></p>

<form method="GET" class="mb-3">
    <div class="input-group search-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <!-- Use h() so user input is safe when rendered back into HTML. -->
        <input type="text" name="zoek" class="form-control" placeholder="Zoek op naam" 
               value="<?= h($zoekInput); ?>">
    </div>
</form>

<a href="toevoegen.php" class="btn btn-primary mb-3"><i class="bi bi-plus-lg me-1"></i>Nieuwe klant</a>

<div class="table-header d-flex align-items-center justify-content-between mb-2">
    <h2 class="h5 mb-0">Klantenoverzicht</h2>
</div>
<div class="table-responsive">
<table class="table table-striped align-middle">
<thead>
<tr>
    <th>Naam</th>
    <th>Adres</th>
    <th>Woonplaats</th>
    <th>Datum toegevoegd</th>
    <th>Acties</th>
</tr>
</thead>
<tbody>
<?php
// Loop through database rows and print one table row per customer.
while ($row = $result->fetch_assoc()) {
?>
<tr>
    <!-- Escape plain text output and mask personal fields for privacy. -->
    <td><?= h($row['naam']); ?></td>
    <td><?= mask_pii($row['adres'], 3); ?></td>
    <td><?= mask_pii($row['woonplaats'], 3); ?></td>
    <td><?= h($row['datum_toegevoegd']); ?></td>
    <td>
        <a href="bewerken.php?id=<?= h($row['id']); ?>" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i>
        </a>
        <a href="verwijderen.php?id=<?= h($row['id']); ?>" 
           onclick="return confirm('Weet je zeker dat je deze klant wilt verwijderen?')"
           class="btn btn-danger btn-sm">
            <i class="bi bi-trash"></i>
        </a>
    </td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>