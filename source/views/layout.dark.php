<dark:extends path="vault:layouts/root"/>
<dark:use path="vault:layouts/navigation" as="vault:navigation"/>

<define:brand>
    <a href="/" class="brand-logo">
        <img src="@{basePath}resources/images/spiral.svg" alt="Spiral Vault">
    </a>
</define:brand>

<!--You can replace this block to render project specific actor-->
<define:user-block>
    <a href="#" class="user-link">
        <?= get_class(spiral(\Spiral\Security\ActorInterface::class)) ?>
    </a>
    <a href="#" class="user-logout hide">[[Log Out]]</a>
</define:user-block>

<block:navigation>
    <div id="nav-mobile" class="side-nav fixed navigation">
        <vault:navigation/>
    </div>
</block:navigation>
