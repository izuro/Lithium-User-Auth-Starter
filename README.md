# Surge li₃ bootstrap

The li₃ standard distribution is an application system that includes the
overarching directory layout, an example starting application, and a copy of the
[li₃ framework](https://github.com/UnionOfRAD/lithium).

Surge bootstrap adds:
- User & Admin Models
- ACL Authentication
- Standard layout & views
- Logger enabled

## Installation

- Clone project repo
	- Git 2.13 or later:
		- `git clone --recurse-submodules https://github.com/izuro/Lithium-User-Auth-Starter.git`
	- Other Git versions
		- `git clone --recursive https://github.com/izuro/Lithium-User-Auth-Starter.git`
- For already cloned, get submodules
	- `git submodule update --init --recursive`
- To include fixes for PHP 7.0 & Mongodb
	- `composer install`
- chmod -R 0777 app/resources
- Configure DB connection in app/config/bootstrap/connections.php, replace YOURMONGODATABASENAME
- Set Path ENV for li3 console
	- http://li3.me/docs/manual/common-tasks/console-applications.md
- Add an Admin user:
	- $ li3 administrator-create --u=USERNAME --p=PASSWORD 
	- OR
	- $ ./libraries/lithium/console/li3 administrator-create --u=USERNAME --p=PASSWORD
- Create normal users by visiting the website using admin login

## Auth Usage

Define controller actions' access levels by specifying in the controller's $publicActions & $adminActions property
e.g app/controllers/UsersController.php
```php

    // All actions default as User auth-required actions
    // NO ACTION REQUIRED for normal user-login actions

	// Non-logged in users can only access Public Actions
    public $publicActions = array('login','logout');

	// Only Administrator can access Admin Actions
    public $adminActions = array('index', 'add', 'view', 'edit', 'delete');


```
