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
$ bin/incept inceptphp/packages/auth populate
$ bin/incept inceptphp/packages/role populate
$ yarn build
```

3. To start the server you issue the following command.

```bash
$ bin/incept server -h 127.0.0.1 -p 8888
```
