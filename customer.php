<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'database.php';
$db = new Database();

switch ($_SERVER['REQUEST_METHOD']) { //jenis method
    case 'PUT':
        $db->open();

        $sql = 'update customer set namacustomer = "'. $_REQUEST['nama'] .'", ';
        $sql .= 'telpcustomer = "'. $_REQUEST['telp'] .'" ';
        $sql .= 'where idcustomer = "'. $_REQUEST['id'] .'"';

        $result = [
            'result' => $db->execute($sql)
        ];    

        $db->close();
        print json_encode( $result ); 
        break;
    case 'POST':
        $db->open();

        $sql = 'insert into customer values("'. $_REQUEST['id'] .'", ';
        $sql .= '"'. $_REQUEST['nama'] .'", "'. $_REQUEST['telp'] .'")';

        $result = [
            'result' => $db->execute($sql)
        ];    

        $db->close();
        print json_encode( $result ); 
        break;
    case 'GET':
        $db->open();

        $result = [
            'result' => $db->get('select * from customer')
        ];    
 
        $db->close();
        print json_encode( $result ); 
        break;
    case 'DELETE':
        $db->open();

        $sql = 'delete from customer where idcustomer ="'. $_REQUEST['id'] .'"';
        
        $result = [
            'result' => $db->execute($sql)
        ];    
    
        $db->close();
        print json_encode( $result ); 
        break;
    default: 
        http_response_code(400); //kode bad request

        $result = [
            'result' => null
        ];    
    
        print json_encode( $result ); 
        break;
}
?>