<?php
// phpcs:ignoreFile

// create a factory class
// send through attributes create()->create()

function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}

// make a factory class
// send through attributes make()->make()

function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}
