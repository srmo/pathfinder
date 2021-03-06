<?php
/**
 * Created by PhpStorm.
 * User: Exodus
 * Date: 16.07.2016
 * Time: 12:19
 */

namespace Model;

use DB\SQL\Schema;

class SystemWormholeModel extends BasicModel {

    protected $table = 'system_wormhole';

    public static $enableDataExport = true;
    public static $enableDataImport = true;

    protected $fieldConf = [
        'systemId' => [
            'type' => Schema::DT_INT,
            'index' => true,
        ],
        'wormholeId' => [
            'type' => Schema::DT_INT,
            'index' => true,
            'belongs-to-one' => 'Model\WormholeModel',
            'constraint' => [
                [
                    'table' => 'wormhole',
                    'on-delete' => 'CASCADE'
                ]
            ]
        ],
    ];

    /**
     * get wormhole data as object
     * @return object
     */
    public function getData(){
        return  $this->wormholeId->getData();
    }

    /**
     * overwrites parent
     * @param null $db
     * @param null $table
     * @param null $fields
     * @return bool
     */
    public static function setup($db=null, $table=null, $fields=null){
        $status = parent::setup($db,$table,$fields);

        if($status === true){
            $status = parent::setMultiColumnIndex(['systemId', 'wormholeId'], true);
        }

        return $status;
    }
}