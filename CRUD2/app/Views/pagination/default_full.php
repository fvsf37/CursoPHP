<?php if ($pager): ?>
    <nav class="pagination-container" aria-label="Paginación">
        <ul class="pagination">
            <!-- Botón "Primero" -->
            <?php if ($pager->hasPreviousPage()): ?>
                <li><a href="<?= $pager->getFirst() ?>" class="pagination-link">« Primero</a></li>
                <li><a href="<?= $pager->getPreviousPage() ?>" class="pagination-link">‹ Anterior</a></li>
            <?php endif; ?>

            <!-- Páginas numeradas -->
            <?php foreach ($pager->links() as $link): ?>
                <li class="pagination-item <?= $link['active'] ? 'active' : '' ?>">
                    <a href="<?= $link['uri'] ?>" class="pagination-link"><?= $link['title'] ?></a>
                </li>
            <?php endforeach; ?>

            <!-- Botón "Siguiente" -->
            <?php if ($pager->hasNextPage()): ?>
                <li><a href="<?= $pager->getNextPage() ?>" class="pagination-link">Siguiente ›</a></li>
                <li><a href="<?= $pager->getLast() ?>" class="pagination-link">Último »</a></li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>