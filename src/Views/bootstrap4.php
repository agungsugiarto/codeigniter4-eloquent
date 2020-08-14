<?php if ($paginator->hasPages()) : ?>
    <nav>
        <ul class="pagination">
            <!-- Previous Page Link -->
            <?php if ($paginator->onFirstPage()) : ?>
                <li class="page-item disabled" aria-disabled="true" aria-label="<?= lang('Pager.previous') ?>">
                    <span class="page-link" aria-hidden="true"><?= lang('Pager.previous') ?></span>
                </li>
            <?php else : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $paginator->previousPageUrl() ?>" rel="prev" aria-label="<?= lang('Pager.previous') ?>"><?= lang('Pager.previous') ?></a>
                </li>
            <?php endif ?>

            <!-- Pagination Elements -->
            <?php foreach ($elements as $element) : ?>
                <!-- "Three Dots" Separator -->
                <?php if (is_string($element)) : ?>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?= $element ?></span></li>
                <?php endif ?>

                <!-- Array Of Links -->
                <?php if (is_array($element)) : ?>
                    <?php foreach ($element as $page => $url) : ?>
                        <?php if ($page == $paginator->currentPage()) : ?>
                            <li class="page-item active" aria-current="page"><span class="page-link"><?= $page ?></span></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="<?= $url ?>"><?= $page ?></a></li>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
            <?php endforeach ?>

            <!-- Next Page Link -->
            <?php if ($paginator->hasMorePages()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $paginator->nextPageUrl() ?>" rel="next" aria-label="<?= lang('Pager.next') ?>"><?= lang('Pager.next') ?></a>
                </li>
            <?php else : ?>
                <li class="page-item disabled" aria-disabled="true" aria-label="<?= lang('Pager.next') ?>">
                    <span class="page-link" aria-hidden="true"><?= lang('Pager.next') ?></span>
                </li>
            <?php endif ?>
        </ul>
    </nav>
<?php endif ?>