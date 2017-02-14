<?php #compile
$this->runtimeVariable('__uri__parameters__', '${parameters}${data}${options}');
?>
<?php
/**
 * @var mixed $__uri__parameters__
 */
$uri = vault()->uri(
    '${href}${target}',
    !empty($__uri__parameters__) ? $__uri__parameters__ : []
)->withFragment('${fragment}${section}${segment}');
?>
<a href="<?= (string)$uri ?>" class="js-vault-confirm ${class}" data-confirm="${confirm|Are you sure?}" node:attributes="exclude:class">
    <?php #compile
    ob_start(); ?>${icon}<?php #compile
    if (!empty(ob_get_clean())) { ?><i class="material-icons ${icon-size|tiny}">${icon}</i><?php } #compile ?>${context}<?php #compile
    ob_start(); ?>${post-icon}<?php #compile
    if (!empty(ob_get_clean())) { ?><i class="material-icons ${post-icon-size|tiny}">${post-icon}</i><?php } #compile ?>
</a>