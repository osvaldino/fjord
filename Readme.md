# Fjord

## Installation

Install this package using the following commands:

```bash
composer require aw-studio/fjord
php artisan fjord:install
```

First, migrate the Laravel's default tables running:

```bash
php artisan migrate
```

You can easily create a new admin-user by running:

```bash
php artisan fjord:admin
```

It's all setup now, visit http://yourapp.tld/admin

## Setup

If your application is multilingual edit the `config/translatable.php` config
and set the locals to your needing:

```php
'locales' => [
    'de',
    'en'
],
```

## Use the CRUD-System

Generate a fresh CRUDable Model using:

```bash
php artisan fjord:crud
```

Edit the generated migration to your liking and migrate:

```bash
php artisan migrate
```

Add all fillable columns to the new Model, e.g:

```php
protected $fillable = ['title', 'text', 'link',];
```

Add a navigation-entry to the config file `config/fjord-navigation.php`.

```php
return [
    [
        'title' => 'Posts',
        'link' => 'posts',
        'icon' =>'<i class="far fa-newspaper"></i>'
    ]
];
```

Add the crud fields to the config file `config/fjord-crud.php`.

```php
return [
    'posts' =>[
        [
            'type' => 'input',
            'id' => 'title',
            'title' => 'Title',
            'placeholder' => 'Title',
            'hint' => 'The title neeeds to be filled',
            'width' => 8
        ],
        [
            'type' => 'wysiwyg',
            'id' => 'text',
            'title' => 'Text',
            'placeholder' => 'Link',
            'hint' => 'Lorem',
            'width' => 8
        ],
        [
            'type' => 'image',
            'id' => 'image',
            'title' => 'Image',
            'hint' => 'Upload your images',
            'width' => 12,
            'maxFiles' => 3,
            'model' => 'Post'
        ]
    ]
];
```

### Use customizeable Content in a CRUD Model

Add the `HasContent` Trait to the Model. Like in the Example:

```php
<?php

namespace App\Models;

use AwStudio\Fjord\Models\Model as FjordModel;
use AwStudio\Fjord\Models\Traits\HasContent;

class Article extends FjordModel
{
    use HasContent;

    ...
}
```

Create Content fields in config/fjord-content.php like this:

```php
<?php
return [
    'text' => [
        [
            'type' => 'textarea',
            'title' => 'Preview',
            'id' => 'text',
            'placeholder' => 'Preview Text',
            'hint' => 'Lorem ipsum',
            'rows' => 4,
            'width' => 12,
            'default' => '',
        ]
    ],
    ...
];
```

You can now add Content in the Admin Panel and use the filled content relation like this:

```blade
<span>
    @foreach($article->content as $content)
        @if($content->type == 'text')
            {{ $content->text }}
        @endif
    @endforeach
</span>
```

## Using Fjord Pages

Fjord offers a convenient way to populate your website's pages with content.
You can define as many "static" fields as needed per page.
Additionally you can define blocks for repetetive content. Each block can hold
many types of repeatables.

Start of by configuring a page in your `config.fjord-pages.php`

```php
<?php

return [
    'home' =>[
        'translatable' => true,
        'fields' => [
            [
                'id' => 'h1',
                'type' => 'input',
                'title' => 'Headline',
                'placeholder' => 'Headline',
                'hint' => 'The Headline of your homepage',
                'width' => 8
            ],
            [
                'id' => 'intro',
                'type' => 'wysiwyg',
                'title' => 'Intro Text',
                'placeholder' => 'Intro',
                'hint' => 'A Intro text for your homepage',
                'width' => 12
            ],
            [
                'id' => 'contentblock',
                'type' => 'block',
                'title' => 'Articles',
                'placeholder' => 'Articles',
                'hint' => 'A block of Articles',
                'width' => 12,
                'repeatables' => [
                    'article', 'quote'
                ]
            ]
        ]
    ],
];
```

In order to make use of the block, define your repeatables in `config.fjord-repeatables.php`

```php
return [
    'article' => [
        [
            'id' => 'title',
            'type' => 'input',
            'title' => 'Title',
            'placeholder' => 'Title',
            'hint' => 'The artice Ttile',
            'width' => 6
        ],
        [
            'id' => 'text',
            'type' => 'wysiwyg',
            'title' => 'Text',
            'placeholder' => 'Text',
            'hint' => 'The article text',
            'width' => 6
        ],
        [
            'type' => 'image',
            'id' => 'image',
            'title' => 'Image',
            'hint' => 'Upload an image for your article',
            'width' => 12,
            'maxFiles' => 1,
        ],
    ],
    'quote' => [
        [
            'id' => 'quote',
            'type' => 'input',
            'title' => 'Quote',
            'placeholder' => 'Quote',
            'hint' => 'Add a mindful quote to your Articles',
            'width' => 6
        ],
    ]
];
```

Finally, add your page to the navigation `config.fjord-navigation.php`

```php
<?php

return [
    [
        'title' => 'Home',
        'link' => 'pages/home', // pages/name-of-your-page
        'icon' =>'<i class="fas fa-home"></i>'
    ],
];
```