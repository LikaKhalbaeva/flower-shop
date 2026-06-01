<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['wishlist'])) $_SESSION['wishlist'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = intval($_POST['product_id'] ?? 0);
    if ($action === 'add_to_cart' && $id) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    if ($action === 'add_to_wishlist' && $id) {
        if (in_array($id, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = array_filter($_SESSION['wishlist'], fn($x) => $x !== $id);
        } else {
            $_SESSION['wishlist'][] = $id;
        }
    }
    header('Location: index.php');
    exit;
}

include 'data/products.php';
include 'includes/header.php';
?>

<main>
<section class="hero">
<div class="hero-flowers">
    <img src="GG.png" alt="Flowers">
</div>
<div class="hero-text">
    <h1>
        Beautiful flowers<br>
        for every moment
    </h1>
    <p>
        Bring joy, love and warmth with our
        fresh handmade bouquets.
    </p>
    <div class="hero-btns">
        <a href="pages/flowers.php"
           class="btn-primary">
            Shop
        </a>
        <a href="pages/flowers.php"
           class="btn-outline">
            Find in Store
        </a>
    </div>
</div>
</section>
</main>
<?php include 'includes/footer.php'; ?>
