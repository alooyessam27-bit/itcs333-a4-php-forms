<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — contact form.
 * Requirements (see README rubric):
 *   - GET: render the form
 *   - POST: validate name (required, 2-60 chars), email (valid), message (required, 10-1000 chars)
 *   - invalid POST: re-render with inline errors + repopulated fields (200)
 *   - valid POST: redirect (302/303) to a success page (PRG)
 *   - escape all output with htmlspecialchars
 */

require_once __DIR__ . '/../src/validate.php';

$name = '';
$email = '';
$message = '';

$nameError = '';
$emailError = '';
$messageError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = is_string($_POST['name'] ?? null) ? $_POST['name'] : '';
    $email = is_string($_POST['email'] ?? null) ? $_POST['email'] : '';
    $message = is_string($_POST['message'] ?? null) ? $_POST['message'] : '';

    if (!validate_required($name)) {
        $nameError = 'Name is required.';
    } elseif (!validate_length($name, 2, 60)) {
        $nameError = 'Name must be 2 to 60 characters.';
    }

    if (!validate_email($email)) {
        $emailError = 'Invalid email address.';
    }

    if (!validate_required($message)) {
        $messageError = 'Message is required.';
    } elseif (!validate_length($message, 10, 1000)) {
        $messageError = 'Message must be 10 to 1000 characters.';
    }

    if ($nameError === '' && $emailError === '' && $messageError === '') {
        header('Location: success.php', true, 303);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Contact Us</h1>
  <form method="post" action="index.php" novalidate>

    <label>Name
        <input type="text" name="name"
        value="<?= htmlspecialchars($name) ?>">
    </label>
    <span><?= htmlspecialchars($nameError) ?></span>
    <br>

    <label>Email
        <input type="email" name="email"
        value="<?= htmlspecialchars($email) ?>">
    </label>
    <span><?= htmlspecialchars($emailError) ?></span>
    <br>

    <label>Message
        <textarea name="message"><?= htmlspecialchars($message) ?></textarea>
    </label>
    <span><?= htmlspecialchars($messageError) ?></span>
    <br>

    <button type="submit">Send</button>

</form>
</body>
</html>
