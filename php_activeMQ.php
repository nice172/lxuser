<?php

//php ActiveMQ的发送消息，与处理消息

/* connection */

set_time_limit(0);
$num = 20;
$i = 0;
while(true){
    if($i >= $num) break;
    usleep(100);
try {
    $stomp = new Stomp('tcp://127.0.0.1:61613'); //连接ActiveMQ
} catch(Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}

//模拟用户post过来的数据
$obj = new stdClass();
$obj->user = "nice172";
$obj->password = uniqid();

//发送一个注册消息到队列
$stomp->send('/queue/userReg', json_encode($obj));
$i++;

/* close connection */
unset($stomp);

}