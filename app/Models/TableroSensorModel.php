<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;


class TableroSensorModel extends Model{
    protected $table      = 'tableroSensor';
    protected $primaryKey = 'idTS';

    protected $allowedFields = ['idTS','refTablero','refSensor'];

}