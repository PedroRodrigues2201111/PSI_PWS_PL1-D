<?php
use \ActiveRecord\Model;

class Airport extends Model
{
    static $validates_presence_of = array(
        array('name', 'message' => 'Campo de preenchimento obrigatório'),
        array('localization', 'message' => 'Campo de preenchimento obrigatório')
    );
    static $validates_size_of = array(
        array('name', 'maximum' => 100, 'too_long' => 'should be short and sweet'),
        array('localization', 'maximum' => 100, 'too_long' => 'should be short and sweet')
    );

}