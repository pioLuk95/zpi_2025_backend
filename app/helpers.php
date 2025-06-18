<?php

    if (! function_exists('active_class')) {
        function active_class($patterns, $class = 'active') {
            foreach ((array) $patterns as $pattern) {
                if (request()->is($pattern)) {
                    return $class;
                }
            }
            return '';
        }
    }

    if (! function_exists('is_active_route')) {
        function is_active_route($route, $output = 'active') {
            return request()->routeIs($route) ? $output : '';
        }
    }

    if (! function_exists('show_class')) {
        function show_class($patterns, $class = 'show') {
            foreach ((array) $patterns as $pattern) {
                if (request()->is($pattern)) {
                    return $class;
                }
            }
            return '';
        }
    }
