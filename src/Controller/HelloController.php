<?php
namespace Drupal\registration\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormStateInterface;


use Drupal\node\Entity\Node;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;

class HelloController extends ControllerBase {
    
    public function paypal() {
        $max_id = db_query("SELECT MAX(id) FROM {registration}")->fetchField();
        
        $myobj = db_query("SELECT * FROM {registration} WHERE id = :id", [':id' => $max_id])->fetchObject();
           
          /*  $element = array(
              '#markup' => 'paypal page 111'.$name,
            );
            return $element;*/
           
            $element2 = array(
              '#markup' => '<table>
  <tr><td>Name:</th><td>'.$myobj->name.'</td></tr>
  <tr><td>Phone:</td><td>'.$myobj->phone.'</td></tr>
  <tr><td>Email:</td><td>'.$myobj->email.'</td></tr>
  <tr><td>Mailing Address:</td><td>'.$myobj->address.'</td></tr>
  <tr><td>Price:</td><td>'.$myobj->price.'</td></tr>
  <tr><td>Comment:</td><td>'.$myobj->comment.'</td></tr>
</table>', );
            return $element2;
            
    } 
    
    public function successpage() {
  //display thankyou page
    $element = array(
      '#markup' => 'Form data submitted',
    );
    return $element;
  }
  
  public function page(){
      
    $max_id = db_query("SELECT MAX(id) FROM {registration}")->fetchField();
    
    $myobj = db_query("SELECT * FROM {registration} WHERE id = :id", [':id' => $max_id])->fetchObject();

          
    date_default_timezone_set('Asia/Calcutta'); 
    $currnt_date = date("Y-m-d h:i:s");
    function get_time_difference($start, $finish){
        return ceil(abs((strtotime($finish) - strtotime($start)) / 60));
    }

    $start_time = $myobj->date;
    $finish_time = $currnt_date;
    
    $diff = get_time_difference($start_time, $finish_time);
    $myobjFormData ="";
   if($diff<=3){
       $myobjFormData = $myobj;
   }else{
       $myobjFormData = "";
   }
        
      return array(
          '#theme'=>'article_list',
          '#items'=> array('key' => $myobjFormData),
          '#title'=>''
          );
  }
  
  
}


























