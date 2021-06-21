<?php
use ActiveRecord\Model;

class Layover extends Model
{
    static $belongs_to = array(
    array('airporttoo', 'class_name' => 'airport','foreign_key'=>'idairporttoo'),
    array('airportfrom', 'class_name' => 'airport','foreign_key'=>'idairportfrom')
    );
}