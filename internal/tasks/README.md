**Crontab Configuration**

```
## Get/Update any users and their statistics
*/5 * * * * cd /var/www/j-stats/internal/tasks && php7.4 updatePlayerStats.php && php7.4 updatePlayer.php

## Get/Update any villages and their statistics
*/30 * * * * cd /var/www/j-stats/internal/tasks && php7.4 updateVillage.php && php7.4 updateVillageStats.php

## Get User Signs from world map and parse the User Signs for any shops
0 0 * * * cd /var/www/j-stats/internal/tasks && php7.4 updateSigns.php && php7.4 updateUserShops.php

## Check for multiple UUIDS then give newest username
0 0 * * * cd /var/www/j-stats/internal/tasks && php7.4 updateUser.php

## Parse the Discord Chat logger
*/1 * * * * cd /var/www/j-stats/internal/tasks && php7.4 updateUserChat.php
```
