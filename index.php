<?php
use TaskList\Core\{ Router, Request };

require 'vendor/autoload.php';

require Router::load('routes.php')
          ->direct(Request::uri(), Request::method());