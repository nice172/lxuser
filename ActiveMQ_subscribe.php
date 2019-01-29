<?php

set_time_limit(0);
ignore_user_abort(true);

try {
    $stomp = new Stomp('tcp://127.0.0.1:61613'); //连接ActiveMQ
} catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}

$subscribe = $stomp->subscribe('/queue/userReg');

while(true) {
    //判断是否有读取的信息
    if($stomp->hasFrame()) {
        $frame = $stomp->readFrame();
        $data = json_decode($frame->body, true);
        print_r($data);
        
        //我们通过获取的数据
        //处理相应的逻辑，比如存入数据库，发送验证码等一系列操作。
        //$db->query("insert into user values('{$username}','{$password}')");
        //sendVerify();
        
        //表示消息被处理掉了，ack()函数很重要
        $stomp->ack($frame);
    }
    sleep(1);
}

//关闭连接
unset($stomp);