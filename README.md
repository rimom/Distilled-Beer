# Distilled Beer

## Steps to execute:

### Step 1 - Start the server from the root (/)
```
sudo php -S host:port -t public
```
#
(From the /bin folder, execute the following:)

### Step 2 - Create the database:
```
sudo php DataBase.php mysql_root_username mysql_user_password
```
Change "mysql_root_username" and "mysql_user_password" for your real Mysql credentials, don't use "".
#

### Step 3 - Populate the database:
```
sudo php CronUpdateDatabase.php host port token
```
php CronUpdateDatabase.php localhost 8080 123456
```
You can change the default token in settings file (src/settings.php)

#

### Step 4 - Add CronUpdateDatabase.php to Crontab to update the database every night at 11pm: 
```
30 23 * * * cd /where/is/the/app/folder/bin php CronUpdateDatabase.php host port token
```

## Important!
The BreweryDB API is quite slow and it can take some hours to populate or update the local database.

So this project for now is not making any request from the local database yet, all the data requested are being provided direct from the BreweryDB.


It is missing to implement a button to show all beers with pagination

##TODO:
- Implement Twig


