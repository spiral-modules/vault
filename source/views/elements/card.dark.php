<?php #compile
$this->evaluatorVariable('__title__', '${title}');
if (!empty($__title__)) { ?><p class="card-panel-title">${title}</p><?php } #compile ?>

<div class="card-panel z-depth-1" node:attributes>
    ${context}
</div>