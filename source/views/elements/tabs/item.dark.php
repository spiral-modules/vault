<?php #compile

//Tabulation header.
ob_start();
?>
<li class="tab ${label-class}" node:attributes="prefix:label">
    <a href="#${id}">
        <?php #compile
        ob_start(); ?>${icon}<?php #compile
        if (!empty(ob_get_clean())) { ?><i class="material-icons">${icon}</i><?php } #compile ?>
        ${title}
    </a>
</li>
<?php #compile
$__tabHeaders__[] = ob_get_clean();

//Tabulation body.
ob_start();
?>
<?php $_tab_id_ = '${id}'; ?>
<div class="tab ${class}" id="${id}">
    ${context}
</div>
<?php #compile
$__tabContent__[] = ob_get_clean();
?>