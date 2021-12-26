<div class="alert alert-danger" role="alert">
  <?= $exception->getMessage(); ?>
</div>
<pre><?= $exception->getTraceAsString(); ?></pre>
<?php if ($exception->getPrevious()): ?>
<h3>Previous exception</h3>
<?= $this->render('error/exception', ['exception' => $exception->getPrevious()]); ?>
<?php endif; ?>
