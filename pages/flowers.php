<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['wishlist'])) $_SESSION['wishlist'] = [];

include '../data/products.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = intval($_POST['product_id'] ?? 0);
    if ($action === 'add_to_cart' && $id && isset($products[$id])) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    if ($action === 'add_to_wishlist' && $id) {
        if (in_array($id, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = array_values(array_filter($_SESSION['wishlist'], fn($x) => $x !== $id));
        } else {
            $_SESSION['wishlist'][] = $id;
        }
    }
    header('Location: flowers.php' . (isset($_GET['q']) ? '?q='.urlencode($_GET['q']) : ''));
    exit;
}

$query = trim($_GET['q'] ?? '');
$filtered = $query
    ? array_filter($products, fn($p) => stripos($p['name'], $query) !== false || stripos($p['desc'], $query) !== false)
    : $products;

include '../includes/header.php';
?>

<main>

<div class="page-content">

<h2 class="page-title">
    Our Bouquets
</h2>

<?php if ($query): ?>

    <p class="search-result-text">

        Results for
        "<strong><?= htmlspecialchars($query) ?></strong>"

    </p>

<?php endif; ?>

<div class="product-grid">

    <?php foreach ($filtered as $p):

        $inWish = in_array(
            $p['id'],
            $_SESSION['wishlist']
        );

    ?>

    <div class="product-card">

        <form
            method="post"
            class="wish-form">

            <input
                type="hidden"
                name="action"
                value="add_to_wishlist">

            <input
                type="hidden"
                name="product_id"
                value="<?= $p['id'] ?>">

            <button
                class="wish-btn <?= $inWish ? 'active' : '' ?>">

                <?= $inWish ? '♥' : '♡' ?>

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
                value="<?= $p['id'] ?>">

            <button
                type="submit"
                class="to-cart-btn">

                To cart

            </button>

        </form>

    </div>

    <?php endforeach; ?>

</div>

</div>

</main>


<?php include '../includes/footer.php'; ?>
