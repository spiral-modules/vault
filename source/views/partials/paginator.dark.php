<?php #compile
//todo: show first and last pages

//Let's create php variable to represent paginator
$this->runtimeVariable('__paginator__', '${paginator}${source}${list}');

//How many pages to show before and after current page
$this->runtimeVariable('__pageLimit__', '${pageLimit|2}');
?><?php
if (empty($__pageLimit__)) {
    /*
     * Default page limit (pages to show before and after current one)
     */
    $__pageLimit__ = 2;
}

if ($__paginator__ instanceof \Spiral\Pagination\PaginatorAwareInterface) {
    $__paginator__ = $__paginator__->isPaginated() ? $__paginator__->paginator() : null;
}

if (
    !empty($__paginator__)
    && $__paginator__ instanceof \Spiral\Pagination\PredictableInterface
    && $__paginator__->isRequired()
) { ?>
    <div class="paginator">
        <ul class="pagination" node:attributes>
            <?php
            if (!empty($pageNumber = $__paginator__->previousPage())) {
                $__uri__ = $__paginator__->uri($pageNumber);
                echo "<li class=\"waves-effect\"><a href=\"{$__uri__}\"><i class=\"material-icons\">chevron_left</i></a></li>";
            } else {
                echo "<li class=\"disabled\"><a href=\"javascript:return false;\"><i class=\"material-icons\">chevron_left</i></a></li>";
            }

            //Resolving page limit to be shown
            $__current__ = $__paginator__->getPage();

            //First page to be shown
            $__first__ = max($__current__ - $__pageLimit__, 1);

            //Last page to be shown
            $__last__ = min($__current__ + $__pageLimit__, $__paginator__->countPages());

            if ($__first__ != 1) {
                //Just a placeholder
                echo "<li class=\"waves-effect\"><a>...</a></li>";
            }

            for ($__page__ = $__first__; $__page__ <= $__last__; $__page__++) {
                $__uri__ = $__paginator__->uri($__page__);

                if ($__page__ == $__current__) {
                    echo "<li class=\"active waves-effect ${color}\"><a href=\"{$__uri__}\">{$__page__}</a></li>";
                } else {
                    echo "<li class=\"waves-effect\"><a href=\"{$__uri__}\">{$__page__}</a></li>";
                }
            }

            if ($__last__ != $__paginator__->countPages()) {
                echo "<li class=\"waves-effect\"><a>...</a></li>";
            }

            if (!empty($pageNumber = $__paginator__->nextPage())) {
                $__uri__ = $__paginator__->uri($pageNumber);
                echo "<li class=\"next waves-effect\"><a href=\"{$__uri__}\"><i class=\"material-icons\">chevron_right</i></a></li>";
            } else {
                echo "<li class=\"disabled\"><a href=\"javascript:return false;\"><i class=\"material-icons\">chevron_right</i></a></li>";
            }
            ?>
        </ul>
    </div>
<?php } ?>