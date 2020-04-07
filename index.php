<?php
$settings=[
   'host'=>'localhost',
   'db'=>'rentalwebsite',
   'user'=>'root',
   'password'=>''
];

$opt=[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO('mysql:host='.$settings['host'].';dbname='.$settings['db'].';charset=utf8mb4',$settings['user'],$settings['password'],$opt);
$result=$pdo->query('SELECT ID,Firstname FROM user');
echo '<table border="1">'; //Process result
while ($record=$result->fetch()){
	echo '<tr><td>'.$record['ID'].'</td><td>'.$record['Firstname'].'</td></tr>';
}
echo '</table>';
echo '<hr>';

/*DETAIL*/
$result=$pdo->query('SELECT *FROM user WHERE ID=1'); //Execute query
if ($result->rowCount()==0) echo '<p>There is no result matching your query</p';
$record=$result->fetch();
echo '<h1>'.$record['Firstname'].'</h1>';
echo '<p>'.$record['Phone'].'</p>';

/*CREATE*/
$pdo->query('INSERT INTO user(Firstname, Age, Sex, picture, phone)
VALUES("Eric",32,"Male","https:\/\/www.biography.com\/.image\/t_share\/MTUxNjU1MjI3NTc2MDM0NTcy\/gettyimages-689502038.jpg","819-346-6691")');
echo $pdo->lastInsertId();

/*MODIFY*/
$pdo->query('UPDATE user SET Firstname="Babita" WHERE ID=7');

/*DELECT*/
$pdo->query('DELECT FROM user WHERE Firstname="Babita"');


