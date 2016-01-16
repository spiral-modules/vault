<?php #compile
ob_start(); ?>${title}<?php #compile
if (!empty(ob_get_clean())) { ?><p class="card-panel-title">${title}</p><?php } #compile ?>
<div class="card-panel z-depth-1" node:attributes>
    ${context}
</div>