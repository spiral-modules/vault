# Vault 
Vault administration panel provides ability use regular application controllers inside [Security enviroment](https://github.com/spiral-modules/security) with set of pre-created visual elements like grids, tabs, forms and other. 

Vault module is based on a set of [Materialize CSS](http://materializecss.com/) styles.

Elements included
-----------------

In-Vault Uri tag:

```html
<vault:uri target="controller:action" options="<?= ['id' => 123] ?>" icon="icon" class="...">
    label
</vault:uri>
```

Cards and blocks:

```html
<vault:card color="blue-grey darken-2" text="white">
    <p>There is an issue with something.</p>
</vault:card>

<vault:block title="Title">
</vault:block>
```

Forms (ajax):

```html
<vault:form action="<?= vault()->uri('countries:edit', ['id' => $entity->id] ?>">
    <div class="row">
        <div class="col s7">
            <form:input label="[[Country:]]" name="name" value="<?= e($entity->name) ?>"/>
        </div>
        <div class="col s5">
            <form:input label="[[Country Code:]]" name="code" value="<?= e($entity->code) ?>"/>
        </div>
    </div>
    <div class="right-align">
        <input type="submit" value="[[UPDATE]]" class="btn teal waves-effect waves-light"/>
    </div>
</vault:form>
```

![Form](https://raw.githubusercontent.com/spiral/guide/master/resources/vault-form.png)

Tabs:

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

![Animation](https://raw.githubusercontent.com/spiral/guide/master/resources/albus.gif)

Grids:

```php
/**
 * @return string
 */
protected function indexAction(PostsSource $source)
{
    return $this->views->render('admin/posts/list', [
        'posts' => $source->findActive()->paginate(5)
    ]);
}
```

```html
<extends:vault:layout title="Posts"/>

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
