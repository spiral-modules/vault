<dark:extends path="vault:layout" title="Dashboard"/>

<block:content>
    <div class="row">
        <div class="col s6">
            <vault:card color="blue darken-2" text="white" title="Welcome to Vault">
                This view file located in 'vault/views/dashboard.dark.php' and rendered by default
                'DashboardController', simply alter vault config to connect your own controller and
                template.
            </vault:card>

            <vault:card color="green darken-2" text="white" title="Configuring">
                You can register additional vault controllers by altering configuration file located
                in 'app/config/modules/vault.php'.
            </vault:card>

            <vault:card title="Links and Routing:">
                Following technique can be used to create
                <vault:uri href="dashboard">in-Vault</vault:uri>
                links:
                <br/>
                <code>
                    &lt;vault:uri href="dashboard:index"&gt;in-Vault&lt;/vault:uri&gt;
                </code>
            </vault:card>
        </div>

        <div class="col s6">
            <vault:card title="Views and layouts">
                You can make your controller work in vault layout by simply extending "vault:layout"
                parent in your view file. Following blocks and definitions available for you:

                <dl>
                    <dt>title</dt>
                    <dd>Page title</dd>

                    <dt>content</dt>
                    <dd>Page content</dd>

                    <dt>content-title</dt>
                    <dd>On page title (by default same as title)</dd>

                    <dt>actions</dt>
                    <dd>Page specific actions/buttons (at the same line as content title)</dd>

                    <dt>brand</dt>
                    <dd>Page/layout specific brand information (logotype and link)</dd>

                    <dt>resources</dt>
                    <dd>Page/layout specific resources</dd>
                </dl>
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
