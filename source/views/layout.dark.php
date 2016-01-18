<dark:extends path="albus:layouts/root"/>

<!--Following resources block can be redefined on a project basis-->
<block:resources>
    <block:resources/>
</block:resources>

<!--You can replace this block to render project specific actor-->
<block:user-block>
    <a href="#" class="user-link">
        <?= get_class(spiral(\Spiral\Security\ActorInterface::class)) ?>
    </a>
    <a href="#" class="user-logout hide">[[Log Out]]</a>
</block:user-block>