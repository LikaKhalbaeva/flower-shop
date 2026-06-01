<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['wishlist'])) $_SESSION['wishlist'] = [];

include '../data/products.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = intval($_POST['product_id'] ?? 0);

    if ($action === 'add_to_cart' && $id) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    if ($action === 'remove_wish' && $id) {
        $_SESSION['wishlist'] = array_values(array_filter($_SESSION['wishlist'], fn($x) => $x !== $id));
    }
    if ($action === 'move_all') {
        foreach ($_SESSION['wishlist'] as $wid) {
            $_SESSION['cart'][$wid] = ($_SESSION['cart'][$wid] ?? 0) + 1;
        }
        $_SESSION['wishlist'] = [];
        header('Location: wishlist.php?moved=1');
        exit;
    }
    header('Location: wishlist.php');
    exit;
}

include '../includes/header.php';
?>

<main>
<div class="wishlist-wrap">
<div class="cart-header">
    <h2 class="page-title" aligan="center">
        Wishlist
    </h2>
    <span></span>
</div>
<?php if(empty($_SESSION['wishlist'])): ?>
    <div class="empty-msg">
        Your wishlist is empty
        <br><br>
        <a
            href="flowers.php"
            class="btn-primary">
            Browse Flowers
        </a>
    </div>
<?php else: ?>
    <div class="wish-grid">
        <?php foreach($_SESSION['wishlist'] as $pid):
            if(!isset($products[$pid])) continue;
            $p = $products[$pid];
        ?>
        <div class="product-card">
            <form
                method="post"
                class="wish-form">
                <input
                    type="hidden"
                    name="action"
                    value="remove_wish">
                <input
                    type="hidden"
                    name="product_id"
                    value="<?= $pid ?>">
                <button
                    class="wish-btn active">
                    ♥
                </button>
            </form>
            <div class="product-emoji">
                <img
                    src="<?= $p['img'] ?>"
                    alt="<?= htmlspecialchars($p['name']) ?>">
            </div>
            <div class="product-price">
                $<?= $p['price'] ?>
            </div>
            <form
                method="post"
                class="card-cart-form">
                <input
                    type="hidden"
                    name="action"
                    value="add_to_cart">
                <input
                    type="hidden"
                    name="product_id"
                    value="<?= $pid ?>">
                <button
                    class="to-cart-btn">
                    To cart
                </button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
    <form method="post">
        <input
            type="hidden"
            name="action"
            value="move_all">
        <button
            class="move-all-btn">
            Move all to cart
        </button>
    </form>
<?php endif; ?>
</div>
</main>
<?php include '../includes/footer.php'; ?>