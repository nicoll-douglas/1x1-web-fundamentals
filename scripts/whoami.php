<?php
echo 'User: ' . exec('whoami') . "\n";
echo 'Group: ' . posix_getgrgid(posix_getegid())['name'] . "\n";
