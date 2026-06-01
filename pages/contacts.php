<?php
session_start();
$sent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg   = trim($_POST['message'] ?? '');

    if ($name && $email && $msg) {
        $sent = true;
    } else {
        $error = 'Please fill in all fields.';
    }
}

include '../includes/header.php';
?>

<main>
<div class="contacts-wrap">
<div class="contacts-left">
    <h2>
        Feel free to contact
        us anytime
    </h2>
    <div class="contacts-info">
        <h4>Location</h4>
        <p>Tver, Russia</p>
    </div>
    <div class="contacts-info">
        <h4>Phone</h4>
        <p>
            <a href="tel:+79999999999">
                +7 999 999 99 99
            </a>
        </p>
    </div>
    <div class="contacts-info">
        <h4>Email</h4>
        <p>
            <a href="mailto:flower@flower.com">
                flower@flower.com
            </a>
        </p>
    </div>
    <div class="social-icons">
        <a href="https://vk.com/">
            <img src="vk.png" alt="">
        </a>
        <a href="https://web.telegram.org/">
            <img src="tg.png" alt="">
        </a>
        <a href="https://www.instagram.com/">
            <img src="inst.png" alt="">
        </a>
        <a href="https://www.tiktok.com/">
            <img src="tt.png" alt="">
        </a>
    </div>
</div>
<div class="contacts-right">
    <?php if($sent): ?>
        <div class="alert alert-success">
            Message sent successfully
        </div>
    <?php endif; ?>
    <?php if($error): ?>
        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <form
        method="post"
        class="contact-form">
        <div class="form-field">
            <img src="name.png" alt="">
            <input
                type="text"
                name="full_name"
                placeholder="Full name"
                required>
        </div>
        <div class="form-field">
            <img src="email.png" alt="">
            <input
                type="email"
                name="email"
                placeholder="Email"
                required>
        </div>
        <div class="form-field textarea-field">
            <img src="message.png" alt="">
            <textarea
                name="message"
                placeholder="Your message"></textarea>
        </div>
        <button
            type="submit"
            class="submit-btn">
            Submit message
        </button>
    </form>
</div>
</div>
</main>
<?php include '../includes/footer.php'; ?>
