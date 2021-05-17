# Incept
A PHP8 Low Code Framework

## Install

1. Issue the Composer create-project command in your terminal:

```bash
$ composer create-project inceptphp/incept <project folder name>
```

2. Then go cd `<project folder name>` and run the following and and follow the
wizard to install.

```bash
$ cd <project folder name>
$ bin/incept install
$ bin/incept inceptphp/packages/file populate
$ bin/incept inceptphp/packages/auth populate
$ bin/incept inceptphp/packages/role populate
$ bin/incept inceptphp/packages/api populate
$ bin/incept inceptphp/packages/website populate
$ yarn build
```

3. To start the server you issue the following command.

```bash
$ bin/incept server -h 127.0.0.1 -p 8888
```

4. Sign In

Find the Sign In link in the header nav bar or go to:

```
http://127.0.0.1:8888/auth/signin
```

Sign in using the following credentials:

 - Username: admin
 - Password: admin

Lastly manually go to the admin:

```
http://127.0.0.1:8888/admin
```
