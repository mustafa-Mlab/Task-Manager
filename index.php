<?php

// Load Database
require 'core/Load.php';

require 'core/Routes.php';
require 'core/Request.php';

require Router::load('routes.php')
          ->direct(Request::uri(), Request::method());