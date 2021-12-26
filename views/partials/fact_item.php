<div class="accordion-item">
    <h2 class="accordion-header" id="fact_<?= $fact->getId(); ?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#factBody_<?= $fact->getId(); ?>" aria-expanded="false" aria-controls="factBody_<?= $fact->getId(); ?>">
            <?= ucfirst($fact->getType()); ?> Fact ID: 
            <?= $fact->getId() . ', created at: ' . $fact->getCreatedAt()->format('d.m.Y, H:i'); ?>
        </button>
    </h2>
    <div id="factBody_<?= $fact->getId(); ?>" class="accordion-collapse collapse" aria-labelledby="fact_<?= $fact->getId(); ?>" data-bs-parent="#factList">
        <div class="accordion-body">
            <div>
                <?= $fact->getText(); ?>
            </div>
            <div>
                <a href="?id=<?= $fact->getId(); ?>">
                    View details
                </a>
            </div>
        </div>
    </div>
</div>