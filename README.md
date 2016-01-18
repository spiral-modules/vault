# Albus 
Albus administration panel provides ability to create custom "administration" controllers with pre-created view layout and navigation manager based on set of Materialize styles.

Elements included
-----------------
* In-Albus uri tag
* Cards and blocks
* Tabs

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
            extra user information <albus:uri taget="controller:action">link</albus:uri>
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

# Installation

```
composer require spiral/albus
spiral register spiral/albus
```

Do not forget to mount `AlbusBootloader` (bootloader has to be initated after `SecutiryBootloader`).

> You can tweak Albus behaviour (route, middlewares), create new navigation sections or register your own controllers using `app/config/modules/albus.php` configuration file.

If you wish to play with albus without configuring security simply mount `Spiral\Albus\Bootloaders\InsecureAlbusBootloader` bootloader, attention this bootloader will open Albus access to guest accounts.
