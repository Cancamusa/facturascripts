<?php

require_once 'model/asiento.php';

class contabilidad_asiento extends fs_controller
{
   public $asiento;

   public function __construct() {
      parent::__construct('contabilidad_asiento', 'Asiento', 'contabilidad', FALSE, FALSE);
   }
   
   protected function process()
   {
      $this->ppage = $this->page->get('contabilidad_asientos');
      
      if( isset($_GET['id']) )
      {
         $this->asiento = new asiento();
         $this->asiento = $this->asiento->get($_GET['id']);
         if( $this->asiento )
         {
            $this->page->title = 'Asiento: '.$this->asiento->numero;
            $url = $this->asiento->factura_url();
            if($url != '')
               $this->buttons[] = new fs_button('b_ver_factura', $this->asiento->tipodocumento, $url, 'button', 'img/zoom.png');
            $this->buttons[] = new fs_button('b_eliminar_asiento', 'eliminar', '#', 'remove', 'img/remove.png');
         }
      }
      else
         $this->asiento = FALSE;
   }
   
   public function version() {
      return parent::version().'-1';
   }
   
   public function url()
   {
      if( $this->asiento )
         return $this->asiento->url();
      else
         return $this->ppage->url();
   }
}

?>