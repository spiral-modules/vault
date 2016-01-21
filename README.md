# Vault 
Vault administration panel provides ability to create custom "administration" controllers with pre-created view layout and navigation manager based on set of Materialize styles.

Elements included
-----------------
* In-Vault uri tag
* Cards and Blocks
* Materialize Paginator
* Grids
* Tabs

```html
<extends:vault:layout title="[[Vault]]"/>

<block:content>
    <tab:wrapper>

        <!--Primary information about user account-->
        <tab:item id="info" title="User Information" icon="user">
            <div class="row">
                <div class="col s6">
                    <vault:block>
                        <spiral:form>
                            <form:input label="abc"/>
                        </spiral:form>
                    </vault:block>
                </div>

                <div class="col s6">
                    <vault:card color="blue-grey darken-2" text="white">
                        <p>There is an issue with something.</p>
                    </vault:card>
                </div>
            </div>
        </tab:item>

        <!--Additional information about user account-->
        <tab:item id="extra" title="Extra Information">
            extra user information <vault:uri target="controller:action">link</vault:uri>
        </tab:item>

    </tab:wrapper>
</block:content>
```

Following code will be compiled into Materialize based HTML:

![Animation](https://raw.githubusercontent.com/spiral/guide/master/resources/albus.gif)

Grids

```php
/**
 * @return string
 */
protected function indexAction(PostsSource $source)
{
    return $this->views->render('admin:posts/list', [
        'posts' => $source->findActive()->paginate(5)
    ]);
}
```

```html
<extends:vault:layout title="Posts"/>
<dark:use bundle="spiral:cropper-bundle"/>

<define:content>
    <vault:grid source="<?= $posts ?>" as="post">
        <grid:cell label="ID:" value="<?= $post->id ?>"/>
        <grid:cell label="Time Created:" value="<?= $post->time_created ?>"/>
        <grid:cell label="Title:" value="<?= $post->title ?>"/>

        <grid:cell.bool label="Published:" value="<?= $post->isPublished() ?>"/>

        <grid:cell style="text-align: right">
            <vault:uri target="posts:edit" options="<?= ['id' => $post->id] ?>"
                       class="waves-effect btn-flat" icon="edit"/>
        </grid:cell>
    </vault:grid>
</define:content>
```

![Grid](https://raw.githubusercontent.com/spiral/guide/master/resources/grid.png)

# Installation

```
composer require spiral/vault
spiral register spiral/vault
```

Do not forget to mount `VaultBootloader` (bootloader has to be initated after `SecutiryBootloader`).

> You can tweak Vault behaviour (route, middlewares), create new navigation sections or register your own controllers via `app/config/modules/vault.php` configuration file.

If you wish to play with Vault without configuring security rules, simply mount `InsecureVaultBootloader` bootloader, attention this bootloader will open Vault access to guest accounts and has to be used for debugging purposes only.

Once installed Vault module will be accessible by a route pattern specified in a related config (default **localhost:8080/vault**).
