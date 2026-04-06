<?php
include 'includes.php';

// Read customer ID from URL and force it to an integer.
$id = intval($_GET['id'] ?? 0);

// Load the existing customer data so the form starts with current values.
$result = $conn->query("SELECT * FROM klanten WHERE id={$id} LIMIT 1");
$klant = $result->fetch_assoc();

// Handle form submit.
if (isset($_POST['update'])) {
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

        // Update this customer row in the database.
        $conn->query("UPDATE klanten SET naam='{$naamSql}', adres='{$adresSql}', woonplaats='{$woonplaatsSql}' WHERE id={$id}");

        // Redirect after success so refresh does not re-send the form.
        header("Location: index.php");
        exit();
    }
}

$title = 'Royal Food Corner Weert - Klant bewerken';
?>
<?php include 'header.php'; ?>

<div class="container mt-5">
  <div class="card">
    <div class="card-body">

<h2>Klant bewerken - Royal Food Corner Weert</h2>

<!-- Show a validation message when required fields are missing. -->
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= h($error); ?></div>
<?php endif; ?>

<!-- Form to edit customer details -->
<form method="POST">
    <!-- Use h() so database content is safely rendered in HTML fields. -->
    <input type="text" name="naam" class="form-control mb-2" value="<?= h($klant['naam']); ?>">
    <input type="text" name="adres" class="form-control mb-2" value="<?= h($klant['adres']); ?>">
    <input type="text" name="woonplaats" class="form-control mb-2" value="<?= h($klant['woonplaats']); ?>">
    <button type="submit" name="update" class="btn btn-success"><i class="bi bi-pencil-square me-1"></i>Bijwerken</button>
    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Terug</a>
</form>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>