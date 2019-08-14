<?php
class Indianic_Regionpage_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/regionpage?id=15 
    	 *  or
    	 * http://site.com/regionpage/id/15 	
    	 */
    	/* 
		$regionpage_id = $this->getRequest()->getParam('id');

  		if($regionpage_id != null && $regionpage_id != '')	{
			$regionpage = Mage::getModel('regionpage/regionpage')->load($regionpage_id)->getData();
		} else {
			$regionpage = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($regionpage == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$regionpageTable = $resource->getTableName('regionpage');
			
			$select = $read->select()
			   ->from($regionpageTable,array('regionpage_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$regionpage = $read->fetchRow($select);
		}
		Mage::register('regionpage', $regionpage);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}