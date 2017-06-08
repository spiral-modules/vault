<dark:use path="spiral:listing/*" namespace="listing"/>
<dark:use bundle="vault:bundle"/>

<listing:form listing="<?= $listing ?>">
    <div class="row">
        <div class="col s10">
            <listing:filter>
                <form:input name="search" placeholder="${placeholder}"/>
            </listing:filter>
        </div>
        <div class="col s2">
            <div class="right-align">
                <listing:reset/>
            </div>
        </div>
    </div>
</listing:form>