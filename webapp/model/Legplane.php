<?php
use ActiveRecord\Model;

class Legplane extends Model
{
    static $validates_presence_of = array(
        array('checkinnum', 'message' => 'Campo de preenchimento obrigatório'),
        array('ticketssold', 'message' => 'Campo de preenchimento obrigatório')
    );
}