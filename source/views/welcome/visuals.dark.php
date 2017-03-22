<dark:extends path="vault:layout" title="Vault, Visual Elements"/>
<?php
/**
 * @var \Spiral\Vault\Controllers\Grids\SampleSource $grid
 * @var array                                        $item
 */
?>
<block:content>
    <tab:wrapper>
        <tab:item id="form" title="Sample Form" icon="input">
            <div class="row">
                <div class="col s6">
                    <vault:form action="<?= vault()->uri('welcome:submit') ?>">
                        <form:input label="[[Name:]]" name="name"/>
                        <form:select label="[[Status:]]" name="status" values="<?= [
                            'active'   => 'Active',
                            'disabled' => 'Disabled'
                        ] ?>"/>

                        <input class="btn" type="submit"/>
                    </vault:form>
                </div>

                <div class="col s6">
                    <vault:card color="blue-grey darken-2" text="white">
                        <p>Cards might include descriptions and tooltips for users.</p>
                    </vault:card>
                </div>
            </div>
        </tab:item>

        <tab:item id="info" title="Layout Configuration" icon="picture_in_picture">
            <vault:card title="Views and Layouts">
                You can make your controller work in vault layout by simply extending "vault:layout"
                parent in your view file. Following blocks and definitions available for you:

                <vault:info>
                    <vault:line name="title">
                        Page Title
                    </vault:line>

                    <vault:line name="content">
                        Page Content
                    </vault:line>

                    <vault:line name="content-title">
                        On page title (by default same as title)
                    </vault:line>

                    <vault:line name="actions">
                        Page specific actions/buttons (at the same line as content title)
                    </vault:line>

                    <vault:line name="brand">
                        Page/layout specific brand information (logotype and link)
                    </vault:line>

                    <vault:line name="styles">
                        Page/layout specific styles
                    </vault:line>

                    <vault:line name="scripts">
                        Page/layout specific scripts
                    </vault:line>
                </vault:info>
                <br/>
                <i>
                    You can also overwrite default vault layout by registering namespace directory
                    (under "vault") and redefining "vault:layout" file with custom colors, logotypes
                    and resources.
                </i>
                <br/>
                Add class="wide-content" to parent layout to remove page width constrain.
            </vault:card>
        </tab:item>

        <tab:item id="grid" title="Grids and Paginators" icon="list">
            <vault:grid source="<?= $grid ?>" as="item">
                <grid:cell label="ID:" value="<?= $item['id'] ?>"/>
                <grid:cell.bool label="Active:" value="<?= $item['active'] ?>"/>
                <grid:cell label="Name:" value="<?= $item['name'] ?>"/>
                <grid:cell.number label="Balance:" value="<?= $item['balance'] ?>"/>
            </vault:grid>
        </tab:item>
        <tab:item id="Elements" title="Elements" icon="list">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header"><span class="new badge">4</span><i class="material-icons">filter_drama</i>First</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li>
                <li>
                    <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">place</i>Second</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li>
            </ul>
        </tab:item>
    </tab:wrapper>
</block:content>
