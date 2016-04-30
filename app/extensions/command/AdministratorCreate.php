<?php
namespace app\extensions\command;

use app\models\Administrators;

class AdministratorCreate extends \lithium\console\Command {

	public $u;	//username
	public $p;	//password

    public function run() {
        $this->header('Administrator Creator');

        if(empty($this->u)){
        	$this->out('Error: Please run with --u=USERNAME to include the username');
        	return false;
        }
        if(empty($this->p)){
        	$this->out('Error: Please run with --p=PASSWORD to include password');
        	return false;
        }

        $this->out('Creating an admin...');
        
        $admin = Administrators::create();
        $admin->username = $this->u;
        $admin->password = $this->p;
        if($admin->save()){
        	$this->out('Created user ' . $admin->username);	
        } else {
        	$this->out('Error creating user');	
        }
        
    }
}


/* To create Administrator from CLI:
 
 $ ./libraries/lithium/console/li3             
...
COMMANDS via app
    administrator-create

$ ./libraries/lithium/console/li3 administrator-create --u=USERNAME --p=PASSWORD


 */


?>