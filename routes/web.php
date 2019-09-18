<?php
use JasperPHP\JasperPHP as JasperPHP;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report', function () {
    $jasper = new JasperPHP;

    // Compile a JRXML to Jasper
//    $jasper->compile(__DIR__ . '/../../vendor/cossou/jasperphp/examples/hello_world2.jrxml')->execute();

    // Process a Jasper file to PDF and RTF (you can use directly the .jrxml)
    /*$jasper->process(
        __DIR__ . '/../../vendor/cossou/jasperphp/examples/welcome2.jasper',
        false,
        array("pdf", "rtf"),
        array("php_version" => "xxx")
    )->execute();*/

//    return view('welcome');


    /*$output = $jasper->list_parameters(
        base_path('/vendor/cossou/jasperphp/examples/hello_world.jasper')
    )->execute();

    foreach($output as $parameter_description)
        echo $parameter_description;*/

    $file_name =  'hello_world';
    $db_connection = array();
    $db_connection['driver'] = "mysql-connector";
    $db_connection['username'] = "root";
    $db_connection['password'] = "";
    $db_connection['host'] = "local";
    $db_connection['database'] = "java_test";
    $db_connection['port'] = "3306";
    $db_connection['jdbc_driver'] = "com.mysql.jdbc.Driver";
    $db_connection['jdbc_url'] = "jdbc:mysql://localhost/java_test";
    $db_connection['jdbc_dir'] = "C:/Users/ziad.abdelhamid/Desktop/test/jars/mysql-connector";

   /* $datafile = base_path('/storage/jasper/data.json');
    $output = base_path('/storage/jasper/data'); //indicate the name of the output PDF
    $jasper->process(
        base_path('/vendor/cossou/jasperphp/examples/'.$file_name.'.jasper'),
        false,
        array("pdf"),
        array('php_version' => phpversion()),
        array("driver"=>"json", "json_query" => "data", "data_file" =>  $datafile)
    )->execute();*/
    $datafile = base_path('/storage/jasper/data.json');
    $output = $jasper->process(
        base_path('/vendor/cossou/jasperphp/examples/'.$file_name.'.jasper'),
        false,
        array('pdf', 'rtf'),
        array('php_version' => phpversion()),
        array("driver"=>"json", "json_query" => "data", "data_file" =>  $datafile)

    )->execute();

  /* $output = $jasper->process(
        base_path('/vendor/cossou/jasperphp/examples/'.$file_name.'.jasper'),
        false,
        array('pdf', 'rtf'),
        array('php_version' => phpversion()),
       array(
           'driver' => "mysql",
           'username' => "root",
           'password' => "",
           'database' => "java_test",
           'port' => "3306",


       )


   )->execute();*/

   if ($output)
   {

       $file= base_path('/vendor/cossou/jasperphp/examples/'.$file_name.'.pdf');

       $headers = array(
           'Content-Type: application/pdf',
       );

       return response()->download($file, 'filename.pdf', $headers);

   }
    //PDF file is stored under project/public/download/info.pdf


});


