Medical. Test Project
============================

The test project.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

Clone the project:
git clone https://github.com/Salvadore1987/dev.medical.uz


CONFIGURATION
-------------

### Database

Step 1. Create the database.
Step 2. Create new user and give him acces to the database;

Step 3.
Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic', //Your db name
    'username' => 'root', //Your username
    'password' => '1234', // Your password
    'charset' => 'utf8',
];
```

Step 4.
Open the command line in the site root directory and enter next command:
php yii migrate
After that in database created all tables needs to work.

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.
