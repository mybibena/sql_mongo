# SQL Mongo

Alternative CLI MongoDB client with SQL-like syntax

### Installation

To download all dependencies run in project directory

```
$ composer install
```

You should fill settings (app/settings/settings.php)

### How To Use

It is recomended to use sql_mongo file. But you should make it executable

```
# chmod +x ./sql_mongo
```

Program work only from CLI and expect only one parameter with SQL-like query

```
$ ./sql_mongo "SELECT location, city FROM zips WHERE population >= 5000 AND state = 'NY'
                                               ORDER BY population" DESC SKIP 5 LIMIT 50"
```

### How To Test

Unit tests use [MongoDB's Zip Code Data Set](http://media.mongodb.org/zips.json)

Notice when you start unit tests it will automatically download and insert collection zips into
database you fill in settings file.

It is recomended before start tests update your database settings to new database name.

To start unit tests execute in project root directory

```
$ phpunit
```
