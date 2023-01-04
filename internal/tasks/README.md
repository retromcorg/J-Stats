**Crontab Configuration**

```
*/10 * * * * cd /var/www/j-stats/internal/tasks && php7.4 updatePlayerStats.php && php7.4 updatePlayer.php

*/30 * * * * cd /var/www/j-stats/internal/tasks && php7.4 updateVillage.php && php7.4 updateVillageStats.php

0 0 * * * cd /var/www/j-stats/internal/tasks && php7.4 updateSigns.php && php7.4 updateUserShops.php

```