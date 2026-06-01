<?php
session_start();
$sent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['full_name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');

    if ($name && $email && $address && $phone) {
        $sent = true;
    } else {
        $error = 'Please fill in all fields.';
    }
}

include '../includes/header.php';
?>

<main>
<section class="delivery-page">
    <div class="delivery-wrap">
        <div class="delivery-form-card">
            <form class="delivery-form">
                <div class="delivery-input">
                    <img src="../pages/name.png" alt="">
                    <input type="text" placeholder="Full name">
                </div>
                <div class="delivery-input">
                    <img src="../pages/email.png" alt="">
                    <input type="email" placeholder="Email">
</div>
                <div class="delivery-input">
                    <img src="../pages/location.png" alt="">
                    <input type="text" placeholder="Address">
                </div>
                <div class="delivery-input">
                    <img src="../pages/phoneR.png" alt="">
                    <input type="text" placeholder="Phone">
                </div>
                <div class="delivery-help-text">
                    Need help with delivery?<br>
                    Call us: +7 999 999 99 99
                </div>
                <button class="delivery-order-btn">
                    Order Now
                </button>
            </form>
        </div>
        <div class="delivery-content">
            <h1>
                Fast and fresh delivery
                straight to your door
            </h1>
            <div class="delivery-bottom">
                <div class="delivery-logo-card">
                    <img
                        src="../pages/delivery cart.png"
                        alt="Delivery">
                    <span>Delivery</span>
                </div>
                <div class="delivery-info">
                    <div class="delivery-block">
                        <h3>Working Hours</h3>
                        <p>
                            Mon–Fri:<br>
                            10:00–21:00
                        </p>
                        <p>
                            Sat–Sun:<br>
                            10:00–20:00
                        </p>
                    </div>
                    <div class="delivery-block">
                        <h3>Delivery Info</h3>
                        <p>Free delivery on orders over $80</p>
                        <p>Standard delivery $5</p>
                        <p>Delivery in 2–4 hours</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<?php include '../includes/footer.php'; ?>
