namespace {:namespace};

class {:class} extends \lithium\data\Model {

	public $validates = array();
}

{:class}::applyFilter('save', function($self, $params, $chain) {
    
    // If data is passed to the save function, set it in the record.  
    // This makes it possible to validate the data before continuing the save process.
    if(!empty($params['data'])) {
        $data = $params['data'];
        $params['entity']->set($data);
        $params['data'] = array();
    }
    
    // Assign the record to a variable for easy access
    $record = $params['entity'];

    // Put your "before save" code here.
    if(!$record->exists()) {
        $record->created = date('Y-m-d h:i:s');
    } else {
    }
    $record->modified = date('Y-m-d h:i:s');
    
    // Put the record back in the $params array and continue the save process
    $params['entity'] = $record;
    $result = $chain->next($self, $params, $chain);

    // Put your "after save" code here
    if($result) {
       //log('Success!');
    }

    return $result;
});