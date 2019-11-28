<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Member
{
  public function login(Request $request, Response $response, $args)
  {
    $formData = $request->getParams();
    $responseData = null;
    $db = new \App\Tools\Database();
    $result = $db->query(
      "SELECT * FROM member WHERE username = '" . $formData['username'] . "' LIMIT 1"
    );


    if ($result['rowCount'] > 0) {
      if ($result['result'][0]['password'] == $formData['password']) {
        $responseData = array(
          "message" => "เข้า่ระบบสำเร็จ",
          "success" => true,
          "data" => $result['result'],
        );
      } else {
        $responseData = array(
          "message" => "รหัสผ่านไม่ถูกเด้อหล่า",
          "success" => false,
        );
      }
    } else {
      $responseData = array(
        "message" => "ไม่พบผู้ใช้งานนี้",
        "success" => false,
      );
    }
    $response->getBody()->write(\json_encode($responseData));
    return $response;
  }
}
