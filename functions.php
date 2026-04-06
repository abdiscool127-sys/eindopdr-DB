<?php
// Helper functions used across the application

// Escape a string for safe HTML output (prevents XSS)
function h($string) {
    // ENT_QUOTES escapes both single and double quotes.
    // UTF-8 keeps character handling consistent across pages.
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Mask personal data (PII) for display to help GDPR / AVG compliance.
// Shows the first N characters and replaces the rest with asterisks.
function mask_pii($value, $visible = 2) {
    // Force input to string so strlen/substr are always safe to run.
    $value = (string) $value;
    $len = strlen($value);

    // If text is very short, hide everything.
    if ($len <= $visible) return str_repeat('*', $len);

    // Keep the first part visible and mask the rest.
    return substr($value, 0, $visible) . str_repeat('*', $len - $visible);
}
?>
