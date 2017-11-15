<dark:use path="spiral:listing/*" namespace="listing"/>
<dark:use bundle="vault:bundle"/>

<vault:block title="${title}" node:attributes="prefix:block">
    <div class="row">
        <div class="col s12">
            <listing:grid listing="${listing}" as="${as}" empty="${empty|[[No results to be displayed]]}" class="striped">
                ${context}
            </listing:grid>
        </div>
    </div>
</vault:block>
