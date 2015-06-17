<?php
/**
 * Copyright Chris Schalenborgh
 * Website: www.kryap.com
 * Date: 17/06/15
 * Time: 14:25
 */

echo '
---
DEBUG HEADERS GO HERE
---
';


foreach (getallheaders() as $name => $value) {
    echo "$name: $value <br>
    ";
}

echo '<pre>';
print_r(getallheaders());
echo '</pre>';