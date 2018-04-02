<?php #compile
$this->runtimeVariable('permission', '${permission}');
$this->runtimeVariable('arguments', '${arguments}');
?><?php
/**
 * @var string                          $permission
 * @var \Spiral\Security\GuardInterface $guard
 */
$guard = spiral(\Spiral\Security\GuardInterface::class);
if ($guard->allows($permission, $arguments ?: [])) {
    ob_start(); ?>${context}<?php
    echo ob_get_clean();
}
?>
