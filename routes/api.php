<?php

foreach(glob(base_path('routes/v1/modules/*.php')) as $routefile){
    require $routefile;
}