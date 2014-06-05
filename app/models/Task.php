<?php

class Task extends Eloquent {

    // Not relevant to the series...
    public static $rules = [];

    protected $fillable = ['name', 'description'];

}
