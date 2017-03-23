<dark:extends path="vault:layout" title="Vault, Visual Elements"/>
<?php
/**
 * @var \Spiral\Vault\Controllers\Grids\SampleSource $grid
 * @var array $item
 */
?>

<block:scripts>
    <block:scripts/>
    <script>
        $(document).ready(function () {
            $('.modal').modal();
            $('.carousel.carousel-slider').carousel({fullWidth: true});
        });
    </script>
</block:scripts>
<block:content>
    <tab:wrapper>
        <tab:item id="form" title="Sample Form" icon="input">
            <div class="row">
                <div class="col s6">
                    <vault:form action="<?= vault()->uri('welcome:submit') ?>">
                        <form:input label="[[Name:]]" name="name"/>
                        <form:select label="[[Status:]]" name="status" values="<?= [
                            'active' => 'Active',
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
                    <div class="collapsible-header"><span class="new badge">4</span><i class="material-icons">filter_drama</i>First
                    </div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li>
                <li>
                    <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">place</i>Second
                    </div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li>
            </ul>
            <a class="waves-effect waves-light btn">button</a>
            <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>button</a>
            <a class="waves-effect waves-light btn"><i class="material-icons right">cloud</i>button</a>
            <div class="fixed-action-btn horizontal click-to-toggle">
                <a class="btn-floating btn-large red">
                    <i class="material-icons">menu</i>
                </a>
                <ul>
                    <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
                    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
                    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
                    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
                </ul>
            </div>
            <div>
                <br>
                <a class="btn amber darken-2" onclick="Materialize.toast('I am a toast', 4000)">Toast!</a>
            </div>
            <div>
                <br>
                <!-- Dropdown Trigger -->
                <a class='dropdown-button btn pink lighten-2' href='#' data-activates='dropdown1'>Drop Me!</a>

                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!">one</a></li>
                    <li><a href="#!">two</a></li>
                    <li class="divider"></li>
                    <li><a href="#!">three</a></li>
                    <li><a href="#!"><i class="material-icons">view_module</i> four</a></li>
                    <li><a href="#!"><i class="material-icons">cloud</i> five</a></li>
                </ul>
            </div>
            <div>
                <br>
                <!-- Modal Trigger -->
                <a class="modal-trigger waves-effect waves-light btn  green lighten-1" href="#modal1">Modal</a>

                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Modal Header</h4>
                        <p>A bunch of text</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="carousel carousel-slider">
                <a class="carousel-item" href="#one!"><img src="http://lorempixel.com/800/400/food/1"></a>
                <a class="carousel-item" href="#two!"><img src="http://lorempixel.com/800/400/food/2"></a>
                <a class="carousel-item" href="#three!"><img src="http://lorempixel.com/800/400/food/3"></a>
                <a class="carousel-item" href="#four!"><img src="http://lorempixel.com/800/400/food/4"></a>
            </div>

            <vault:form action="#" title="Form Demo">
                <form:input label="[[Input:]]" name="input" />
                <form:textarea label="[[Textarea:]]" name="textarea" value=""/>
                <form:select label="[[Select:]]" name="select" values="<?= [l('No'), l('Yes')] ?>"/>
                <div class="right-align">
                    <input type="submit" value="${submit|[[SAVE]]}" class="btn teal waves-effect waves-light"/>
                </div>
            </vault:form>
        </tab:item>
    </tab:wrapper>
</block:content>
