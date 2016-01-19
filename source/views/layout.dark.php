<dark:extends path="albus:layouts/root"/>

<define:brand>
    <a href="/" class="brand-logo">
        <img src="@{basePath}resources/images/spiral.svg" alt="Spiral">
    </a>
</define:brand>

<!--Following resources block can be redefined on a project basis-->
<define:resources>
    <block:resources/>
</define:resources>

<!--You can replace this block to render project specific actor-->
<define:user-block>
    <a href="#" class="user-link">
        <?= get_class(spiral(\Spiral\Security\ActorInterface::class)) ?>
    </a>
    <a href="#" class="user-logout hide">[[Log Out]]</a>
</define:user-block>