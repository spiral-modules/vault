# Albus - Work in Progress (only visual layer has been built at this moment)
Extendable and customizable admin panel.

```html
<extends:albus:layout title="[[Albus]]"/>

<block:content>
    <tab:wrapper>

        <!--Primary information about user account-->
        <tab:item title="User Information" icon="user" id="info">
            <div class="row">
                <div class="col s6">
                    <albus:block>
                        <spiral:form>
                            <form:input label="abc"/>
                        </spiral:form>
                    </albus:block>
                </div>

                <div class="col s6">
                    <albus:card color="blue-grey darken-2" text="white">
                        <p>There is an issue with something.</p>
                    </albus:card>
                </div>
            </div>
        </tab:item>

        <!--Additional information about user account-->
        <tab:item title="Extra Information" id="extra">
            extra user information
        </tab:item>

        <!--Test user content-->
        <tab:item title="test" id="test">
            test
        </tab:item>

    </tab:wrapper>
</block:content>
```

Following code will be compiled into Materialize based HTML:

![Screenshot](http://i.imgur.com/5R8j5lZ.png)
![Animation](https://raw.githubusercontent.com/spiral/guide/master/resources/albus.gif)
