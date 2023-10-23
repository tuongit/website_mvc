<?php
/**
* Format Class
*/
class Format{
 public function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date));
 }

 public function textShorten($text, $limit = 400){
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text.".....";
    return $text;
 }

 public function validation($data){
    $data = trim($data);// bo khoang cach
    $data = stripcslashes($data);// dấu xuyệt
    $data = htmlspecialchars($data);// ký tu dac biet
    return $data;
 }

 public function title(){
    $path = $_SERVER['SCRIPT_FILENAME'];
    $title = basename($path, '.php');
    //$title = str_replace('_', ' ', $title);
    if ($title == 'index') {
     $title = 'home';
    }elseif ($title == 'contact') {
     $title = 'contact';
    }
    return $title = ucfirst($title);
   }

public function format_currency($n=0){
      $n = (string)$n;
      $n = strrev($n);
      $res='';
      for($i=0;$i<strlen($n);$i++){
         if($i%3==0 && $i!=0){
            $res.='.';
         }
         $res.=$n[$i];
      }
      $res=strrev($res);
      return $res;
   }
// public function formatCurrencyVND($amount) {
//     $formattedAmount = '';
//     $amount = (int)$amount; // Chuyển số tiền thành kiểu số nguyên

//     while ($amount >= 1000) {
//         $remainder = $amount % 1000; // Lấy phần dư khi chia cho 1000
//         $amount = $amount / 1000; // Lấy phần nguyên khi chia cho 1000

//         $formattedAmount = sprintf('.%03d', $remainder) . $formattedAmount; // Định dạng phần dư với 3 chữ số sau dấu chấm và ghép vào chuỗi định dạng
//     }

//     $formattedAmount = strrev($amount . $formattedAmount); // Ghép phần nguyên vào chuỗi định dạng
//     $formattedAmount .= ' VND'; // Thêm đơn vị tiền tệ VND vào cuối

//     return strrev($formattedAmount);
// }

}
?>