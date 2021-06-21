<?php

use \ActiveRecord\Model;

class User extends Model
{
    static $validates_presence_of = array(
        array('name', 'message' => 'Campo de preenchimento obrigatório'),
        array('morada', 'message' => 'Campo de preenchimento obrigatório'),
        array('email', 'message' => 'Campo de preenchimento obrigatório'),
        array('nif', 'message' => 'Campo de preenchimento obrigatório'),
        array('telefone', 'message' => 'Campo de preenchimento obrigatório'),
        array('username', 'message' => 'Campo de preenchimento obrigatório'),
        array('password', 'message' => 'Campo de preenchimento obrigatório'),
        array('role', 'message' => 'Campo de preenchimento obrigatório',)
    );

    static $validates_size_of = array(
        array('name', 'maximum' => 80, 'too_long' => 'should be short and sweet'),
        array('morada', 'maximum' => 100, 'too_long' => 'should be short and sweet'),
        array('email', 'maximum' => 60, 'too_long' => 'should be short and sweet'),
        array('nif', 'maximum' => 9, 'too_long' => 'should be short and sweet'),
        array('telefone', 'maximum' => 9, 'too_long' => 'should be short and sweet'),
        array('username', 'maximum' => 50, 'too_long' => 'should be short and sweet'),
        array('password', 'maximum' => 30, 'too_long' => 'should be short and sweet')
    );

    static $validates_format_of = array(
        array('email', 'with' => '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/')
    );

    static $validates_numericality_of = array(
        array('nif', 'only_integer' => true),
        array('telefone', 'only_integer' => true)
    );

    static $validates_inclusion_of = array(
        array('role', 'in' => array('passageiro', 'gestorvoo', 'admin', 'operadorcheckin')),
    );
}
