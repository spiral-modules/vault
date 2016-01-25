<dark:extends path="vault:layouts.html5"/>

<!--Vault elements such as panels, grids and tabs-->
<dark:use bundle="spiral:bundle"/>
<dark:use bundle="vault:bundle"/>

<!--Vault layout partials-->
<dark:use path="vault:partials/*" namespace="vault.partials"/>

<!--Vault specific view functions-->
<block:functions>
    <?php
    if (!function_exists('vault')) {
        /**
         * @return \Spiral\Vault\Vault
         */
        function vault()
        {
            return spiral(\Spiral\Vault\Vault::class);
        }
    }
    ?>
</block:functions>

<!--You can change following resources by redefining vault:vault layout-->
<block:resources>
    <asset:css href="https://fonts.googleapis.com/icon?family=Material+Icons"/>

    <asset:css href="resources/styles/spiral/spiral.css"/>
    <asset:css href="resources/styles/spiral/vault/vault.css"/>

    <asset:javascript href="resources/vendor/jquery-2.2.0.min.js"/>
    <asset:javascript href="resources/vendor/materialize.min.js"/>

    <asset:javascript href="resources/scripts/spiral/sf.js"/>
    <asset:javascript href="resources/scripts/spiral/vault.js"/>
</block:resources>

<!--Primary page content-->
<block:body>
    <div class="navbar-fixed">
        <nav class="nav-header">
            <div class="nav-wrapper">
                <div class="logo-block">
                    <block:brand>
                        <a href="/" class="brand-logo">
                            <img src="@{basePath}resources/images/spiral.svg" alt="Spiral">
                        </a>
                    </block:brand>
                </div>
                <div class="top-panel">
                    <div class="hide-on-large-only">
                        <a href="#" data-activates="nav-mobile" class="menu-link button-collapse">
                            <b class="line-1"></b>
                            <b class="line-2"></b>
                            <b class="line-3"></b>
                        </a>
                    </div>
                </div>
            </div>

            <div class="user-block">
                <block:user-block/>
            </div>
        </nav>
    </div>

    <block:navigation>
        <vault.partials:navigation navigation-head="${navigation-head}"/>
    </block:navigation>

    <block:main>
        <main class="main-part ${class}">
            <div class="container">
                <div class="head-part">
                    <div class="row">
                        <div class="col s12">
                            <block:content-header>
                                <h1 align="left">
                                    <block:content-title>${title}</block:content-title>
                                </h1>
                                <div class="link-block right">
                                    <yield:actions/>
                                </div>
                            </block:content-header>
                        </div>
                    </div>
                </div>

                <yield:content/>
            </div>
        </main>
    </block:main>
</block:body>
