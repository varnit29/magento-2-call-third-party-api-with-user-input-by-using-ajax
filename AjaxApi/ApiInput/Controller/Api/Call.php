<?php
namespace AjaxApi\ApiInput\Controller\Api;
 
class Call extends \Magento\Framework\App\Action\Action
{
 
    protected $_curl;
    // protected $urlPrefix = 'https://';

    protected $apiUrl ='https://api.agify.io/?name=';

     public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\HTTP\Client\Curl $curl,
     ) {
        $this->_curl = $curl;
        parent::__construct($context);
        $this->resultFactory = $context->getResultFactory();
     }

     public function getApiUrl($getname)
    {
        return $this->apiUrl . $getname ;
    }
 
     public function execute()
     {

        $getname = $this->getRequest()->getParam('name');
        
        $result = $this->resultFactory->create('Magento\Framework\Controller\ResultFactory'::TYPE_JSON);
        $apiUrl = $this->getApiUrl($getname);

        $this->_curl->get($apiUrl);

        $response = $this->_curl->getBody();

        $response = json_decode($response);

      //   print_r($response);
         // $resultJson->setData($response);
         $result->setData($response);
         // print_r($response);
        return $result;
     }
}
?>