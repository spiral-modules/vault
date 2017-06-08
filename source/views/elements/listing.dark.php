<dark:use path="spiral:listing/*" namespace="listing"/>
<dark:use bundle="vault:bundle"/>

<vault:block title="${title}" node:attributes="prefix:block">
    <listing:grid listing="${listing}" as="${as}" empty="${empty|[[No results to be displayed]]}" class="striped">
        ${context}
    </listing:grid>
</vault:block>