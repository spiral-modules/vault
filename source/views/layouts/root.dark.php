<dark:extends path="vault:layouts.html5"/>

<!--Vault elements such as panels, grids and tabs-->
<dark:use bundle="spiral:bundle"/>
<dark:use bundle="vault:bundle"/>

<!--You can change following resources by redefining vault:vault layout-->
<block:styles>
    <asset:style href="https://fonts.googleapis.com/icon?family=Material+Icons"/>

    <asset:style src="/resources/styles/spiral/spiral.css"/>
    <asset:style href="/resources/styles/spiral/vault/vault.css"/>
</block:styles>

<block:scripts>
    <asset:script href="/resources/vendor/jquery-2.2.0.min.js"/>
    <asset:script href="/resources/vendor/materialize.min.js"/>

    <asset:script href="/resources/scripts/spiral/sf.js"/>
    <asset:script href="/resources/scripts/spiral/sf.locker.js"/>
    <asset:script href="/resources/scripts/spiral/sf.form.js"/>
    <asset:script href="/resources/scripts/spiral/sf.input.js"/>
    <asset:script href="/resources/scripts/spiral/sf.date.js"/>
    <asset:script href="/resources/scripts/spiral/sf.datetime.js"/>
    <asset:script href="/resources/scripts/spiral/sf.fileinput.js"/>

    <asset:script href="/resources/scripts/spiral/vault.js"/>
    <asset:script href="/resources/scripts/sf.listing.js"/>
</block:scripts>

<!--Primary page content-->
<block:body>
    <div class="navbar-fixed">
        <nav class="nav-header">
            <div class="nav-wrapper">
                <div class="logo-block">
                    <block:brand/>
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

    <block:navigation/>

    <block:main>
        <main class="main-part ${class}">
            <div class="container">
                <define:content-header>
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
                </define:content-header>
                <yield:content/>
            </div>
        </main>
    </block:main>
</block:body>
