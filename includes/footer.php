<?php
$base = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
?>
<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-col">
      <strong>Shop</strong>
      <a href="<?= $base ?>pages/flowers.php">Find in Store</a>
    </div>
    <div class="footer-col">
      <strong>Contact</strong>
      <a href="tel:+7 999 999 99 99">Phone</a>
      <a href="mailto:flower@flower.com">Email</a>
    </div>
    <div class="footer-col">
      <strong>Help</strong>
      <a href="#">FAQ</a>
    </div>
    <div class="footer-col subscribe-col">
      <strong>Sign up to get <span class="pink">15% off</span> your first order</strong>
      <form method="post" action="<?= $base ?>pages/subscribe.php" class="footer-subscribe">
        <input type="email" name="email" placeholder="Your Email Address" required>
        <button type="submit">Subscribe</button>
      </form>
    </div>
  </div>
  <div class="footer-bottom">
    <a href="<?= $base ?>index.php">www.flower.com</a>
  </div>
</footer>
</body>
</html>
