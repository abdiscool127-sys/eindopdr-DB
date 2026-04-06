<?php
include 'includes.php';

// Handle form submit.
if (isset($_POST['opslaan'])) {
    // Read submitted form values and remove surrounding spaces.
    $naam = trim($_POST['naam'] ?? '');
    $adres = trim($_POST['adres'] ?? '');
    $woonplaats = trim($_POST['woonplaats'] ?? '');

    // Stop early if any required field is empty.
    if ($naam === '' || $adres === '' || $woonplaats === '') {
        $error = "Please fill in all fields.";
    } else {
        // Escape values before using them in an SQL string.
        $naamSql = $conn->real_escape_string($naam);
        $adresSql = $conn->real_escape_string($adres);
        $woonplaatsSql = $conn->real_escape_string($woonplaats);

        // Insert the customer into the database table.
        $conn->query("INSERT INTO klanten (naam, adres, woonplaats) VALUES ('{$naamSql}', '{$adresSql}', '{$woonplaatsSql}')");

        // Redirect after success so refresh does not submit the form again.
        header("Location: index.php");
        exit();
    }
}

$title = 'Royal Food Corner Weert - Nieuwe klant';
?>
<?php include 'header.php'; ?>

<div class="container mt-5">
  <div class="card">
    <div class="card-body">

<h2>Nieuwe klant toevoegen - Royal Food Corner Weert</h2>

<!-- Show a validation message when required fields are missing. -->
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= h($error); ?></div>
<?php endif; ?>

<!-- Form to add a new customer -->
<form method="POST">
    <input type="text" name="naam" class="form-control mb-2" placeholder="Naam">
    <input type="text" name="adres" class="form-control mb-2" placeholder="Adres">
    <input type="text" name="woonplaats" class="form-control mb-2" placeholder="Woonplaats">
    <button type="submit" name="opslaan" class="btn btn-success"><i class="bi bi-save me-1"></i>Opslaan</button>
    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Terug</a>
</form>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>