<?php
use \ActiveRecord\Model;

class Flight extends Model
{
    static $validates_presence_of = array(
        array('dtorigin', 'message' => 'Campo de preenchimento obrigatório'),
        array('dtdestination', 'message' => 'Campo de preenchimento obrigatório'),
        array('hrorigin', 'message' => 'Campo de preenchimento obrigatório'),
        array('hrdestination', 'message' => 'Campo de preenchimento obrigatório'),
    );
}