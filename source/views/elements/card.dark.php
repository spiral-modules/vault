<div class="card spiral ${color|white}" node:attributes>
    <div class="card-content ${text|black}-text">
        <?php #compile
        ob_start(); ?>${title}<?php #compile
        if (!empty(ob_get_clean())) { ?><div class="card-title">${title}</div><?php } #compile ?>
        ${context}
    </div>
</div>