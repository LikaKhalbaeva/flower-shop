<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['wishlist'])) $_SESSION['wishlist'] = [];

include '../data/products.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = intval($_POST['product_id'] ?? 0);

    if ($action === 'increase' && $id) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    if ($action === 'decrease' && $id) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 1) - 1;
        if ($_SESSION['cart'][$id] <= 0) unset($_SESSION['cart'][$id]);
    }
    if ($action === 'remove' && $id) {
        unset($_SESSION['cart'][$id]);
    }
    if ($action === 'order') {
        $_SESSION['cart'] = [];
        header('Location: cart.php?ordered=1');
        exit;
    }
    header('Location: cart.php');
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $pid => $qty) {
    if (isset($products[$pid])) $total += $products[$pid]['price'] * $qty;
}
$delivery = $total >= 80 ? 0 : ($total > 0 ? 5 : 0);

include '../includes/header.php';
?>
<main>
<div class="cart-wrap">
<div class="cart-header">
    <h2 class="page-title">
        Your Cart
    </h2>
    <span></span>
</div>
<?php if(empty($_SESSION['cart'])): ?>
    <div class="empty-msg">
        Your cart is empty
        <br><br>
        <a href="flowers.php"
           class="btn-primary">
            Shop Now
        </a>
    </div>

<?php else: ?>
    <div class="cart-table-head">
        <span>Product</span>
        <span>Qty</span>
        <span>Price</span>
        <span>Total</span>
        <span></span>
    </div>

    <?php foreach($_SESSION['cart'] as $pid => $qty):
        if(!isset($products[$pid])) continue;
        $p = $products[$pid];
        $line_total =
            $qty * $p['price'];
    ?>
    <div class="cart-item">
        <div class="cart-item-info">
            <div class="cart-item-emoji">
                <img
                    src="<?= $p['img'] ?>"
                    alt="<?= htmlspecialchars($p['name']) ?>">
            </div>
            <div>
                <div class="cart-item-name">
                    <?= htmlspecialchars($p['name']) ?>
                </div>
                <div class="cart-item-code">
                    FLWR-<?= str_pad(
                        $pid,
                        3,
                        '0',
                        STR_PAD_LEFT
                    ) ?>
                </div>
            </div>
        </div>
        <div class="qty-ctrl">
            <form method="post">
                <input
                    type="hidden"
                    name="action"
                    value="decrease">
                <input
                    type="hidden"
                    name="product_id"
                    value="<?= $pid ?>">
                <button class="qty-btn">
                    −
                </button>
            </form>
            <span class="qty-val">
                <?= $qty ?>
            </span>
            <form method="post">
                <input
                    type="hidden"
                    name="action"
                    value="increase">
                <input
                    type="hidden"
                    name="product_id"
                    value="<?= $pid ?>">
                <button type="submit" class="qty-btn">
                    +
                </button>
            </form>
        </div>
        <span>
            $<?= $p['price'] ?>
        </span>
        <span>
            $<?= $line_total ?>
        </span>
        <form method="post">
            <input
                type="hidden"
                name="action"
                value="remove">
            <input
                type="hidden"
                name="product_id"
                value="<?= $pid ?>">
            <button type="submit"
                class="remove-btn">
                ×
            </button>
        </form>
    </div>
    <?php endforeach; ?>
    <div class="cart-summary">
        <div class="summary-row">
            <span>Total</span>
            <span>
                $<?= number_format($total,2) ?>
            </span>
        </div>
        <div class="summary-row">
            <span>Delivery</span>
            <span>
                $<?= number_format($delivery,2) ?>
            </span>
        </div>
        <div class="summary-row">
            <strong>Grand Total</strong>
            <strong>
                $<?= number_format(
                    $total+$delivery,
                    2
                ) ?>
            </strong>
        </div>
        <form method="post">
            <input
                type="hidden"
                name="action"
                value="order">
            <button type="submit"
                class="order-btn">
                Order Now
            </button>
        </form>
    </div>
<?php endif; ?>
</div>
</main>
<?php include '../includes/footer.php'; ?>