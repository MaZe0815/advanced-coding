<div class="row">
    <div class="col-12">
        <ul class="pagination">
            <?php if ($administration->curpage != $administration->startpage) { ?>
                <li class="page-item ">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration?p=<?php echo $administration->startpage . $administration->filter_pagination_adds; ?>" target="_self">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </li>
            <?php } ?>
            <?php if ($administration->curpage >= 2) { ?>
                <li class="page-item">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration?p=<?php echo $administration->previouspage . $administration->filter_pagination_adds; ?>" target="_self"><?php echo $administration->previouspage; ?></a>
                </li>
            <?php } ?>
            <li class="page-item">
                <a class="button button-primary" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration?p=<?php echo $administration->curpage . $administration->filter_pagination_adds; ?>" target="_self"><?php echo $administration->curpage; ?></a>
            </li>
            <?php if ($administration->curpage != $administration->endpage) { ?>
                <li class="page-item ">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration?p=<?php echo $administration->nextpage . $administration->filter_pagination_adds; ?>" target="_self"><?php echo $administration->nextpage; ?></a>
                </li>
            <?php } ?>
            <?php if ($administration->curpage != $administration->endpage) { ?>
                <li class="page-item">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration?p=<?php echo $administration->endpage . $administration->filter_pagination_adds; ?>" target="_self">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <p class="pagination_totals">
            Seite <span><?php echo $administration->curpage; ?></span> von <span><?php echo $administration->endpage; ?></span> Seite<?php if ($administration->endpage > 1) { ?>n<?php } ?>.
            Gesamtergebnisse: <span><?php echo $administration->total_res; ?></span> Artikel.
        </p>
    </div>
</div>
