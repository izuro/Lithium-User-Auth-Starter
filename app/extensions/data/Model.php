<?php

namespace app\extensions\data;

use lithium\security\Password;

class Model extends \lithium\data\Model {

    //Apply filter to Hash Passwords & log modified/created dates
    public static function __init() {
        parent::__init();

        // {{{ Filters
        static::applyFilter('save', function($self, $params, $chain) {
            $date   = date('Y-m-d H:i:s', time());
            
            //$schema = $self::schema();    //### UNCOMMENT IF MYSQL

            //do these things only if they don't exist (i.e.  on creation of object)
            if (!$params['entity']->exists()) {

                //hash password
                if (isset($params['data']['password'])) {
                    $params['data']['password'] = Password::hash($params['data']['password']);
                }

                //if 'created' doesn't already exist and is defined in the schema...
                if (empty($params['data']['created'])){//} && array_key_exists('created', $schema)) {//### UNCOMMENT IF MYSQL
                    //$params['data']['created'] = $date;
                    $params['entity']->created = $date;
                    $params['entity']->modified = $date;
                }
            }

            //if (array_key_exists('modified', $schema)) {//### UNCOMMENT IF MYSQL
                //$params['data']['modified'] = $date;
                $params['entity']->modified = $date;
            //}
            return $chain->next($self, $params, $chain);
        });
        // }}}
    }
}

?>
