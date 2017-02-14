<?php #compile
//Extract from attribute permission="do-something"
$this->runtimeVariable('permission', '${permission}');
?><?php
/** @var string $permission */
if (spiral(\Spiral\Security\GuardInterface::class)->allows($permission)) { ?>${context}<?php } ?>
