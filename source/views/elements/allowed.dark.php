<?php #compile
$this->runtimeVariable('permission', '${permission}');
?><?php
/**
 * @var string                          $permission
 * @var \Spiral\Security\GuardInterface $guard
 */
$guard = spiral(\Spiral\Security\GuardInterface::class);
if ($guard->allows($permission)) {
    ob_start(); ?>${context}<?php
    echo ob_get_clean();
}
?>
