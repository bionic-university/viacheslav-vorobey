Eventmapia
===============

This is simple service for planning event, that is based on the Google Maps Api.

Requirements
------------
Eventmapia requires PHP 5.4 or above & MySQL


Installation
------------
```bash
git clone https://github.com/bionic-university/viacheslav-vorobey.git

curl -s https://getcomposer.org/installer | php

php composer.phar install
```

Use as dependency in composer
-----------------------------

```
   "require": {
        "egeloen/google-map": "dev-master",
		"widop/http-adapter": "~1.1.0",
        "willdurand/geocoder": "~2.0"
    }

```