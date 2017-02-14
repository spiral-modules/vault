<ul class="collapsible panel-group" data-collapsible="accordion">
    <?php
    $navigation = new \Spiral\Vault\Models\Navigation(
        $vault = vault(),
        spiral(\Psr\Http\Message\ServerRequestInterface::class)
    );

    foreach ($navigation->getSections() as $section) {
        if (!$section->isAvailable()) {
            //Section does not contain any available link
            continue;
        }

        $activeSection = $section->hasController($navigation->getController());

        ?>
        <li class="panel">
            <div class="panel-heading collapsible-header <?= $activeSection ? 'active' : '' ?> waves-effect waves-spiral">
                <i class="material-icons"><?= $section->getIcon() ?></i><?= $section->getTitle() ?>
            </div>
            <div class="panel-collapse collapsible-body">
                <div class="panel-body">
                    <div class="menu-list">
                        <?php
                        foreach ($section->getItems() as $item) {
                            if (!$item->isVisible()) {
                                continue;
                            }

                            echo "<a href=\"{$item->getUri()}\">{$item->getTitle()}</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }
    ?>
</ul>