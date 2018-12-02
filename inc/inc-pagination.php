<div class="row">
    <div class="col-12">
        <ul class="pagination">
            <?php if ($get_products->curpage != $get_products->startpage) { ?>
                <li class="page-item ">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht?p=<?php echo $get_products->startpage . $get_products->filter_pagination_adds; ?>" target="_self">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </li>
            <?php } ?>
            <?php if ($get_products->curpage >= 2) { ?>
                <li class="page-item">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht?p=<?php echo $get_products->previouspage . $get_products->filter_pagination_adds; ?>" target="_self"><?php echo $get_products->previouspage; ?></a>
                </li>
            <?php } ?>
            <li class="page-item">
                <a class="button button-primary" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht?p=<?php echo $get_products->curpage . $get_products->filter_pagination_adds; ?>" target="_self"><?php echo $get_products->curpage; ?></a>
            </li>
            <?php if ($get_products->curpage != $get_products->endpage) { ?>
                <li class="page-item ">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht?p=<?php echo $get_products->nextpage . $get_products->filter_pagination_adds; ?>" target="_self"><?php echo $get_products->nextpage; ?></a>
                </li>
            <?php } ?>
            <?php if ($get_products->curpage != $get_products->endpage) { ?>
                <li class="page-item">
                    <a class="button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht?p=<?php echo $get_products->endpage . $get_products->filter_pagination_adds; ?>" target="_self">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <p class="pagination_totals">
            Seite <span><?php echo $get_products->curpage; ?></span> von <span><?php echo $get_products->endpage; ?></span> Seiten.
            Gesamtergebnisse : <span><?php echo $get_products->total_res; ?></span>.
        </p>
    </div>
</div>
