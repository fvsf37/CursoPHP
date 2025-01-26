<?php if ($pager): ?>
    <nav class="pagination">
        <ul>
            <!-- Botón "Anterior" -->
            <?php if ($pager->hasPreviousPage()): ?>
                <li><a href="<?= $pager->getPreviousPage() ?>">« Anterior</a></li>
            <?php endif; ?>

            <!-- Páginas numeradas -->
            <?php foreach ($pager->links() as $link): ?>
                <li <?= $link['active'] ? 'class="active"' : '' ?>>
                    <a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
                </li>
            <?php endforeach; ?>

            <!-- Botón "Siguiente" -->
            <?php if ($pager->hasNextPage()): ?>
                <li><a href="<?= $pager->getNextPage() ?>">Siguiente »</a></li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>