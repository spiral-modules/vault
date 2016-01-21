<dark:use bundle="spiral:bundle"/>
<dark:use bundle="vault:bundle"/>

<vault:block title="${title}" node:attributes="prefix:block">
    <spiral:grid source="${source}" as="${as}" class="${class|striped}" paginator="" empty="${empty}">
        ${context}
    </spiral:grid>
</vault:block>

<vault:paginator source="${source}" color="${color}"/>