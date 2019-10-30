<dark:use bundle="spiral:bundle"/>
<dark:use bundle="vault:bundle"/>

<vault:block title="${title}" node:attributes="prefix:block">
    <spiral:form action="${action}" node:attributes="exclude:block-*">
        ${context}
    </spiral:form>
</vault:block>