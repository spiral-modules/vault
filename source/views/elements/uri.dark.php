<?php #compile
$this->runtimeVariable('__uri__parameters__', '${parameters}${data}${options}');
?>
<?php
/**
 * @var mixed $__uri__parameters__
 */
$uri = albus()->uri(
    '${href}${target}',
    $__uri__parameters__
)->withFragment('${fragment}${section}${segment}');
?>
<a href="<?= (string)$uri ?>" node:attributes>
    <?php #compile
    ob_start(); ?>${icon}<?php #compile
    if (!empty(ob_get_clean())) { ?><i class="icon icon-${icon}"></i><?php } #compile ?>${context}
</a>