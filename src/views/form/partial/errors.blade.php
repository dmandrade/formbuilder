<?php if ($showError && isset($errors)): ?>
<?php foreach ($errors as $err): ?>
<div <?= $options['errorAttrs'] ?>><?= $err ?></div>
<?php endforeach; ?>
<?php endif; ?>