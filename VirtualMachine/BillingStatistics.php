<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User IP Adresses
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User IP Billing Statistics
 *
 * The OnApp_VirtualMachine_BillingStatistics class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_BillingStatistics extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property datetime created_at
	 * @property float    cost
	 * @property datetime updated_at
	 * @property datetime stat_time
	 * @property integer  id
	 * @property integer  user_id
	 * @property integer  vm_billing_stat_id
	 * @property integer  virtual_machine_id
	 * @property string   billing_stats
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'vm_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'vm_stats';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_vm_stats
				 * @method GET
				 * @alias  /virtual_machines/:virtual_machine_id/vm_stats(.:format)
				 * @format {:controller=>"vm_stats", :action=>"index"}
				 */
				if( is_null( $this->_virtual_machine_id ) && is_null( $this->_obj->_virtual_machine_id ) ) {
					$this->logger->error(
						"getURL($action): argument _virtual_machine_id not set.",
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_virtual_machine_id ) ) {
						$this->_virtual_machine_id = $this->_obj->_virtual_machine_id;
					}
				}

				$resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
				$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $virtual_machine_id User ID
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $virtual_machine_id = NULL, $url_args = NULL ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
			$virtual_machine_id = $this->_virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->_virtual_machine_id = $virtual_machine_id;

			return parent::getList( $virtual_machine_id, $url_args );
		}
		else {
			$this->logger->error(
				'getList: argument _virtual_machine_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
	 *
	 * @access public
	 */
	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}