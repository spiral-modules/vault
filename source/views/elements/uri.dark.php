<?php #compile
$this->runtimeVariable('__uri__parameters__', '${parameters}${data}${options}');
?>
<?php
/**
 * @var mixed $__uri__parameters__
 */
$uri = vault()->uri(
    '${href}${target}',
    $__uri__parameters__
)->withFragment('${fragment}${section}${segment}');
?>
<a href="<?= (string)$uri ?>" node:attributes>
    <?php #compile
    ob_start(); ?>${icon}<?php #compile
    if (!empty(ob_get_clean())) { ?><i class="material-icons ${icon-size|tiny}">${icon}</i><?php } #compile ?>${context}
</a>