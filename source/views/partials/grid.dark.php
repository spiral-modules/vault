<dark:use bundle="spiral:bundle"/>
<dark:use bundle="vault:bundle"/>

<vault:block title="${title}" node:attributes="prefix:block">
    <spiral:grid source="${source}" as="${as}" class="${class|striped responsive-table}"
                 paginator="" empty="${empty|No results to be displayed}"
                 empty-class="${empty-class|center}">
        ${context}
    </spiral:grid>
</vault:block>

<vault:paginator source="${source}"/>