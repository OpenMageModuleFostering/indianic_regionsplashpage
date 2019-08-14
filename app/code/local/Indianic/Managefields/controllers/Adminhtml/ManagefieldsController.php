<?php

class Indianic_Managefields_Adminhtml_ManagefieldsController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('managefields/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Field Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('managefields/managefields')->load($id);
        
		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('managefields_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('managefields/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Field Manager'), Mage::helper('adminhtml')->__('Field Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Fields News'), Mage::helper('adminhtml')->__('Fields News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('managefields/adminhtml_managefields_edit'))
				->_addLeft($this->getLayout()->createBlock('managefields/adminhtml_managefields_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('managefields')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {  			
	            $data['title'] = strtolower(str_replace(' ','_',$data['title']));
			$model = Mage::getModel('managefields/managefields');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				$model->save();
                
                $this->Altertable(strtolower($model->getTitle()));
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('managefields')->__('Field was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('managefields')->__('Unable to find Field to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('managefields/managefields');
				$title = $model->load($this->getRequest()->getParam('id'));
                  $installer =  Mage::getSingleton ( 'core/resource' );
                  $installer->getConnection()->dropColumn('regionpage', $title->getTitle());
                 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Field was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $managefieldsIds = $this->getRequest()->getParam('managefields');
        if(!is_array($managefieldsIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select Field(s)'));
        } else {
            try {
                 $installer =  Mage::getSingleton ( 'core/resource' );
                foreach ($managefieldsIds as $managefieldsId) {
                    $managefields = Mage::getModel('managefields/managefields')->load($managefieldsId);
                     $installer->getConnection()->dropColumn('regionpage', $managefields->getTitle());
                    $managefields->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($managefieldsIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $managefieldsIds = $this->getRequest()->getParam('managefields');
        if(!is_array($managefieldsIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($managefieldsIds as $managefieldsId) {
                    $managefields = Mage::getSingleton('managefields/managefields')
                        ->load($managefieldsId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($managefieldsIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'managefields.csv';
        $content    = $this->getLayout()->createBlock('managefields/adminhtml_managefields_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'managefields.xml';
        $content    = $this->getLayout()->createBlock('managefields/adminhtml_managefields_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
    
    public function Altertable($title)
    {
        $installer =  Mage::getSingleton ( 'core/resource' );
      /*  if($this->getRequest()->getParam('hidden'))
        {
            $installer->getConnection()->changeColumn('regionpage',$this->getRequest()->getParam('hidden'),$title,'text');
        }   */
             $installer->getConnection()->addColumn('regionpage', $title, array(
                   'nullable' => true,
                   'length' => 255,
                    'type' => 'text',
                    'comment' => $title
                )
             ); 
    }
}