<?php
if (!empty($_SESSION['alerts'])):
  foreach ($_SESSION['alerts'] as $alert):?>
    <div class="alert alert-<?= htmlspecialchars($alert['type']) ?>">
        <?= htmlspecialchars($alert['text']) ?>
    </div>
<?php
  endforeach;
  unset($_SESSION['alerts']); // ← MUY IMPORTANTE
endif;
?>
