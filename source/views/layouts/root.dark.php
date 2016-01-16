<dark:extends path="albus:layouts.html5"/>

<!--Albus elements such as panels, grids and tabs-->
<dark:use bundle="spiral:bundle"/>
<dark:use bundle="albus:bundle"/>

<!--Albus layout partials-->
<dark:use path="albus:partials/*" namespace="albus.partials"/>

<!--You can redefine following resources by redefining albus:albus layout-->
<block:resources>
    <asset:css href="https://fonts.googleapis.com/icon?family=Material+Icons"/>

    <asset:css href="resources/styles/spiral/spiral.css"/>
    <asset:css href="resources/styles/spiral/albus/albus.css"/>

    <asset:javascript href="resources/vendor/jquery-2.2.0.min.js"/>
    <asset:javascript href="resources/vendor/materialize.min.js"/>

    <asset:javascript href="resources/scripts/spiral/sf.js"/>
    <asset:javascript href="resources/scripts/spiral/albus.js"/>
</block:resources>


<block:body>
    <albus.partials:header/>
    <albus.partials:navigation/>

    <block:main>
        <main class="main-part">
            <div class="container">
                <albus.partials:content.header content-title="${content-title}"/>
                <yield:content/>
            </div>
        </main>
    </block:main>
</block:body>

<!--Default value for content title is page title-->
<block:content-title>${title}</block:content-title>