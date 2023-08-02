# Document Module for Magento 2

[![Latest Stable Version](https://img.shields.io/packagist/v/opengento/module-document-widget.svg?style=flat-square)](https://packagist.org/packages/opengento/module-document-widget)
[![License: MIT](https://img.shields.io/github/license/opengento/magento2-document-widget.svg?style=flat-square)](./LICENSE) 
[![Packagist](https://img.shields.io/packagist/dt/opengento/module-document-widget.svg?style=flat-square)](https://packagist.org/packages/opengento/module-document-widget/stats)
[![Packagist](https://img.shields.io/packagist/dm/opengento/module-document-widget.svg?style=flat-square)](https://packagist.org/packages/opengento/module-document-widget/stats)

This module aims to make documents searchable for customers in Magento 2.

 - [Setup](#setup)
   - [Composer installation](#composer-installation)
   - [Setup the module](#setup-the-module)
 - [Features](#features)
 - [Settings](#settings)
 - [Documentation](#documentation)
 - [Support](#support)
 - [Authors](#authors)
 - [License](#license)

## Setup

Magento 2 Open Source or Commerce edition is required.

### Composer installation

Run the following composer command:

```
composer require opengento/module-document-widget
```

### Setup the module

Run the following magento command:

```
bin/magento setup:upgrade
```

**If you are in production mode, do not forget to recompile and redeploy the static resources.**

## Features

This module aims to make documents available trhough the widgets in Magento 2.  
Documents can be available as a list or a link thanks to new dedicated widgets.

## Documentation

You can use one of the two available widgets:

- link
  - inline name
  - block image
  - block name
  - block image + name
- list by document type
  - image
  - name
  - image + name

## Support

Raise a new [request](https://github.com/opengento/magento2-document-widget/issues) to the issue tracker.

## Authors

- **Opengento Community** - *Lead* - [![Twitter Follow](https://img.shields.io/twitter/follow/opengento.svg?style=social)](https://twitter.com/opengento)
- **Thomas Klein** - *Maintainer* - [![GitHub followers](https://img.shields.io/github/followers/thomas-kl1.svg?style=social)](https://github.com/thomas-kl1)
- **Contributors** - *Contributor* - [![GitHub contributors](https://img.shields.io/github/contributors/opengento/magento2-document-search.svg?style=flat-square)](https://github.com/opengento/magento2-document-search/graphs/contributors)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) details.

***That's all folks!***
