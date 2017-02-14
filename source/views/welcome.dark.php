<dark:extends path="vault:layout" title="Dashboard" class="wide-content"/>

<block:content>
    <div class="row">
        <div class="col s6">
            <vault:card color="blue darken-2" text="white" title="Welcome to Vault">
                This view file located in 'vault/views/welcome.dark.php' and rendered by default
                'WelcomeController', simply alter vault config to connect your own controller and
                template.
            </vault:card>

            <vault:card color="green darken-2" text="white" title="Configuring">
                You can register additional vault controllers by altering configuration file located
                in 'app/config/modules/vault.php'.
            </vault:card>

            <vault:guard permission="vault.welcome.routing">
                <vault:card title="Links and Routing:">
                    Following technique can be used to create
                    <vault:uri href="welcome">in-Vault</vault:uri>
                    links:
                    <br/>
                    <code>
                        &lt;vault:uri href="welcome"&gt;in-Vault&lt;/vault:uri&gt;
                    </code>
                </vault:card>
            </vault:guard>
        </div>

        <div class="col s6">
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
        </div>
    </div>
</block:content>
