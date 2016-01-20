<div id="nav-mobile" class="side-nav fixed navigation">
    <block:navigation-head/>
    <ul class="collapsible panel-group" data-collapsible="accordion">
        <?php
        $vault = vault();
        foreach ($vault->navigation()->getSections() as $section) {
            if (!$section->isAvailable()) {
                //Section does not contain any available link
                continue;
            }

            $active = $section->hasController($vault->activeController());
            ?>
            <li class="panel">
                <div class="panel-heading collapsible-header <?= $active ? 'active' : '' ?> waves-effect waves-spiral">
                    <i class="material-icons"><?= $section->getIcon() ?></i><?= $vault->translate($section->getTitle()) ?>
                </div>
                <div class="panel-collapse collapsible-body">
                    <div class="panel-body">
                        <div class="menu-list">
                            <?php
                            foreach ($section->getItems() as $item) {
                                $uri = $vault->uri($item->getTarget());
                                $title = $vault->translate($item->getTitle());
                                echo "<a href=\"{$uri}\">{$title}</a>";
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
</div>