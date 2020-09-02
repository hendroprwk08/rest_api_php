<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$headers = getallheaders();

include 'database.php';
$db = new Database();

switch ($_SERVER['REQUEST_METHOD']) { //jenis method
    case 'PUT':
        $db->open();

        $sql = 'update barang set namabarang = "'. $headers['nama'] .'", hargabeli = '. $headers['beli'] .', ';
        $sql .= 'hargajual = '. $headers['jual'] .', stok = '. $headers['stok'] .', ';
        $sql .= 'idsupplier = "'. $headers['supplier'] .'", expired = "'. $headers['expired'] .'" ';  
        $sql .= 'where idbarang = "'. $headers['id'] .'"';
        
        $result = [
            'method' => 'PUT',
            'result' => $db->execute($sql)
        ];    
    
        $db->close();
        print json_encode( $result ); 
        break;
    case 'POST':
        $db->open();

        $sql = 'insert into barang values("'. $headers['id'] .'", ';
        $sql .= '"'. $headers['nama'] .'", '. $headers['beli'] .', ';
        $sql .= $headers['jual'] .', '. $headers['stok'] .', ';
        $sql .= ' "'. $headers['supplier'] .'", "'. $headers['expired'] .'")';

        $result = [
            'method' => 'POST',
            'result' => $db->execute($sql)
        ];    

        $db->close();
        print json_encode( $result ); 
        break;
    case 'GET':
        $db->open();

        $result = [
            'method' => 'GET',
            'result' => $db->get('select * from barang')
        ];    

        $db->close();
        print json_encode( $result ); 
        break;
    case 'DELETE':
        $db->open();

        $sql = 'delete from barang where idbarang ="'. $headers['id'] .'"';
        
        $result = [
            'method' => 'DELETE',
            'result' => $db->execute($sql)
        ];    
    
        $db->close();
        print json_encode( $result ); 
        break;
    default: 
        //perintah salah
        http_response_code(400); //kode bad request

        $result = [
            'method' => 'unacceptable method',
            'result' => null
        ];    
    
        print json_encode( $result ); 
        break;
}
?>