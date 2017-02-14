<dark:extends path="vault:layout" title="Welcome to Vault"/>

<block:content>
    <div class="row">
        <div class="col s6">
            <vault:card color="blue darken-2" text="white" title="Welcome to Vault">
                This view file located in 'vault/views/welcome.dark.php' and rendered by default
                'WelcomeController', simply alter vault config to connect your own controller and
                template.
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
            <vault:card color="green darken-2" text="white" title="Configuring">
                You can register additional vault controllers by altering configuration file located
                in 'app/config/modules/vault.php'.
            </vault:card>
        </div>
    </div>
</block:content>
