<?php
namespace Tqdev\PhpCrudApi {

    include("api.include.php");

    
    use Tqdev\PhpCrudApi\Api;
    use Tqdev\PhpCrudApi\Config\Config;
    use Tqdev\PhpCrudApi\RequestFactory;
    use Tqdev\PhpCrudApi\ResponseUtils;

    $config = new Config([
        // 'driver' => 'mysql',
        // 'address' => 'localhost',
        // 'port' => '3306',
        'username' => 'root',
        'password' => '',
        'database' => 'test',
        // 'debug' => false
    ]);
    $request = RequestFactory::fromGlobals();
    $api = new Api($config);
    $response = $api->handle($request);
    ResponseUtils::output($response);

    //file_put_contents('request.log',RequestUtils::toString($request)."===\n",FILE_APPEND);
    //file_put_contents('request.log',ResponseUtils::toString($response)."===\n",FILE_APPEND);
}
?>