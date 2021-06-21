<?php
use ActiveRecord\Model;

class Plane extends Model
{
    static $validates_presence_of = array(
        array('reference', 'message' => 'Campo de preenchimento obrigatório'),
        array('capacity', 'message' => 'Campo de preenchimento obrigatório'),
        array('type', 'message' => 'Campo de preenchimento obrigatório')
    );

    static $validates_size_of = array(
        array('reference', 'maximum' => 50, 'too_long' => 'should be short and sweet'),
        array('type', 'maximum' => 50, 'too_long' => 'should be short and sweet')
    );
}