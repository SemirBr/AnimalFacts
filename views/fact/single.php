<?php

/** @var App\Model\Fact $fact */

?>
<dl>
    <dt>ID:</dt>
    <dd><?= $fact->getId(); ?></dd>
    <dt>Status:</dt>
    <dd><?= ($fact->getStatus()->isVerified()) ? 'Verified' : 'Not verified'; ?></dd>
    <dt>Animal:</dt>
    <dd><?= $fact->getType(); ?></dd>
    <dt>Fact text:</dt>
    <dd><?= $fact->getText(); ?></dd>
    <!--<?//php if ($fact->getAuthor()): ?>
   <!-- <dt>Author:</dt>
    <dd>
     <img src=" //<//?= $fact->getAuthor()->getPhoto(); ?>" />
        //<//?= $fact->getAuthor()->getFullName(); ?></dd> 
    <?//php endif; ?>-->
    <dt>Created:</dt>
    <dd><?= $fact->getCreatedAt()->format('d.m.Y, H:i'); ?></dd>
    <?php if ($fact->getUpdatedAt()): ?>
    <dt>Created:</dt>
    <dd><?= $fact->getUpdatedAt()->format('d.m.Y, H:i'); ?></dd>
    <?php endif; ?>
</dl>