<?php #compile

/*
 * Let collect every tab item defined inside tab content.
 */
$__tabHeaders__ = [];
$__tabContent__ = [];

//Collecting tab headers and content
ob_start(); ?>${context}<?php ob_get_clean(); #compile
?>
<ul class="tabs z-depth-1 ${class}">
    <?php #compile
    foreach ($__tabHeaders__ as $__header__) {
        echo $__header__;
    }
    ?>
</ul>
<?php #compile
echo join("\n", $__tabContent__);
?>
