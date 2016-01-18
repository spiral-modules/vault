<dark:extends path="albus:layout" title="Dashboard"/>

<block:content>
    <div class="row">
        <div class="col s6">
            <albus:card color="blue darken-2" text="white" title="Welcome to Albus">
                This view file located in 'albus/views/dashboard.dark.php' and rendered by default
                'DashboardController', simply alter albus config to connect your own controller and
                template.
            </albus:card>

            <albus:card color="green darken-2" text="white" title="Configuring">
                You can register additional albus controllers by altering configuration file located
                in 'app/config/modules/albus.php'.
            </albus:card>

            <albus:card title="Links and Routing:">
                Following technique can be used to create
                <albus:uri href="dashboard" icon="label">in-Albus</albus:uri>
                links:
                <br/>
                <code>
                    &lt;albus:uri href="dashboard:index"&gt;in-Albus&lt;/albus:uri&gt;
                </code>
            </albus:card>
        </div>

        <div class="col s6">
            <albus:card title="Views and layouts">
                You can make your controller work with albus layout by simply extending "albus:layout"
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

                    <dt>logotype</dt>
                    <dd>Page/layout specific logotype</dd>

                    <dt>resources</dt>
                    <dd>Page/layout specific resources</dd>
                </dl>
                <br/>
                <i>
                    You can also overwrite default albus layout by registering namespace directory
                    (under "albus") and redefining "albus:layout" file with custom colors, logotypes
                    and resources.
                </i>
            </albus:card>
        </div>
    </div>
</block:content>