<?php #compile
$this->runtimeVariable('_uri_parameters_', '${parameters}${data}${options}');
?>
<?php
/**
 * @var mixed $_uri__parameters_
 */
$uri = vault()->uri(
    '${href}${target}',
    !empty($_uri_parameters_) ? $_uri_parameters_ : []
)->withFragment('${fragment}${section}${segment}');
?>
<a href="<?= (string)$uri ?>" node:attributes><?php #compile
    //Render link icon, but only if specified
    ob_start(); ?>${icon}<?php #compile
    if (!empty(ob_get_clean())) {
        ?><i class="material-icons ${icon-size|tiny}">${icon}</i><?php #compile
    }
    ?>${context}<?php #compile
    //Render after link icon, but only if specified
    ob_start(); ?>${post-icon}<?php #compile
    if (!empty(ob_get_clean())) {
        ?><i class="material-icons ${post-icon-size|tiny}">${post-icon}</i><?php #compile
    }
    ?></a>