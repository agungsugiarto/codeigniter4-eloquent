<?php if ($paginator->hasPages()) : ?>
    <nav>
        <ul class="pagination">
            <!-- Previous Page Link -->
            <?php if ($paginator->onFirstPage()) : ?>
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><?= lang('Pager.previous') ?></span>
                </li>
            <?php else : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $paginator->previousPageUrl() ?>" rel="prev"><?= lang('Pager.previous') ?></a>
                </li>
            <?php endif ?>

            <!-- Next Page Link -->
            <?php if ($paginator->hasMorePages()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $paginator->nextPageUrl() ?>" rel="next"><?= lang('Pager.next') ?></a>
                </li>
            <?php else : ?>
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><?= lang('Pager.next') ?></span>
                </li>
            <?php endif ?>
        </ul>
    </nav>
<?php endif ?>