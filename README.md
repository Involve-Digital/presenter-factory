> At this moment I don't have time, energy and money to maintain this project. But it's a shame so if you depend on this project and you want to become a sponsor or develop it further please don't hesitate to contact me. Otherwise, I am not able to guarantee bright future of this repo... :)

# Enhanced presenter factory for Nette Framework

This package is fork of [librette/presenter-factory](https://github.com/librette/presenter-factory). Unfortunately author of this package is not taking care of this package anymore. But it's very useful. So that's why. And now what:

[![Build Status](https://travis-ci.org/JohnyRicio/presenter-factory.svg?branch=master)](https://travis-ci.org/JohnyRicio/presenter-factory)

Nette Framework does have very simple presenter factory which helps you to map namespaces of presenters to the presenter name and vice versa.
Unfortunately it's not possible to map two namespaces under one module section:

```php
application:
  mapping:
    Module: App\Presenters\*Presenter
```

But with this package it is possible:

```php
application:
  mapping:
    Module:
      - App\Presenters\*Presenter
      - Bpp\Controllers\*Controller
```

In this case Nette is going to look for presenters in two namespaces. This is extremely useful if you have a lot of bundles
separated by functionality. For example you have API module with this mapping:

`['Api' => 'Ant\ApiModule\Presenters\*Presenter']`

Then you have Assets bundle.
In this bundle you can setup mapping for presenters under Assets package but related to the API like this:

`['Api' => 'Ant\Assets\ApiModule\Presenters\*Presenter']`

I found this very useful.
