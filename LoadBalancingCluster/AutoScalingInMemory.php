<?php

class OnApp_LoadBalancingCluster_AutoScalingInMemory extends AutoScaling {
	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

}