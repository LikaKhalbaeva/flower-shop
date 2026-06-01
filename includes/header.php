<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['wishlist'])) $_SESSION['wishlist'] = [];

$cart_count = array_sum($_SESSION['cart']);
$wish_count = count($_SESSION['wishlist']);

$current = basename($_SERVER['PHP_SELF'], '.php');
$base = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Flower</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800;900&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet"
href="<?= $base ?>css/style.css?v=<?= time() ?>">
</head>
<body>
<header class="site-header">
<div class="top-header">
    <div class="logo-wrap">
        <a href="<?= $base ?>index.php" class="logo">
            <img src="<?= $base ?>CG.png" alt="Flower">
            <div class="logo-info">
                <h1>Flower</h1>
                <span>Fresh flowers for every occasion</span>
            </div>
        </a>
    </div>
    <div class="header-icons">
        <a href="<?= $base ?>pages/contacts.php">
            <img src="<?= $base ?>includes/phone.png" alt="">
        </a>
        <a href="<?= $base ?>pages/wishlist.php" class="icon-counter">
            <img src="<?= $base ?>includes/like.png" alt="">
            <?php if($wish_count): ?>
            <span><?= $wish_count ?></span>
            <?php endif; ?>
            </a>
        <a href="<?= $base ?>pages/cart.php" class="icon-counter">
            <img src="<?= $base ?>includes/cart.png" alt="">
            <?php if($cart_count): ?>
            <span><?= $cart_count ?></span>
            <?php endif; ?>
        </a>
    </div>
</div>
<nav class="main-nav">
    <a href="<?= $base ?>index.php"
       class="<?= $current=='index'?'active':'' ?>">
        Home
    </a>
    <a href="<?= $base ?>pages/flowers.php"
       class="<?= $current=='flowers'?'active':'' ?>">
        Flowers
    </a>
    <a href="<?= $base ?>pages/contacts.php"
       class="<?= $current=='contacts'?'active':'' ?>">
        Contacts
    </a>
    <a href="<?= $base ?>pages/delivery.php"
       class="<?= $current=='delivery'?'active':'' ?>">
        Delivery
    </a>
</nav>
<div class="search-wrap">
    <form action="<?= $base ?>pages/flowers.php"
          method="GET"
          class="search-form">
        <input
            type="text"
            name="q"
            placeholder="Search flowers..."
            value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
        >
        <button type="submit">
            <img src="<?= $base ?>includes/search.png" width="20" alt="">
        </button>
    </form>
</div>
</header>
